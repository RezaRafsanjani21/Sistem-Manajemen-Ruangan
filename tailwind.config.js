/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        'blue-light': '#E0F2FE',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
