/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.{vue,html,js}"],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
}
