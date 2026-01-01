<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="icon" href="{{ asset('img/icon.png') }}" type="image/x-icon">
    <title>{{ config("app.name") . " " . $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net"/>

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
    x-data="{
        menuOpen: window.innerWidth >= 1024,
        handleResize() {
            if (window.innerWidth < 1024) {
                this.menuOpen = false;
            } else {
                this.menuOpen = true;
            }
        }
    }"
    x-init="
        menuOpen = window.innerWidth >= 1024;
        window.addEventListener('resize', () => handleResize());
    "
    class="flex min-h-screen custom-scrollbar"
>
    <!-- start::Black overlay -->
    <div
        x-show="menuOpen && window.innerWidth < 1024"
        @click="menuOpen = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-50"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-50"
        x-transition:leave-end="opacity-0"
    ></div>
    <!-- end::Black overlay -->
    <!-- start::Main menu -->
    <aside
        :class="menuOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        class="fixed inset-y-0 left-0 z-30 w-52 overflow-y-auto bg-secondary transition duration-300 custom-scrollbar lg:inset-0"
        :class="{ 'lg:translate-x-0': menuOpen, 'lg:-translate-x-full': !menuOpen }"
    >
        <!-- start::Logo -->
        <x-mmenu.menu-logo></x-mmenu.menu-logo>
        <!-- end::Logo -->

        <!-- start::Navigation -->
        <x-menu-nav></x-menu-nav>
        <!-- end::Navigation -->
    </aside>
    <!-- end::Main menu -->

    <!-- Menu toggle button - positioned at end of sidebar -->
    <button
        @click="menuOpen = !menuOpen"
        class="fixed top-4 z-40 flex items-center justify-center text-slate-600 hover:text-blue-700 transition-all duration-300 focus:outline-none bg-blue-100 hover:bg-blue-200 rounded-md p-1.5 shadow-md"
        :class="menuOpen ? 'left-48' : 'left-4'"
        :title="menuOpen ? 'Colapsar menú' : 'Expandir menú'"
    >
        <svg
            class="h-4 w-4 transition-transform duration-300"
            :class="menuOpen ? '' : 'rotate-180'"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M11 19l-7-7 7-7m8 14l-7-7 7-7"
            ></path>
        </svg>
    </button>

    <div class="flex w-full flex-col transition-all duration-300" :class="menuOpen ? 'lg:pl-52' : 'lg:pl-0'">
        <!-- start::Topbar -->
        <div class="flex flex-col">
            <header
                class="flex h-16 items-center justify-between bg-white px-6 py-2"
            >
                <!-- start::Left side spacer -->
                <div class="flex items-center">
                    <!-- Spacer to maintain layout -->
                    <div class="w-6"></div>
                </div>
                <!-- end::Left side spacer -->

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
            @livewire("utility.alert-form")
            <div x-data="{personInfoData: false}"
                 @open-modal-data.window="personInfoData = true"
                 @close-modal-data.window="personInfoData = false">
                <div id="modal-personData" x-show="personInfoData" x-cloak>
                </div>
            </div>


        </div>
        <!-- end:Page content -->
    </div>
</div>
</body>
</html>
