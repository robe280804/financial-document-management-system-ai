import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Livewire/**",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
        "./vendor/livewire/flux/stubs/**/*.blade.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                accent: "#262626",
            },
            fontFamily: {
                sans: ["Instrument Sans", "ui-sans-serif", "system-ui"],
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
