<?php

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuNav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menuItems = Menu::with('optionmenus')->whereNull('menu_id')
            ->withcount('optionmenus')
            ->orderBy('id')
            ->get();

        return view('components.mmenu.menu-nav', compact('menuItems'));
    }
}
