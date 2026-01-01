<div x-data="{ linkActive: false }" class="relative">
    <!-- start::Main link -->
    <div @click="linkActive = !linkActive" class="flex cursor-pointer">
        <svg
            class="h-6 w-6 cursor-pointer text-slate-600 hover:text-primary-700 transition-colors"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
            ></path>
        </svg>
        <sub>
            <span
                class="-ml-1 animate-pulse rounded-full bg-red-600 px-1.5 py-0.5 text-gray-100"
            >
                4
            </span>
        </sub>
    </div>
    <!-- end::Main link -->

    <!-- start::Submenu -->
    <div
        style="display: none"
        x-show="linkActive"
        @click.away="linkActive = false"
        x-cloak
        class="absolute right-0 top-11 z-10 w-96 border border-gray-300"
    >
        <!-- start::Submenu content -->
        <div
            class="max-h-96 overflow-y-scroll rounded bg-white custom-scrollbar"
        >
            <!-- start::Submenu header -->
            <div class="flex items-center justify-between px-4 py-2">
                <span class="font-bold text-gray-900">Notifications</span>
                <span
                    class="rounded bg-red-600 px-1.5 py-0.5 text-xs text-gray-100"
                >
                    4 new
                </span>
            </div>
            <hr class="" />
            <!-- end::Submenu header -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-8 w-8 rounded-full bg-primary bg-opacity-20/30 px-1.5 py-0.5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                        ></path>
                    </svg>
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Order Completed
                        </p>
                        <p class="text-xs text-gray-500">Your order is completed</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">5 min ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <img
                        src="./assets/img/profile.jpg"
                        class="w-8 rounded-full"
                    />
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Maria sent you a message
                        </p>
                        <p class="text-xs text-gray-500">Hey there, how are you do...</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">30 min ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-8 w-8 rounded-full bg-primary bg-opacity-20/30 px-1.5 py-0.5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                        ></path>
                    </svg>
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Order Completed
                        </p>
                        <p class="text-xs text-gray-500">Your order is completed</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">54 min ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <img
                        src="./assets/img/profile.jpg"
                        class="w-8 rounded-full"
                    />
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Maria sent you a message
                        </p>
                        <p class="text-xs text-gray-500">Hey there, how are you do...</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">1 hour ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-8 w-8 rounded-full bg-primary bg-opacity-20/30 px-1.5 py-0.5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                        ></path>
                    </svg>
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Order Completed
                        </p>
                        <p class="text-xs text-gray-500">Your order is completed</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">15 hours ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <img
                        src="./assets/img/profile.jpg"
                        class="w-8 rounded-full"
                    />
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Maria sent you a message
                        </p>
                        <p class="text-xs text-gray-500">Hey there, how are you do...</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">12 day ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-8 w-8 rounded-full bg-primary bg-opacity-20/30 px-1.5 py-0.5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                        ></path>
                    </svg>
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Order Completed
                        </p>
                        <p class="text-xs text-gray-500">Your order is completed</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">3 months ago</span>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="#"
                class="flex items-center justify-between bg-opacity-20 px-3 py-4 hover:bg-gray-100:bg-slate-700"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <img
                        src="./assets/img/profile.jpg"
                        class="w-8 rounded-full"
                    />
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Maria sent you a message
                        </p>
                        <p class="text-xs text-gray-500">Hey there, how are you do...</p>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-500">10 months ago</span>
            </a>
            <!-- end::Submenu link -->
        </div>
        <!-- end::Submenu content -->
    </div>
    <!-- end::Submenu -->
</div>
