<?php

namespace App\Livewire\About;

use App\Models\structure_bumdes as TeamMember; // Menggunakan alias 'TeamMember' agar lebih rapi
use Livewire\Component;

class AboudTeam extends Component
{
    // Siapkan properti untuk menampung data dari setiap posisi
    public $kepalaDesa;
    public $sekretarisDesa;
    public $bendaharaDesa;

    /**
     * Method mount() akan berjalan sekali saat komponen dimuat.
     * Ini adalah tempat terbaik untuk mengambil data dari database.
     */
    public function mount()
    {
        // Ambil data spesifik untuk setiap posisi
        $this->kepalaDesa = TeamMember::where('position', 'Kepala Desa')->first();
        $this->sekretarisDesa = TeamMember::where('position', 'Sekretaris Desa')->first();
        $this->bendaharaDesa = TeamMember::where('position', 'Bendahara Desa')->first();
    }

    public function render()
    {
        return view('livewire.about.aboud-team');
    }
}