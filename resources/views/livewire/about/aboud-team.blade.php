<section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Visi & Misi</h2>

        {{-- Ketua --}}
        @if ($ketua)
            <div class="flex flex-col items-center mb-16">
                <img src="{{ $ketua->photo ? Storage::url($ketua->photo) : asset('assets/images/default-avatar.png') }}"
                     alt="{{ $ketua->name }}"
                     class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-lg mb-4">
                <h3 class="text-2xl font-semibold">{{ $ketua->name }}</h3>
                <p class="text-blue-600 font-medium text-lg mb-6">{{ $ketua->position }}</p>

                <div class="bg-white shadow-md rounded-xl p-6 text-center max-w-2xl">
                    <h4 class="text-xl font-semibold mb-2">Visi</h4>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Meningkatkan kesejahteraan masyarakat desa melalui pengelolaan BUMDes yang profesional.
                    </p>

                    <h4 class="text-xl font-semibold mb-2">Misi</h4>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 text-left">
                        <li>Mengembangkan unit usaha desa yang berdaya saing.</li>
                        <li>Meningkatkan pendapatan asli desa.</li>
                        <li>Memberdayakan potensi masyarakat secara berkelanjutan.</li>
                    </ul>
                </div>
            </div>
        @endif

        {{-- Sekretaris & Bendahara --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-12 justify-items-center">
            {{-- Sekretaris --}}
            @if ($sekretaris)
                <div class="flex flex-col items-center">
                    <img src="{{ $sekretaris->photo ? Storage::url($sekretaris->photo) : asset('assets/images/default-avatar.png') }}"
                         alt="{{ $sekretaris->name }}"
                         class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">{{ $sekretaris->name }}</h3>
                    <p class="text-blue-600 font-medium text-lg mb-6">{{ $sekretaris->position }}</p>

                    <div class="bg-white shadow-md rounded-xl p-6 text-center w-full">
                        <h4 class="text-xl font-semibold mb-2">Visi</h4>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Mewujudkan administrasi BUMDes yang rapi, tertib, dan transparan.
                        </p>

                        <h4 class="text-xl font-semibold mb-2">Misi</h4>
                        <ul class="list-disc list-inside text-gray-700 space-y-2 text-left">
                            <li>Menyusun laporan kegiatan dan keuangan secara berkala.</li>
                            <li>Mengelola arsip dan dokumen penting BUMDes.</li>
                            <li>Meningkatkan sistem informasi administrasi.</li>
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Bendahara --}}
            @if ($bendahara)
                <div class="flex flex-col items-center">
                    <img src="{{ $bendahara->photo ? Storage::url($bendahara->photo) : asset('assets/images/default-avatar.png') }}"
                         alt="{{ $bendahara->name }}"
                         class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-lg mb-4">
                    <h3 class="text-2xl font-semibold">{{ $bendahara->name }}</h3>
                    <p class="text-blue-600 font-medium text-lg mb-6">{{ $bendahara->position }}</p>

                    <div class="bg-white shadow-md rounded-xl p-6 text-center w-full">
                        <h4 class="text-xl font-semibold mb-2">Visi</h4>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Mengelola keuangan BUMDes dengan akuntabilitas dan transparansi tinggi.
                        </p>

                        <h4 class="text-xl font-semibold mb-2">Misi</h4>
                        <ul class="list-disc list-inside text-gray-700 space-y-2 text-left">
                            <li>Mencatat seluruh pemasukan dan pengeluaran secara rinci.</li>
                            <li>Menyusun laporan keuangan bulanan dan tahunan.</li>
                            <li>Menjaga keamanan dan keteraturan kas BUMDes.</li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
