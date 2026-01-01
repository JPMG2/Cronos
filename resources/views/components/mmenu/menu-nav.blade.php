<div>
    <nav class="py-5 custom-scrollbar">
        <!-- start::Menu link -->
        <a
            x-data="{ mainlinkHover: false }"
            @mouseover="mainlinkHover = true"
            @mouseleave="mainlinkHover = false"
            href="./index.html"
            class="-mb-4 flex cursor-pointer items-center px-4 py-2.5 mx-2 rounded-lg text-slate-700 transition-all duration-200 border-l-0 hover:bg-primary-50 hover:text-primary-700"
        >
            <svg
                class="h-5 w-5 transition duration-200 text-slate-500"
                :class="mainlinkHover ? 'text-primary-600' : ''"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                />
            </svg>
            <span
                class="ml-3 font-medium transition duration-200"
                :class="mainlinkHover ? 'text-primary-700' : ''"
            >
                Inicio
            </span>
        </a>
        <!-- end::Menu link -->
        @foreach ($menuItems as $mItems)
            <p class="mb-2 mt-6 px-4 text-xs uppercase text-slate-500 font-semibold tracking-wider transition-all duration-300 hover:text-primary-600 hover:tracking-wide">
                {{ $mItems->name_menu }}
            </p>
            <!-- start::Menu link -->
            @if ($mItems->optionmenus_count > 0)
                @foreach ($mItems->optionmenus as $moption)
                    <div x-data="{ linkHover: false, linkActive: false }">
                        <x-mmenu.title-menu icon="{{$moption->icon_menu}}">
                            {{ $moption->grup_menu }}
                        </x-mmenu.title-menu>
                        @if ($moption->menus_count > 0)
                            <!-- start::Submenu -->
                            <ul
                                @click.outside="linkActive = false"
                                style="display: none"
                                x-show="linkActive"
                                x-cloak
                                x-collapse.duration.300ms
                                class="ml-6 text-slate-600"
                            >
                                @foreach ($moption->menus as $submenu)
                                    <!-- start::Submenu link -->
                                    <x-mmenu.li-submenu
                                        routname="{{$submenu->linkto}}"
                                    >
                                        {{ $submenu->grup_menu }}
                                    </x-mmenu.li-submenu>
                                    <!-- end::Submenu link -->
                                @endforeach
                            </ul>
                        @endif

                        <!-- end::Submenu -->
                    </div>
                @endforeach
            @endif
        @endforeach
    </nav>
</div>
