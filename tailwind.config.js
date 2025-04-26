// tailwind.config.js
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          primary: '#3b82f6', // This is a blue color similar to blue-500
        }
      },
    },
    plugins: [],
  }