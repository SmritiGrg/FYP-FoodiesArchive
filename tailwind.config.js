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
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                figtree: ["Figtree", "sans-serif"],
            },
            colors: {
                customYellow: "#F2B203",
                yellowStroke: "#FFD256",
                hovercustomYellow: "#F6C133",
                bgPurple: "#F5EFFF",
                bgGray: "#F1F1F1",
                lightgray: "#A6A6A6",
                darkPurple: "#2E073F",
                lightPurple: "#441856",
                darkRed: "#AD192A",
                lightRed: "#B5535E",
                stepGray: "#CECCD0",
            },
        },
    },

    plugins: [forms],
};
6;
