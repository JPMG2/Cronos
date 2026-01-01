<div class="mb-6">
    <nav
        class="flex h-12 w-full border-b border-slate-200 bg-white shadow-sm"
        aria-label="Breadcrumb"
    >
        <ol
            role="list"
            class="flex w-full max-w-full items-center space-x-2 px-6 overflow-x-auto"
        >
            <li class="flex">
                <div class="flex items-center">
                    <a href="#" class="text-slate-500 hover:text-primary-600 transition-colors" title="Inicio">
                        <svg
                            class="h-5 w-5 flex-shrink-0"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="sr-only">Home</span>
                    </a>
                </div>
            </li>
            {{ $slot }}
        </ol>
    </nav>
</div>
