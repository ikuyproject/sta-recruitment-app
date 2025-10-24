import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // --- นี่คือส่วนที่เราเพิ่มเข้ามา ---
            colors: {
                'sta-yellow': '#FFD700', // สีเหลือง (ปรับค่าได้ตามชอบ)
                'sta-dark': '#2D2D2D',   // สีเทาเข้มเกือบดำ (สำหรับกล่องฟอร์ม)
                'sta-dark-bg': '#1A1A1A', // สีพื้นหลัง (ดำ)
            },
            // ---------------------------------
        },
    },

    plugins: [forms],
};