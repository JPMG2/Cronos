<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Menu;
use Auth;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
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
        $cacheKeyMenu = 'menu-'.$user->id;
        $menuItems = Cache::remember($cacheKeyMenu, 1440, function () use ($user) {
            if ($user->getUserRoleName() === 'Owner') {
                return Menu::with('optionmenus')
                    ->whereNull('menu_id')
                    ->withCount(['optionmenus'])
                    ->orderBy('id')
                    ->get();
            }

            $opcionmenus = $user->roles->flatMap(function ($rol) {
                return $rol->menus->pluck('id');
            })->filter()->values()->toArray();

            return Menu::with([
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
                ->withCount(['optionmenus'])
                ->whereIn('id', $opcionmenus) // filter parents too
                ->get();
        });

        return view('components.mmenu.menu-nav', compact('menuItems'));
    }
}
