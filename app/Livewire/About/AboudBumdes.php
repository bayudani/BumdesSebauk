<?php

namespace App\Livewire\About;

use App\Models\structure_bumdes;
use Livewire\Component;

class AboudBumdes extends Component
{
    public function render()
    {
        // 2. Ambil semua data pejabat dari database
        $officials = structure_bumdes::whereIn('position', ['Kepala Desa', 'Direktur Bumdes'])
                            ->orderBy('id') // Urutkan agar konsisten (misal: Kepala Desa selalu pertama)
                            ->get();

        // 3. Kirim data ke view
        return view('livewire.about.aboud-bumdes', [
            'officials' => $officials
        ]);
    }
}
