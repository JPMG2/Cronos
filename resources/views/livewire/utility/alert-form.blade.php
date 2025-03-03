@props(['button'=>false])
<div wire:show="showAlert" wire:cloak class="relative z-10" aria-labelledby="modal-title" role="dialog"
     aria-modal="true">

    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <x-modalalert.modalclose></x-modalalert.modalclose>
                <div class="sm:flex sm:items-start">
                    @if($button===0)
                        <x-modalalert.iconmodal type="{{$type}}"></x-modalalert.iconmodal>
                    @else
                        <x-modalalert.incogniticon></x-modalalert.incogniticon>
                    @endif
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">{{$title}}</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-600">{{$message}}.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    @if($button>0)
                        <button type="button"
                                wire:click="$dispatch('{{$event}}')"
                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                            {{$buttonName}}
                        </button>
                    @endif
                    <x-modalalert.modalbuttoncancel></x-modalalert.modalbuttoncancel>
                </div>
            </div>
        </div>
    </div>
</div>
