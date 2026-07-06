/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'admin-bg': '#f3f4f6', // Gray 100
        'admin-sidebar': '#1e293b', // Slate 800
        'admin-primary': '#2563eb', // Blue 600
        'admin-text': '#334155', // Slate 700
      },
      fontFamily: {
        'sans': ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      }
    },
  },
  plugins: [],
}