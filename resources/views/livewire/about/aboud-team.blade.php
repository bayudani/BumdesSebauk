<section class="py-12 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Struktur Bumdes</h2>

        {{-- Cek apakah data kepala desa ada --}}
        @if ($kepalaDesa)
            <div class="flex flex-col items-center mb-12">
                {{-- Gunakan foto dari database, jika tidak ada, pakai foto default --}}
                <img src="{{ $kepalaDesa->photo ? Storage::url($kepalaDesa->photo) : asset('assets/images/default-avatar.png') }}"
                    alt="{{ $kepalaDesa->name }}"
                    class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg mb-4">
                <h3 class="text-2xl font-semibold">{{ $kepalaDesa->name }}</h3>
                <p class="text-blue-600 font-medium text-lg">{{ $kepalaDesa->position }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 justify-items-center">

            @if ($sekretarisDesa)
                <div class="flex flex-col items-center">
                    <img src="{{ $sekretarisDesa->photo ? Storage::url($sekretarisDesa->photo) : asset('assets/images/default-avatar.png') }}"
                        alt="{{ $sekretarisDesa->name }}"
                        class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">{{ $sekretarisDesa->name }}</h3>
                    <p class="text-blue-600 font-medium text-lg">{{ $sekretarisDesa->position }}</p>
                </div>
            @endif

            @if ($bendaharaDesa)
                <div class="flex flex-col items-center">
                    <img src="{{ $bendaharaDesa->photo ? Storage::url($bendaharaDesa->photo) : asset('assets/images/default-avatar.png') }}"
                        alt="{{ $bendaharaDesa->name }}"
                        class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">{{ $bendaharaDesa->name }}</h3>
                    <p class="text-blue-600 font-medium text-lg">{{ $bendaharaDesa->position }}</p>
                </div>
            @endif

        </div>
    </div>
</section>
