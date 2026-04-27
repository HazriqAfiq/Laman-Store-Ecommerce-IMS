<x-storefront-layout title="Scent Finder">
    <div class="min-h-[80vh] flex flex-col items-center justify-center py-20 px-4" x-data="{ 
        step: 0,
        answers: {
            vibe: '',
            intensity: '',
            time: ''
        },
        submit() {
            $refs.form.submit();
        }
    }">
        <form x-ref="form" action="{{ route('storefront.scent-finder.results') }}" method="POST">
            @csrf
            <template x-for="(value, key) in answers">
                <input type="hidden" :name="'answers['+key+']'" :value="value">
            </template>
        </form>

        <!-- ── STEP 0: INTRO ────────────────────────────────────────── -->
        <div x-show="step === 0" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-2xl text-center">
            <h1 class="text-5xl md:text-7xl font-serif text-black mb-8 leading-tight">Find Your <br>Signature Scent</h1>
            <p class="text-gray-500 text-lg mb-12 font-light leading-relaxed">Answer a few questions and our scent experts will curate a selection of fragrances tailored to your personality.</p>
            <button @click="step = 1" class="px-12 py-5 bg-black text-white text-xs font-black uppercase tracking-[0.2em] rounded-full hover:bg-gray-900 transition-all shadow-xl hover:shadow-black/20">
                Begin Discovery
            </button>
        </div>

        <!-- ── STEP 1: VIBE ─────────────────────────────────────────── -->
        <div x-show="step === 1" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="w-full max-w-4xl text-center">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-4 block">Question 01</span>
            <h2 class="text-4xl md:text-5xl font-serif text-black mb-12">What atmosphere do you prefer?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <button @click="answers.vibe = 'fresh'; step = 2" class="group relative aspect-[4/5] bg-[#FAFAFA] rounded-3xl overflow-hidden p-8 flex flex-col items-center justify-end hover:bg-black transition-all duration-500">
                    <span class="text-lg font-serif text-black group-hover:text-white transition-colors">Fresh & Crisp</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Citrus, Ocean, Bergamot</span>
                </button>
                <button @click="answers.vibe = 'woody'; step = 2" class="group relative aspect-[4/5] bg-[#FAFAFA] rounded-3xl overflow-hidden p-8 flex flex-col items-center justify-end hover:bg-black transition-all duration-500">
                    <span class="text-lg font-serif text-black group-hover:text-white transition-colors">Warm & Woody</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Sandalwood, Oud, Cedar</span>
                </button>
                <button @click="answers.vibe = 'floral'; step = 2" class="group relative aspect-[4/5] bg-[#FAFAFA] rounded-3xl overflow-hidden p-8 flex flex-col items-center justify-end hover:bg-black transition-all duration-500">
                    <span class="text-lg font-serif text-black group-hover:text-white transition-colors">Floral & Delicate</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Rose, Jasmine, Lavender</span>
                </button>
            </div>
        </div>

        <!-- ── STEP 2: INTENSITY ───────────────────────────────────── -->
        <div x-show="step === 2" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="w-full max-w-4xl text-center">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-4 block">Question 02</span>
            <h2 class="text-4xl md:text-5xl font-serif text-black mb-12">How intense should it feel?</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                <button @click="answers.intensity = 'subtle'; step = 3" class="group py-12 bg-[#FAFAFA] rounded-3xl flex flex-col items-center hover:bg-black transition-all duration-500">
                    <span class="text-2xl font-serif text-black group-hover:text-white transition-colors">Subtle Presence</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Soft, Clean, Understated</span>
                </button>
                <button @click="answers.intensity = 'bold'; step = 3" class="group py-12 bg-[#FAFAFA] rounded-3xl flex flex-col items-center hover:bg-black transition-all duration-500">
                    <span class="text-2xl font-serif text-black group-hover:text-white transition-colors">Bold Statement</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Deep, Rich, Dramatic</span>
                </button>
            </div>
        </div>

        <!-- ── STEP 3: TIME ─────────────────────────────────────────── -->
        <div x-show="step === 3" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0" class="w-full max-w-4xl text-center">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 mb-4 block">Question 03</span>
            <h2 class="text-4xl md:text-5xl font-serif text-black mb-12">When will you wear this scent?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                <button @click="answers.time = 'day'; submit()" class="group py-12 bg-[#FAFAFA] rounded-3xl flex flex-col items-center hover:bg-black transition-all duration-500">
                    <span class="text-2xl font-serif text-black group-hover:text-white transition-colors">Daytime Clarity</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Light, Airy, Energetic</span>
                </button>
                <button @click="answers.time = 'night'; submit()" class="group py-12 bg-[#FAFAFA] rounded-3xl flex flex-col items-center hover:bg-black transition-all duration-500">
                    <span class="text-2xl font-serif text-black group-hover:text-white transition-colors">Evening Allure</span>
                    <span class="text-xs text-gray-400 mt-2 uppercase tracking-widest group-hover:text-gray-500">Deep, Intense, Sensual</span>
                </button>
            </div>
        </div>
    </div>
</x-storefront-layout>
