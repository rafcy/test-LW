import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.ts',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                  50: '#f0f9ff',
                  100: '#e0f2fe',
                  300: '#7dd3fc',
                  400: '#38bdf8',
                  500: '#0ea5e9',
                  600: '#0284c7',
                  700: '#0369a1',
                  800: '#075985',
                  900: '#0c4a6e',
                },
                secondary: {
                  50: '#f8fafc',
                  100: '#f1f5f9',
                  200: '#e2e8f0',
                  300: '#cbd5e1',
                  400: '#94a3b8',
                  500: '#64748b',
                  600: '#475569',
                  700: '#334155',
                  800: '#1e293b',
                  900: '#0f172a',
                },
                accent: {
                  50: '#eff6ff',
                  100: '#dbeafe',
                  200: '#bfdbfe',
                  300: '#93c5fd',
                  400: '#60a5fa',
                  500: '#3b82f6',
                  600: '#2563eb',
                  700: '#1d4ed8',
                  800: '#1e40af',
                  900: '#1e3a8a',
                }
              },
        },
    },
    plugins: [],
};
