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
      colors: {
        'primary-blue': '#133E87',
        'second-blue': '#608BC1',
        'light-blue': '#CBDCEB',
      },
    },
  },
  plugins: [],
}
