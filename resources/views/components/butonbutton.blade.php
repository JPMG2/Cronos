<div class="group fixed bottom-6 end-6">
    <button
        {{ $attributes }}
        type="button"
        data-dial-toggle="speed-dial-menu-square"
        aria-controls="speed-dial-menu-square"
        aria-expanded="false"
        class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-700 text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
        <svg
            class="h-5 w-5 transition-transform"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 18 18"
        >
            <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 1v16M1 9h16"
            />
        </svg>
    </button>
</div>
