<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>

<!-- Navbar -->
<header class="bg-white shadow-sm w-full">
  <nav class="max-w-screen-xl mx-auto flex items-center justify-between px-6 py-4">
    <!-- KIRI: Tulisan DesaSebauk -->
    <div class="text-xl font-bold text-black">DesaSebauk</div>

    <!-- TENGAH: Menu Navigasi besar, hitam, dan jarak lebih lebar -->
    <ul class="flex items-center gap-8 text-base font-semibold text-black">
      <li class="hover:text-green-700 cursor-pointer">Home</li>
      <li class="hover:text-green-700 cursor-pointer">Produk</li>
      <li class="hover:text-green-700 cursor-pointer">Artikel</li>
    </ul>
  </nav>
</header>
