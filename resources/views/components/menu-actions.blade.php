<div>
    @foreach ($menuItems as $mItems)
        <p
            class="mb-1 mt-5 px-6 text-xs uppercase text-gray-900">

            {{ $mItems->name_menu }}
        </p>
        <!-- start::Menu link -->
        @if ($mItems->optionmenus_count > 0)
            @foreach ($mItems->optionmenus as $moption)
                <div x-data="{ linkHover: false, linkActive: false }">

                    <x-mmenu.titlemenu-actions
                        icon="{{$moption->icon_menu}}"
                    >
                        <div
                            wire:key="menu-option-{{ $moption->id }}"
                            wire:click="showMenu({{ $moption->id }})">
                            {{ $moption->grup_menu }}
                        </div>
                    </x-mmenu.titlemenu-actions>
                    @if ($moption->menus_count > 0)
                        <!-- start::Submenu -->
                        <ul
                            @click.outside="linkActive = false"
                            style="display: none"
                            x-show="linkActive"
                            x-cloak
                            x-collapse.duration.300ms
                            class="text-gray-400"
                        >
                            @foreach ($moption->menus as $submenu)
                                <!-- start::Submenu link -->
                                <x-mmenu.li-submenu

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
</div>
