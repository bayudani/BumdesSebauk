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

<nav class="mx-auto mt-[30px] flex max-h-12 w-full max-w-[1130px] items-center justify-between">
            <div class="flex gap-[30px]">
                <div class="h-[46px] w-[137px] shrink-0 overflow-hidden">
                    <img class="h-full w-full object-contain" src="assets/images/logos/maga-portal-logo.png" alt="" />
                </div>
                <div class="h-12 w-px shrink-0 bg-[#E8EBF4]"></div>
                <form class="relative w-[450px]">
                    <label for="search" class="pointer-events-none flex">
                        
                    </label>
                    <input
                        class="w-full rounded-full px-[50px] py-3 font-semibold ring-1 ring-[#E8EBF4] transition-all duration-300 placeholder:font-normal focus:outline-none focus:ring-2 focus:ring-maga-orange"
                        type="text"
                        name="search"
                        placeholder="Search hot trendy news today..."
                    />
                </form>
            </div>
            <div class="flex gap-3">
                
            </div>
        </nav>

        <nav id="categories" class="mx-auto mt-[30px] flex max-h-12 w-full max-w-[1130px] items-center justify-between gap-4">
            <a href="">
                <div class="flex gap-[10px] rounded-full px-[22px] py-3 ring-1 ring-[#E8EBF4] transition-all duration-300 hover:ring-2 hover:ring-maga-orange">
                    
                    <p class="text-center font-semibold">Home</p>
                </div>
            </a>
            <a href="">
                <div class="flex gap-[10px] rounded-full px-[22px] py-3 ring-1 ring-[#E8EBF4] transition-all duration-300 hover:ring-2 hover:ring-maga-orange">
                   
                    <p class="text-center font-semibold">Artikel</p>
                </div>
            </a>
            <a href="">
                <div class="flex gap-[10px] rounded-full px-[22px] py-3 ring-1 ring-[#E8EBF4] transition-all duration-300 hover:ring-2 hover:ring-maga-orange">
                
                    <p class="text-center font-semibold">Product</p>
                </div>
            </a>
        </nav>
</div>
