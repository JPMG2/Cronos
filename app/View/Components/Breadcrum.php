<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Breadcrum extends Component
{
    public $breadcrumbs;

    public function __construct($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function getBreadcrumbs($viewname): string
    {

        return Menu::where('grup_menu', $viewname)
            ->select('header_menu')
            ->first()->header_menu;
    }

    public function render(): View|Closure|string
    {
        $menu = exploBreadcrum($this->getBreadcrumbs($this->breadcrumbs));

        return view('components.breadcrum', compact('menu'));
    }
}
