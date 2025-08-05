import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import aspectRatio from '@tailwindcss/aspect-ratio'
import containerQueries from '@tailwindcss/container-queries'
import lineClamp from '@tailwindcss/line-clamp'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    'node_modules/flowbite/**/*.js'
  ],
  safelist: [
    'hidden',
    'block',
    'group-hover:block',
    'text-white',
    'text-gray-800',
    'hover:text-orange-500',
    'bg-primary',
    'rounded-md',
    'rounded-full',
    'font-sans',
    'font-medium',
    'font-semibold',
    'font-extrabold',
    'text-sm',
    'text-lg',
    'text-xl',
    'text-2xl',
    'text-4xl',
    'text-5xl',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#f06425',
        'primary-dark': '#e14e0f',
      },
      fontFamily: {
        sans: ['"Mona Sans"', 'sans-serif'],
      },
    },
  },
  plugins: [
    forms,
    typography,
    aspectRatio,
    containerQueries,
    lineClamp,
  ],
}
