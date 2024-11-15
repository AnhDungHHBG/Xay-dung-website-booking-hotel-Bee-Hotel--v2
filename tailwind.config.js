/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./clients/**/*.php",
    "./admin/**/*.php",
    "./*.php",
  ],
  theme: {
    extend: {
      fontSize: {
        'body': '16px',
        'logo': '35px',
      },
    },
  },
  plugins: [],
}
