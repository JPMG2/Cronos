<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class MenuActions extends Component
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

        return view('components.menu-actions', compact('menuItems'));
    }
}
