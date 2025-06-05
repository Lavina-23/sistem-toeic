import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                    primary: '#00247D',       // Biru tua
                    redMain: '#CF142B',       // Merah utama
                    yellowAccent: '#F2AB19',  // Kuning aksen
                    redAlert: '#EA1E1E',      // Merah alert/lebih terang
                    white: '#FFFFFF',
                    redMain: '#CF142B',      // Merah utama
                    redDark: '#A60000',      // Merah gelap         // Putih
                    primaryLight: '#6B8ED6',   // biru muda banget
                    primaryMid: '#3554A4',     // biru medium
            },
        },
    },

    plugins: [forms],
};
