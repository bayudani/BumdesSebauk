<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
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
    <header class="flex shadow-md py-4 px-4 sm:px-10 bg-white min-h-[70px] tracking-wide relative z-50 sticky top-0">
        <div class="flex flex-wrap items-center justify-between gap-5 w-full">
            <a href="{{ route('home') }}" class="max-sm:hidden"><img src="{{ asset('assets/images/bumdes.png') }}"
                    alt="logo" class="w-36" /></a>
            <a href="{{ route('home') }}" class="hidden max-sm:block font-bold"><img
                    src="{{ asset('assets/images/bumdes.png') }}" alt="logo" class="w-9" /></a>

            <div class="flex items-center gap-x-5">
                <div id="collapseMenu"
                    class="max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50">
                    <button id="toggleClose"
                        class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border border-gray-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black"
                            viewBox="0 0 320.591 320.591">
                            <path
                                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                                data-original="#000000"></path>
                            <path
                                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                                data-original="#000000"></path>
                        </svg>
                    </button>

                    <ul
                        class="lg:flex gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
                        <li class="mb-6 hidden max-lg:block">
                            <a href="{{ route('home') }}" class="font-bold">BUMDESmart</a>
                        </li>
                        <li class="max-lg:border-b max-lg:py-3">
                            <a href="{{ route('home') }}"
                                class="block font-medium text-[15px] hover:text-purple-600 {{ request()->routeIs('home') ? 'text-purple-600' : 'text-slate-900' }}"
                                wire:navigate>{{ __('Home') }}</a>
                        </li>
                        <li class="max-lg:border-b max-lg:py-3">
                            <a href="{{ route('product') }}"
                                class="block font-medium text-[15px] hover:text-purple-600 {{ request()->routeIs('product') ? 'text-purple-600' : 'text-slate-900' }}"
                                wire:navigate>{{ __('Produk') }}</a>
                        </li>
                        <li class="max-lg:border-b max-lg:py-3">
                            <a href="{{ route('articles') }}"
                                class="block font-medium text-[15px] hover:text-purple-600 {{ request()->routeIs('articles') ? 'text-purple-600' : 'text-slate-900' }}"
                                wire:navigate>{{ __('Berita') }}</a>
                        </li>
                        <li class="max-lg:border-b max-lg:py-3">
                            <a href="{{ route('tracking') }}"
                                class="block font-medium text-[15px] hover:text-purple-600 {{ request()->routeIs('tracking') ? 'text-purple-600' : 'text-slate-900' }}"
                                wire:navigate>{{ __('Tentang kami') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="flex items-center max-lg:ml-auto space-x-4">
                    
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center gap-x-2 px-4 py-2 text-sm rounded-full font-medium cursor-pointer tracking-wide text-slate-900 border border-gray-400 bg-transparent hover:bg-gray-50">
                                <span>Hi, {{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                    
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50"
                                style="display: none;">
                                
                                <a href="{{ route('profile') }}" wire:navigate class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profile
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Transaksi Saya
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <button wire:click="logout" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Logout
                                </button>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" wire:navigate
                            class="px-4 py-2 text-sm rounded-full font-medium cursor-pointer tracking-wide text-slate-900 border border-gray-400 bg-transparent hover:bg-gray-50">
                            Login
                        </a>
                        <a href="{{ route('register') }}" wire:navigate
                            class="px-4 py-2 text-sm rounded-full font-medium cursor-pointer tracking-wide text-white border border-purple-600 bg-purple-600 hover:bg-purple-700">
                            Sign up
                        </a>
                    @endauth

                    <button id="toggleOpen" class="lg:hidden cursor-pointer">
                        <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <script>
        var toggleOpen = document.getElementById('toggleOpen');
        var toggleClose = document.getElementById('toggleClose');
        var collapseMenu = document.getElementById('collapseMenu');

        function handleClick() {
            if (collapseMenu.style.display === 'block') {
                collapseMenu.style.display = 'none';
            } else {
                collapseMenu.style.display = 'block';
            }
        }

        toggleOpen.addEventListener('click', handleClick);
        toggleClose.addEventListener('click', handleClick);
    </script>
</div>