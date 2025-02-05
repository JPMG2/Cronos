<?php

namespace App\Traits;

trait LoadingForm
{
    public function placeholder()
    {
        return <<<'HTML'
        <div >
           <progress class="progress progress-info  w-full"></progress>
        </div>
        HTML;
    }
}
