<?php

namespace App\Traits;

use App\Models\Menu;
use Illuminate\Support\Facades\App;

trait UtilityForm
{
    public $breadcrumbs = '';

    public string $isdisabled = '';

    public bool $isupdate = false;

    public function getBreadcrumbs($viewname): string
    {
        return Menu::where('grup_menu', $viewname)
            ->select('header_menu')
            ->first()->header_menu;
    }

    public function cleanFormValues()
    {

        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function getValuesModel(array $arrayvalues, $modelName): array
    {
        return prepareData($arrayvalues, $this->getObjetProperties($modelName));
    }

    public function getObjetProperties($classname): array
    {
        $model = 'App\\Models\\'.$classname;

        return App::make($model)->getFillable();

    }
}
