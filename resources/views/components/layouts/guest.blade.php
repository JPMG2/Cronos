<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name") }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />

        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />
        <!-- stylesheet -->
        <link
            href="https://cdn.jsdelivr.net/npm/daisyui@4.11.1/dist/full.min.css"
            rel="stylesheet"
            type="text/css"
        />
        <script
            defer
            src="https://unpkg.com/alpinejs@3.4.2/dist/cdn.min.js"
        ></script>
        <script
            defer
            src="https://unpkg.com/@alpinejs/collapse@3.4.2/dist/cdn.min.js"
        ></script>

        <!-- Scripts -->
        @vite(["resources/css/app.css"])
    </head>
    <body>
        <div
            class="flex min-h-screen w-full items-center justify-center bg-gray-200"
        >
            <div class="w-full py-8">
                <div class="flex items-center justify-center space-x-2">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 text-primary"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"
                        />
                    </svg>
                    <h1 class="text-3xl font-bold tracking-wider text-primary">
                        Cronos
                    </h1>
                </div>
                <div
                    class="mx-auto mt-8 w-5/6 rounded-lg bg-white px-16 py-8 shadow-2xl md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px]"
                >
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
