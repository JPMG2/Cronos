<div x-data="{ linkActive: false }" class="relative">
    <!-- start::Main link -->
    <div @click="linkActive = !linkActive" class="cursor-pointer">
        <img src="./assets/img/profile.jpg" class="w-10 rounded-full" />
    </div>
    <!-- end::Main link -->

    <!-- start::Submenu -->
    <div
        x-show="linkActive"
        @click.away="linkActive = false"
        x-cloak
        class="absolute right-0 top-11 z-50 w-40 border border-gray-300"
    >
        <!-- start::Submenu content -->
        <div class="rounded bg-white">
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="./pages/profile.html"
                class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-5 w-5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        ></path>
                    </svg>
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Profile
                        </p>
                    </div>
                </div>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="./pages/email/inbox.html"
                class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-5 w-5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        ></path>
                    </svg>
                    <div class="ml-3 text-sm">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Inbox
                            <span
                                class="ml-2 rounded bg-red-600 px-1.5 py-0.5 text-xs text-gray-100"
                            >
                                3
                            </span>
                        </p>
                    </div>
                </div>
            </a>
            <!-- end::Submenu link -->
            <!-- start::Submenu link -->
            <a
                x-data="{ linkHover: false }"
                href="./pages/settings.html"
                class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100"
                @mouseover="linkHover = true"
                @mouseleave="linkHover = false"
            >
                <div class="flex items-center">
                    <svg
                        class="h-5 w-5 text-primary"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        ></path>
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        ></path>
                    </svg>
                    <div class="ml-3 space-y-3">
                        <p
                            class="font-bold capitalize text-gray-600"
                            :class=" linkHover ? 'text-primary' : ''"
                        >
                            Settings
                        </p>
                    </div>
                </div>
            </a>
            <!-- end::Submenu link -->

            <hr />

            <!-- start::Submenu link -->
            <form
                method="POST"
                action="{{ route("logout") }}"
                id="logout-form"
            >
                @csrf
                <a
                    x-data="{ linkHover: false }"
                    href="#"
                    class="flex items-center justify-between bg-opacity-20 px-3 py-2 hover:bg-gray-100"
                    @mouseover="linkHover = true"
                    @mouseleave="linkHover = false"
                    @click.prevent="document.getElementById('logout-form').submit();"
                >
                    <div class="flex items-center">
                        <svg
                            class="h-5 w-5 text-red-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="{{ iconName("exit")["exit"] }}"
                            ></path>
                        </svg>
                        <div class="ml-3 text-sm">
                            <p
                                class="font-bold capitalize text-gray-600"
                                :class=" linkHover ? 'text-primary' : ''"
                            >
                                Salir
                            </p>
                        </div>
                    </div>
                </a>
            </form>
            <!-- end::Submenu link -->
        </div>
        <!-- end::Submenu content -->
    </div>
    <!-- end::Submenu -->
</div>
