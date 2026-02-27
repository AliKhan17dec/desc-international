module.exports = {
    content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
    theme: {
        extend: {
            colors: {
                'crypto-accent': '#1fb6ff'
            }
        }
    },
    plugins: [],
}
import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./resources/js/**/*.js",
    ],
    darkMode: "selector",

    theme: {
        extend: {
            colors: {
                crypto: {
                    primary: "#dfff00",
                    // primary: "#f0bb0b",
                    accent: "#131314",
                    dark: "#0a0a0b",
                    card: "#1a1a1c",
                    border: "#2a2a2c"
                },
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
