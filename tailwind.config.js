import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                customYellow: "#F2B203",
                hovercustomYellow: "#F6C133",
                bgPurple: "#F5EFFF",
                bgGray: "#F1F1F1",
                lightgray: "#A6A6A6",
                darkPurple: "#2E073F",
                darkRed: "#AD192A",
                lightRed: "#B5535E",
            },
        },
    },

    plugins: [forms],
};
6;
