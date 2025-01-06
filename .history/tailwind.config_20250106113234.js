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
      fontFamily: {
        'culpa': ['"Mea Culpa"', 'cursive']
    },
      animation: {
        'bounceslow': 'bounce 5s infinite',
        'infinite-scroll': 'infinite-scroll 90s linear infinite',
      },
      keyframes: {
        bounceslow: {
          '0%, 100%': { transform: 'translateY(-25%)' },
          '50%': { transform: 'translateY(0)' },
        },
        'infinite-scroll': {
          from: { transform: 'translateX(0)' },
          to: { transform: 'translateX(-100%)' },
        },
      },   
    },
  },
  plugins: [
    require('preline/plugin'),
  ],
}

