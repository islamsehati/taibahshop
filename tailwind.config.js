/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",    
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    'node_modules/preline/dist/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      screens: {
        'xs': '430px',
        // => @media (min-width: 450px) { ... }
      },
      fontFamily: {
        'lobster': ['"Lobster"', 'cursive'],
        'marko': ['"Marko One"', 'cursive'],
        'oleo': ['"Oleo Script"', 'cursive'],
        'bruno': ['"Bruno Ace SC"', 'cursive'],
      },
      animation: {
        'slidein300': 'slidein 1s ease 300ms',
        'slidein600': 'slidein 1s ease 600ms',
        'slidein900': 'slidein 1s ease 900ms',
        'slidein1200': 'slidein 1s ease 1200ms',
        'slidein1500': 'slidein 1s ease 1500ms',
        'slidein1800': 'slidein 1s ease 1800ms',
        'slidein2000': 'slidein 1s ease 2000ms',
        'bounceslow': 'bounce 5s infinite',
        'infinite-scroll': 'infinite-scroll 90s linear infinite',
      },
      keyframes: {
        slidein: {
          from: {
            opacity: "0",
            transform: "translateY(-20px)",
          },
          to: {
            opacity: "1",
            transform: "translateY(0)",
          },
        },
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

