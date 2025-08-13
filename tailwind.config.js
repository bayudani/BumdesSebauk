import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './app/Livewire/**/*.php', // Dan ini juga penting buat komponen PHP

    ],
    safelist: [
        'bg-green-500',
        'bg-green-600',
        'bg-green-700',
        'bg-red-500',
        'text-green-700',
        // Tambahkan semua class warna atau style lain yang hilang di sini
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "maga-black": "#070707",
                "maga-gray": "#6A7789",
                "maga-orange": "#FF6B18",
                "primary": "#0D5CD7",
                "secondary": "#FFC736",
            },
        },
    },

    plugins: [forms],
};

