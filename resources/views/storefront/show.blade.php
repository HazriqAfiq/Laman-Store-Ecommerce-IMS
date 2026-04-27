<x-storefront-layout>
    <x-slot name="title">{{ $product->name }}</x-slot>

    <div class="bg-white border-t-2 pt-16" x-data="{ 
        activeImage: 0, 
        selectedVariantId: {{ $product->variants->first()?->id ?? 'null' }},
        variants: @js($product->variants),
        get selectedVariant() {
            return this.variants.find(v => v.id === this.selectedVariantId) || null;
        }
    }">
        <div class="w-full px-4 sm:px-8 lg:px-12 xl:px-16 pb-24">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-16">
                
                <!-- ── PRODUCT IMAGES (Swiper Carousel) ───────────────────────── -->
                <div class="w-full lg:w-[60%] flex flex-col md:flex-row-reverse gap-6"
                     x-init="
                        const mainSwiper = new Swiper('.main-swiper', {
                            spaceBetween: 10,
                            effect: 'fade',
                            fadeEffect: { crossFade: true },
                            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                        });
                        const thumbSwiper = new Swiper('.thumb-swiper', {
                            spaceBetween: 10,
                            slidesPerView: 4,
                            direction: 'horizontal',
                            breakpoints: {
                                768: { direction: 'vertical', slidesPerView: 5 }
                            },
                            watchSlidesProgress: true,
                            slideToClickedSlide: true,
                        });
                        mainSwiper.controller.control = thumbSwiper;
                        thumbSwiper.controller.control = mainSwiper;
                     ">
                    <!-- Main Image Display -->
                    <div class="flex-1 aspect-square bg-[#FAFAFA] overflow-hidden relative group">
                        <div class="swiper main-swiper w-full h-full">
                            <div class="swiper-wrapper">
                                @forelse($product->images as $img)
                                    <div class="swiper-slide flex items-center justify-center p-8">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" 
                                             class="w-full h-full object-contain mix-blend-multiply transition-transform duration-700 group-hover:scale-110" alt="{{ $product->name }}">
                                    </div>
                                @empty
                                    <div class="swiper-slide flex items-center justify-center p-8">
                                        <img src="https://placehold.co/800x1000?text={{ urlencode($product->name) }}" class="w-full h-full object-contain opacity-10" alt="Placeholder">
                                    </div>
                                @endforelse
                            </div>
                            <!-- Navigation Buttons -->
                            <div class="swiper-button-next !text-black !w-8 !h-8 after:!text-[12px] !bg-white/80 !rounded-full !shadow-sm opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <div class="swiper-button-prev !text-black !w-8 !h-8 after:!text-[12px] !bg-white/80 !rounded-full !shadow-sm opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>
                    </div>

                    <!-- Thumbnails -->
                    <div class="md:w-[15%]">
                        <div class="swiper thumb-swiper h-full">
                            <div class="swiper-wrapper">
                                @foreach($product->images as $img)
                                    <div class="swiper-slide cursor-pointer opacity-40 [&.swiper-slide-thumb-active]:opacity-100 [&.swiper-slide-thumb-active]:border-black transition-all duration-300 border-2 border-transparent bg-[#FAFAFA] p-2 aspect-square">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-contain mix-blend-multiply" alt="Thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ── PRODUCT DETAILS ───────────────────────────────────────── -->
                <div class="w-full lg:w-[40%] flex flex-col pt-2">
                    <div class="pb-10 border-b border-gray-100">
                        <h1 class="text-4xl lg:text-5xl font-serif text-gray-900 font-medium italic tracking-wide mb-2 mt-4">{{ $product->name }}</h1>
                        
                        <div class="flex flex-col gap-1 mb-8">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $product->category?->name ?? '' }}</span>
                            <span class="text-[11px] font-medium text-gray-500 uppercase tracking-widest">
                                {{ collect([$product->top_note, $product->heart_note, $product->base_note])->filter()->join(' · ') ?: 'Signature Composition' }}
                            </span>
                        </div>
                        
                        <div class="mt-8">
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-4">Select Size</span>
                            <div class="flex flex-wrap gap-3">
                                @foreach($product->variants as $variant)
                                    <button @click="selectedVariantId = {{ $variant->id }}"
                                            :class="selectedVariantId === {{ $variant->id }} ? 'bg-black text-white border-black' : 'bg-white text-gray-500 border-gray-200 hover:border-black'"
                                            class="px-6 py-2 border rounded-full text-[12px] font-medium transition-all duration-300">
                                        {{ $variant->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="flex items-baseline gap-4 mt-8 mb-8">
                            <span class="text-2xl font-black text-black tracking-widest uppercase">
                                RM <span x-text="selectedVariant ? Number(selectedVariant.retail_price).toFixed(2) : '{{ number_format($product->retail_price, 2) }}'"></span>
                            </span>
                        </div>

                        <div class="text-[13px] text-gray-500 font-medium leading-relaxed tracking-wide mb-10">
                            {{ $product->description }}
                        </div>

                        <div class="flex items-center gap-6">
                             <div class="flex items-center gap-2">
                                <span class="text-[11px] font-bold uppercase tracking-widest" :class="selectedVariant && selectedVariant.stock > 0 ? 'text-emerald-600' : 'text-red-500'">
                                    <span x-text="selectedVariant && selectedVariant.stock > 0 ? 'In Stock' : 'Out of Stock'"></span>
                                </span>
                             </div>
                        </div>
                    </div>

                    <!-- Add to Cart (AJAX Enabled) -->
                    <div class="py-10" x-data="{ 
                        adding: false, 
                        added: false,
                        quantity: 1,
                        async addToCart() {
                            this.adding = true;
                            try {
                                const response = await fetch('{{ route('cart.add') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Accept': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        product_id: {{ $product->id }},
                                        variant_id: this.selectedVariantId,
                                        quantity: this.quantity
                                    })
                                });
                                const data = await response.json();
                                if (data.success) {
                                    this.added = true;
                                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
                                    setTimeout(() => this.added = false, 2000);
                                }
                            } catch (error) {
                                console.error('Error adding to cart:', error);
                            } finally {
                                this.adding = false;
                            }
                        }
                    }">
                        <form @submit.prevent="addToCart">
                            <div class="flex flex-col gap-8">
                                <button type="submit" 
                                        :disabled="adding || added || !selectedVariant || selectedVariant.stock <= 0"
                                        class="w-full bg-black text-white px-12 py-4 text-sm font-medium hover:bg-gray-800 transition-all disabled:bg-gray-400 flex items-center justify-center gap-2">
                                    <template x-if="adding">
                                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </template>
                                    <span x-text="added ? 'ADDED TO CART ✓' : (adding ? 'ADDING...' : (selectedVariant && selectedVariant.stock > 0 ? 'ADD TO CART' : 'OUT OF STOCK'))"></span>
                                </button>
                                
                                <hr class="border-gray-100" />
                                
                                <div class="grid grid-cols-3 gap-3">
                                    <!-- Golden Guarantee -->
                                    <div class="border border-gray-200 rounded-2xl p-4 flex flex-col items-center justify-center text-center bg-white">
                                        <svg class="w-7 h-7 text-gray-900 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                        </svg>
                                        <p class="text-[11px] lg:text-[12px] font-bold text-gray-900 mb-1 leading-tight tracking-wide">Golden Guarantee</p>
                                        <p class="text-[9px] lg:text-[10px] text-gray-400">Return within 30 days</p>
                                    </div>

                                    <!-- High Stability -->
                                    <div class="border border-gray-200 rounded-2xl p-4 flex flex-col items-center justify-center text-center bg-white">
                                        <svg class="w-7 h-7 text-gray-900 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                                        </svg>
                                        <p class="text-[11px] lg:text-[12px] font-bold text-gray-900 mb-1 leading-tight tracking-wide">High Stability</p>
                                        <p class="text-[9px] lg:text-[10px] text-gray-400">Lasts for hours</p>
                                    </div>

                                    <!-- Fast Delivery -->
                                    <div class="border border-gray-200 rounded-2xl p-4 flex flex-col items-center justify-center text-center bg-white">
                                        <svg class="w-7 h-7 text-gray-900 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-4.446-3.51-8.31-7.962-8.447-4.062-.123-7.514 3.018-8.134 6.84a1.875 1.875 0 000 .375v2.25M17.25 18.75V11.25M17.25 18.75H6.75V11.25m10.5 0V7.5a3.75 3.75 0 10-7.5 0v3.75m0 0h7.5" />
                                        </svg>
                                        <p class="text-[11px] lg:text-[12px] font-bold text-gray-900 mb-1 leading-tight tracking-wide">Fast Delivery</p>
                                        <p class="text-[9px] lg:text-[10px] text-gray-400">within 6 hours.</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- ── DESCRIPTION & REVIEWS ────────────────────────────────────── -->
            <div class="mt-20" x-data="{ tab: 'description' }">
                <div class="flex">
                    <button @click="tab = 'description'" 
                            :class="tab === 'description' ? 'bg-white border-b-transparent' : 'bg-[#FAFAFA] text-gray-400'"
                            class="border border-gray-100 px-10 py-5 text-[11px] font-bold uppercase tracking-widest transition-all">
                        Description
                    </button>
                    <button @click="tab = 'reviews'" 
                            :class="tab === 'reviews' ? 'bg-white border-b-transparent' : 'bg-[#FAFAFA] text-gray-400'"
                            class="border border-gray-100 px-10 py-5 text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-3">
                        Reviews 
                        <span class="bg-gray-100 text-gray-900 px-2 py-0.5 rounded-full text-[9px]">{{ $product->reviews->count() }}</span>
                    </button>
                </div>
                
                {{-- Tab Content: Description --}}
                <div x-show="tab === 'description'" class="border border-gray-100 p-10 text-[14px] text-gray-500 leading-relaxed tracking-wide bg-white">
                    <p class="mb-6">{{ $product->description }}</p>
                    <p>Experience the ultimate fragrance journey with Laman Store. Crafted with precision and passion, this scent is designed for those who seek perfection in every detail.</p>
                </div>

                {{-- Tab Content: Reviews --}}
                <div x-show="tab === 'reviews'" class="border border-gray-100 bg-white overflow-hidden">
                    
                    {{-- Review Form (Only if verified buyer check passes in controller, but we show UI for all auth users) --}}
                    @auth
                        <div class="p-10 border-b border-gray-100 bg-[#FAFAFA]/50">
                            <h4 class="text-[12px] font-bold uppercase tracking-widest mb-8">Write a Review</h4>
                            <form action="{{ route('product.review', $product) }}" method="POST" class="space-y-6 max-w-2xl">
                                @csrf
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-4">Rating</label>
                                    <div class="flex gap-4" x-data="{ rating: {{ $userReview?->rating ?? 5 }}, hover: 0 }">
                                        <template x-for="i in 5">
                                            <button type="button" @click="rating = i" @mouseenter="hover = i" @mouseleave="hover = 0" class="focus:outline-none">
                                                <svg class="w-6 h-6 transition-colors" :class="(hover || rating) >= i ? 'text-black' : 'text-gray-200'" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        </template>
                                        <input type="hidden" name="rating" :value="rating">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-4">Your Experience</label>
                                    <textarea name="body" rows="4" placeholder="Describe the scent, longevity, and your general impression..." 
                                              class="w-full border-gray-100 bg-white text-[14px] focus:ring-black focus:border-black p-4 transition-all">{{ $userReview?->body }}</textarea>
                                </div>
                                <button type="submit" class="bg-black text-white px-10 py-4 text-[11px] font-bold uppercase tracking-[0.3em] hover:bg-gray-800 transition-all">
                                    {{ $userReview ? 'Update Review' : 'Post Review' }}
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="p-10 border-b border-gray-100 bg-[#FAFAFA]/50 text-center">
                            <p class="text-[12px] text-gray-400 font-medium tracking-wide">Please <a href="{{ route('login') }}" class="text-black font-bold border-b border-black">login</a> to leave a review.</p>
                        </div>
                    @endauth

                    {{-- Review List --}}
                    <div class="divide-y divide-gray-100">
                        @forelse($product->reviews as $review)
                            <div class="p-10 flex gap-8">
                                <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center flex-shrink-0">
                                    <span class="text-[11px] font-bold uppercase tracking-widest text-gray-400">
                                        {{ substr($review->user->name, 0, 2) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="flex items-center gap-4 mb-2">
                                        <p class="text-[13px] font-bold text-gray-900 tracking-tight">{{ $review->user->name }}</p>
                                        <div class="flex gap-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'text-black' : 'text-gray-100' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        @auth
                                            @if(auth()->id() === $review->user_id)
                                                <form action="{{ route('product.review.destroy', [$product, $review]) }}" method="POST" onsubmit="return confirm('Remove your review?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-[9px] uppercase tracking-widest text-gray-400 hover:text-red-500 transition-colors">
                                                        Remove
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-[11px] text-gray-400 uppercase tracking-widest mb-4">{{ $review->created_at->format('d M Y') }}</p>
                                    <div class="text-[14px] text-gray-600 leading-relaxed tracking-wide">
                                        {{ $review->body }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-24 text-center">
                                <p class="text-gray-300 font-luxury text-2xl italic">No reviews yet.</p>
                                <p class="text-[11px] text-gray-400 font-medium uppercase tracking-widest mt-2">Be the first to share your experience.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- ── RELATED PRODUCTS ────────────────────────────────────────── -->
            @if($relatedProducts->isNotEmpty())
                <div class="mt-32">
                    <div class="text-center mb-16">
                        <div class="inline-flex gap-4 items-center mb-4">
                            <p class="text-gray-400 text-3xl font-light uppercase tracking-widest">
                                YOU MAY <span class="text-gray-800 font-medium">ALSO LIKE</span>
                            </p>
                            <p class="w-12 h-[2px] bg-gray-800 sm:w-20"></p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-16">
                        @foreach($relatedProducts as $rel)
                            <x-product-card :product="$rel" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-storefront-layout>
