/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    'node_modules/preline/dist/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      animation: {
        'bounceslow': 'bounce 5s infinite',
      },
      keyframes: {
        bounceslow: {
          '0%, 100%': { transform: 'translateY(-25%)' },
          '50%': { transform: 'translateY(0)' },
        }
      }
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

