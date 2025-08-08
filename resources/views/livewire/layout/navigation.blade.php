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
}; 
?>

<div>

<!-- Navbar -->
<header class="bg-white shadow-sm w-full">
  <nav class="max-w-screen-xl mx-auto flex items-center justify-between px-6 py-4">
    <!-- KIRI: Tulisan DesaSebauk -->
    <div class="text-xl font-bold text-black">BUMDESmart</div>

    <!-- TENGAH: Menu Navigasi besar, hitam, dan jarak lebih lebar -->
    <ul class="flex items-center gap-8 text-base font-semibold text-black">
      <li class="hover:text-green-700 cursor-pointer"><x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                                class="hover:bg-secondary-50 dark:hover:bg-secondary-900/20 rounded-md transition-all duration-200"
                                wire:navigate>{{ __('Home') }}</x-nav-link></li>
      <li class="hover:text-green-700 cursor-pointer"><x-nav-link :href="route('product')" :active="request()->routeIs('product')"
                                class="hover:bg-secondary-50 dark:hover:bg-secondary-900/20 rounded-md transition-all duration-200"
                                wire:navigate>{{ __('Produk') }}</x-nav-link></li>
      <li class="hover:text-green-700 cursor-pointer"><x-nav-link :href="route('articles')" :active="request()->routeIs('Berita')"
                                class="hover:bg-secondary-50 dark:hover:bg-secondary-900/20 rounded-md transition-all duration-200"
                                wire:navigate>{{ __('Berita') }}</x-nav-link></li>
     
    </ul>
  </nav>
</header>
