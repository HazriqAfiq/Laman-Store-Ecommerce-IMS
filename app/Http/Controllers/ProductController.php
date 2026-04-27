<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the inventory list with search, filter, and pagination.
     */
    public function index(Request $request)
    {
        $query = Product::with(['variants'])
            ->withSum('sales', 'quantity')
            ->withSum('resellerStocks', 'quantity');

        // Search by name or SKU
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter by stock level
        match ($request->input('stock')) {
            'out'    => $query->where('stock', 0),
            'low'    => $query->where('stock', '>', 0)->where('stock', '<', 50),
            'medium' => $query->where('stock', '>=', 50)->where('stock', '<=', 100),
            'high'   => $query->where('stock', '>', 100),
            default  => null,
        };

        // Filter by volume
        if ($volume = $request->input('volume')) {
            $query->where('volume_ml', $volume);
        }

        // Sort
        $sortMap = [
            'name'            => ['name', 'asc'],
            'retail_price'    => ['retail_price', 'desc'],
            'wholesale_price' => ['wholesale_price', 'desc'],
            'stock'           => ['stock', 'asc'],
            'volume'          => ['volume_ml', 'asc'],
        ];
        [$sortCol, $sortDir] = $sortMap[$request->input('sort', 'name')] ?? ['name', 'asc'];
        $query->orderBy($sortCol, $sortDir);

        $products = $query->get();

        // Summary stats for header
        $totalProducts   = Product::count();
        $adminStock      = \App\Models\ProductVariant::sum('stock');
        $resellerStock   = \App\Models\ResellerStock::sum('quantity');
        $totalStock      = $adminStock + $resellerStock;
        $lowStockCount   = \App\Models\ProductVariant::where('stock', '>', 0)->where('stock', '<', 50)->count();
        $outOfStock      = \App\Models\ProductVariant::where('stock', 0)->count();

        // Available volume options for filter dropdown
        $volumes = Product::distinct()->orderBy('volume_ml')->pluck('volume_ml');

        return view('admin.products.index', compact(
            'products', 'totalProducts', 'totalStock', 'adminStock', 'resellerStock',
            'lowStockCount', 'outOfStock', 'volumes'
        ));
    }

    public function create()
    {
        $categories   = Category::orderBy('name')->get();
        $productTypes = ProductType::orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'productTypes'));
    }

    public function store(StoreProductRequest $request)
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($request) {
            $product = Product::create($request->validated());
            
            // Handle Variants
            if ($request->has('variants')) {
                foreach ($request->input('variants') as $variantData) {
                    $product->variants()->create([
                        'name' => $variantData['name'],
                        'sku' => $variantData['sku'] ?? $product->sku . '-' . $variantData['name'],
                        'retail_price' => $variantData['retail_price'],
                        'wholesale_price' => $variantData['wholesale_price'],
                        'stock' => $variantData['stock'],
                    ]);
                }

                // Update parent stock sum
                $product->update(['stock' => collect($request->input('variants'))->sum('stock')]);
            }

            \App\Models\ActivityLog::log(
                'product_created',
                $product,
                "Created new product: {$product->name} with " . (is_array($request->variants) ? count($request->variants) : 0) . " variants",
                $request->all()
            );

            return redirect()->route('admin.products.index')->with('success', 'Product and variants added successfully.');
        });
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories   = Category::orderBy('name')->get();
        $productTypes = ProductType::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'productTypes'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($request, $product) {
            $oldStock = $product->stock;
            $product->update($request->validated());

            // Sync Variants
            if ($request->has('variants')) {
                $variantIds = [];
                foreach ($request->input('variants') as $variantData) {
                    $variant = $product->variants()->updateOrCreate(
                        ['id' => $variantData['id'] ?? null],
                        [
                            'name' => $variantData['name'],
                            'sku' => $variantData['sku'] ?? $product->sku . '-' . $variantData['name'],
                            'retail_price' => $variantData['retail_price'],
                            'wholesale_price' => $variantData['wholesale_price'],
                            'stock' => $variantData['stock'],
                        ]
                    );
                    $variantIds[] = $variant->id;
                }
                // Delete variants not in the request
                $product->variants()->whereNotIn('id', $variantIds)->delete();

                // Update parent product fallback fields (optional but good for legacy)
                if (!empty($request->input('variants'))) {
                    $first = $request->input('variants')[0];
                    $product->update([
                        'retail_price' => $first['retail_price'],
                        'wholesale_price' => $first['wholesale_price'],
                        'stock' => collect($request->input('variants'))->sum('stock'),
                    ]);
                }
            }

            $product->refresh();

            \App\Models\ActivityLog::log(
                'product_updated',
                $product,
                "Updated product details and variants for {$product->name}",
                ['changes' => $request->all()]
            );

            // Fire inventory alerts (simplified check on total stock for now)
            $totalStock = $product->variants->sum('stock');
            if ($totalStock === 0 && $oldStock !== 0) {
                NotificationService::outOfStock($product);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product and variants updated successfully.');
        });
    }

    public function destroy(Product $product)
    {
        \App\Models\ActivityLog::log(
            'product_deleted',
            null,
            "Deleted product: {$product->name} (SKU: {$product->sku})",
            ['product_id' => $product->id, 'name' => $product->name, 'sku' => $product->sku]
        );
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
