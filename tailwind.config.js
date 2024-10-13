/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        container: {
            center: true,
            maxWidth: '1248px',
            padding: '24px'
        },
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

