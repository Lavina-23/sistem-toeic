import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

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
                primary: '#00247D',        // Biru tua
                primaryLight: '#6B8ED6',   // Biru muda banget
                primaryMid: '#3554A4',     // Biru medium

                redMain: '#CF142B',        // Merah utama
                redDark: '#A60000',        // Merah gelap
                redAlert: '#EA1E1E',       // Merah alert/lebih terang

                yellowAccent: '#F2AB19',   // Kuning aksen

                white: '#FFFFFF',          // Putih
                bone: '#e9dfd0',           // Warna tulang
            },
        },
    },

    plugins: [forms],
};
