<div>
    <nav
        class="mt-0.5 flex h-10 border-b border-gray-200 bg-gray-50"
        aria-label="Breadcrumb"
    >
        <ol
            role="list"
            class="mx-auto flex w-full max-w-screen-xl space-x-4 px-4 sm:px-6 lg:px-8"
        >
            <li class="flex">
                <div class="flex items-center">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
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
