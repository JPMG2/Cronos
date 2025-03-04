<?php

namespace App\Livewire\Utility;

use Livewire\Attributes\On;
use Livewire\Component;

class FormActivity extends Component
{
    public $show = false;

    public $message = '';

    public $result;

    public $color = '';

    #[On('show-toast')]
    public function formToast($arrayvalues)
    {

        $this->message = $arrayvalues[0];

        $this->result = $arrayvalues[1];

        $this->color = $this->getColor($this->result);

        $this->show = true;
    }

    public function getColor(int $value): string
    {

        if ($value === 1) {
            $color = 'bg-green-400';
        } else {
            $color = 'bg-red-400';
        }

        return $color;
    }

    public function render()
    {
        return <<<'HTML'
        <div
          style="display: none"
          x-data="{show:  $wire.entangle('show') }"
          x-show="show"
          x-transition:enter="transform ease-out duration-300 transition"
          x-transition:enter-start="transform opacity-0 translate-y-2"
          x-transition:enter-end="transform opacity-100"
          x-transition:leave="transition ease-in duration-400"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-90"
          x-model="show==true, setTimeout(() => {show=false}, 3300)"
        >
            <button type="button" class="bottom-0 z-20 right-0 mr-2  mb-8 mt-1
                     pr-4 fixed px-5 py-3 rounded  shadow-lg {{$color}}  dark:bg-neutral-800
                     dark:border-neutral-700">
                 <div class="flex p-1">
                    <div class="flex-shrink-0 animate-bounce">
                       <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                         <path stroke-linecap="round" stroke-linejoin="round"
                         d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                       </svg>
                    </div>
                    <div class="ms-3">
                        <p class="text-sm text-gray-800 dark:text-neutral-400">
                           {{$message}}
                        </p>
                    </div>
                </div>
            </button>
        </div>
        HTML;
    }
}
