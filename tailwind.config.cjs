/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backgroundColor: {
                // 'custom-blue': '#aed3f7',
                'custom-blue': '#00BFD6',
                'custom-yellow': '#f4ec4c',
                'new-blue': '#5b8fa9',
                'new-yellow': '#fbbc00',
                'line-color': '#5b8fa9'
            },
            textColor: {
                'custom-blue': '#aed3f7',
                'custom-yellow': '#f4ec4c',
                'new-yellow': '#fbbc00',
                'line-color': '#5b8fa9'
            }
        },
    },
    plugins: [],
}
