<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Menu;
use Auth;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class MenuNav extends Component
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
        $user = Auth::user();
        if ($user->getUserRoleName() === 'Owner') {
            $menuItems = Menu::with('optionmenus')->whereNull('menu_id')
                ->withcount('optionmenus')
                ->orderBy('id')
                ->get();
        } else {
            $opcionmenus = $user->roles->flatMap(function ($rol) {
                return $rol->menus->pluck('id');
            })->toArray();

            $menuItems = Menu::with([
                'optionmenus' => function ($query) use ($opcionmenus) {
                    $query->whereIn('id', $opcionmenus)
                        ->with([
                            'menus' => function ($q) use ($opcionmenus) {
                                $q->whereIn('id', $opcionmenus);
                            },
                        ]);
                },
            ])
                ->whereNull('menu_id')
                ->withcount('optionmenus')
                ->whereIn('id', $opcionmenus) // <-- filter parents too
                ->get();
        }

        return view('components.mmenu.menu-nav', compact('menuItems'));
    }
}
