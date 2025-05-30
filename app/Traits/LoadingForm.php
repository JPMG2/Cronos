<?php

declare(strict_types=1);

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
