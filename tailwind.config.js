module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        'yuma': {
          100: '#fcf5e1',
          200: '#cabb8e',
          300: '#e0b55d',
          400: '#d2ad64',
          900: '#c49637',
        },
      },
      padding: { "fluid-video": "56.25%" },
    }
  },
  variants: {
    backgroundColor: ['responsive', 'odd', 'even', 'hover', 'focus', 'active'],
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
    cursor: ['responsive', 'hover', 'focus', 'disabled'],
  },
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
