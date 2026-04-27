<x-storefront-layout title="Your Recommendations">
    <div class="max-w-7xl mx-auto py-20 px-4 sm:px-8">
        <div class="text-center mb-16">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-4 block">Discovery Results</span>
            <h1 class="text-4xl md:text-6xl font-serif text-black leading-tight">Handpicked for You</h1>
            <p class="text-gray-500 mt-6 max-w-xl mx-auto font-light leading-relaxed">Based on your preferences, we believe these fragrances will perfectly complement your unique aura.</p>
            @if(!empty($answers))
                <div class="mt-6 flex flex-wrap items-center justify-center gap-2">
                    @if(!empty($answers['vibe']))
                        <span class="text-[10px] uppercase tracking-widest px-3 py-1 rounded-full bg-gray-100 text-gray-700">{{ $answers['vibe'] }}</span>
                    @endif
                    @if(!empty($answers['intensity']))
                        <span class="text-[10px] uppercase tracking-widest px-3 py-1 rounded-full bg-gray-100 text-gray-700">{{ $answers['intensity'] }}</span>
                    @endif
                    @if(!empty($answers['time']))
                        <span class="text-[10px] uppercase tracking-widest px-3 py-1 rounded-full bg-gray-100 text-gray-700">{{ $answers['time'] }}</span>
                    @endif
                </div>
            @endif
        </div>

        @if($recommendations->isEmpty())
            <div class="text-center py-20 bg-[#FAFAFA] rounded-[40px]">
                <p class="text-gray-400 font-serif text-2xl italic">No exact matches found...</p>
                <a href="{{ route('storefront.collection') }}" class="inline-block mt-8 text-xs font-black uppercase tracking-widest border-b-2 border-black pb-1 hover:pb-2 transition-all">Explore Full Collection</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($recommendations as $product)
                    <div class="group">
                        <a href="{{ route('storefront.show', $product->slug) }}" class="block">
                            <div class="aspect-[4/5] bg-[#FAFAFA] rounded-[32px] overflow-hidden mb-6 relative">
                                <img src="{{ asset('storage/' . ($product->images->first()->image_path ?? '')) }}" 
                                     class="w-full h-full object-contain mix-blend-multiply transition-transform duration-700 group-hover:scale-110 p-12" 
                                     onerror="this.src='https://placehold.co/800x1000?text={{ urlencode($product->name) }}'">
                                
                                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            
                            <div class="text-center">
                                <h3 class="text-lg font-serif text-black mb-1 group-hover:underline">{{ $product->name }}</h3>
                                <p class="text-[11px] text-gray-400 uppercase tracking-widest font-medium">
                                    From RM{{ number_format($product->variants->min('retail_price'), 2) }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-20 text-center">
                <a href="{{ route('storefront.scent-finder') }}" class="text-xs font-black uppercase tracking-[0.2em] bg-black text-white px-10 py-5 rounded-full hover:scale-105 transition-transform inline-block shadow-xl">
                    Retake the Quiz
                </a>
            </div>
        @endif
    </div>
</x-storefront-layout>
