<div x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => {
    localStorage.setItem('darkMode', val);
    if (val) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
});
if (darkMode) {
    document.documentElement.classList.add('dark');
}">
    <button
        @click="darkMode = !darkMode"
        type="button"
        class="relative inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-600 hover:bg-primary-50 hover:text-primary-700 transition-colors duration-200 dark:text-slate-300 dark:hover:bg-slate-700 dark:hover:text-primary-400"
        :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
    >
        <!-- Sun Icon (shown in dark mode) -->
        <svg
            x-show="darkMode"
            x-cloak
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"
            />
        </svg>

        <!-- Moon Icon (shown in light mode) -->
        <svg
            x-show="!darkMode"
            x-cloak
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"
            />
        </svg>
    </button>
</div>
