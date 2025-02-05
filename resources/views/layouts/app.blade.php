<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">
    <title>{{ config("app.name")  }}</title>

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

    <!-- Scripts -->
    @vite(["resources/css/app.css", "resources/js/app.js"])
</head>
<body class="h-full font-sans antialiased">
<div
    x-data="{ menuOpen: false }"
    class="flex min-h-screen custom-scrollbar"
>
    <!-- start::Black overlay -->
    <div
        :class="menuOpen ? 'block' : 'hidden'"
        @click="menuOpen = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"
    ></div>
    <!-- end::Black overlay -->

    <aside
        :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        class="fixed inset-y-0 left-0 z-30 w-52 overflow-y-auto bg-secondary transition duration-300 custom-scrollbar lg:inset-0 lg:translate-x-0"
    >
        <!-- start::Logo -->
        <x-mmenu.menu-logo></x-mmenu.menu-logo>
        <!-- end::Logo -->

        <!-- start::Navigation -->
        <x-menu-nav></x-menu-nav>
        <!-- end::Navigation -->
    </aside>

    <div class="flex w-full flex-col lg:pl-52">
        <!-- start::Topbar -->
        <div class="flex flex-col">
            <header
                class="flex h-16 items-center justify-between bg-white px-6 py-2"
            >
                <!-- start::Mobile menu button -->
                <div class="flex items-center">
                    <button
                        @click="menuOpen = true"
                        class="text-gray-500 transition duration-200 hover:text-primary focus:outline-none lg:hidden"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7"
                            ></path>
                        </svg>
                    </button>
                </div>
                <!-- end::Mobile menu button -->

                <!-- start::Right side top menu -->
                <div class="flex items-center">
                    <!-- start::Search input -->
                    <x-mmenu.menu-search-input></x-mmenu.menu-search-input>
                    <!-- end::Search input -->

                    <!-- start::Notifications -->
                    <x-mmenu.menu-notification></x-mmenu.menu-notification>
                    <!-- end::Notifications -->

                    <!-- start::Profile -->
                    <x-mmenu.menu-profile></x-mmenu.menu-profile>
                    <!-- end::Profile -->
                </div>
                <!-- end::Right side top menu -->
            </header>
        </div>
        <!-- end::Topbar -->

        <!-- start:Page content -->
        <div class="h-full bg-gray-200">
            <!-- start::Stats -->
            {{ $slot }}
            @livewire("utility.form-activity")
            @livewire("utility.history-modal")
            <!-- end::Stats -->

        </div>
        <!-- end:Page content -->
    </div>
</div>
</body>
</html>
