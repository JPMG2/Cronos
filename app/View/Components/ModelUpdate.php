<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Log;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ModelUpdate extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public int $queryaccion, public $modelObj, public $modelId, public $logId)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $whatchange = '';

        $mainModelName = $this->modelName();

        $nameofModel = $this->namemodel();

        $queryacion = $this->queryaccion;

        if ($queryacion === 2) {// update

            $whatchange = $this->seeChanges();
        }

        return view('components.model-update', compact('queryacion', 'nameofModel', 'mainModelName', 'whatchange'));
    }

    public function modelName(): string
    {
        return $this->modelObj::find($this->modelId)->mainName();
    }

    public function namemodel(): string
    {
        $getmodelname = mb_strrpos($this->modelObj, '\\');

        $getmodelname = mb_substr($this->modelObj, $getmodelname + 1);

        return config('nicename.'.mb_strtolower($getmodelname));
    }

    public function seeChanges()
    {
        return json_decode(Log::find($this->logId)->log_change, true);

    }
}
