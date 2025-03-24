import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    // server: {
    //     host: "0.0.0.0", // Allows access from other devices on the network
    //     port: 5173, // Ensure it uses the correct port
    //     strictPort: true, // Prevent Vite from changing the port automatically
    //     hmr: {
    //         host: "192.168.1.70", // Replace with your actual local IPv4 address
    //     },
    // },
});
