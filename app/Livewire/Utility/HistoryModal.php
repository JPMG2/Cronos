<?php

declare(strict_types=1);

namespace App\Livewire\Utility;

use App\Classes\Utilities\HistoryLog;
use Livewire\Attributes\On;
use Livewire\Component;

final class HistoryModal extends Component
{
    public $show = false;

    public $listHistoryData = [];

    public $historyTitle;

    public $modelname;

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.utility.history-modal');
    }

    #[On('showModalHistory')]
    public function loadModelHistory(array $array): void
    {

        $this->show = true;
        $historyData = new HistoryLog($array);
        $this->listHistoryData = $historyData->loadHistoryData();
        $this->modelname = $array['model'];
        $this->historyTitle = 'Historial de '.config('nicename.'.mb_strtolower((string) $array['model']));

    }

    public function hydrate(): void
    {
        $this->reset();

    }
}
