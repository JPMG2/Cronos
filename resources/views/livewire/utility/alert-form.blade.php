@props(['button'=>false])
<div wire:show="showAlert" wire:cloak class="relative z-10" aria-labelledby="modal-title" role="dialog"
     aria-modal="true">

    <div class="fixed inset-0 bg-slate-500/20 backdrop-blur-sm transition-all duration-300" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white border border-slate-200
                        px-4 pb-4 pt-5 text-left shadow-2xl ring-1 ring-slate-900/5
                        transition-all duration-300 ease-out
                        sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <x-modalalert.modalclose></x-modalalert.modalclose>
                <div class="sm:flex sm:items-start">
                    @if($button===0)
                        <x-modalalert.iconmodal type="{{$type}}"></x-modalalert.iconmodal>
                    @else
                        <x-modalalert.incogniticon></x-modalalert.incogniticon>
                    @endif
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-base font-semibold text-slate-900" id="modal-title">{{$title}}</h3>
                        <div class="mt-2">
                            <p class="text-sm text-slate-600">{!!$message!!}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 sm:mt-4 sm:flex gap-2 sm:flex-row-reverse">
                    <x-modalalert.modalbuttoncancel buttonName='Cancelar'></x-modalalert.modalbuttoncancel>

                    @if($button>0)
                        <button type="button"
                                wire:click="closeModal"
                                class="inline-flex w-full justify-center rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white
                                       shadow-lg hover:bg-red-500 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
                                       transition-all duration-200 transform hover:scale-105 active:scale-95
                                       sm:ml-3 sm:w-auto">
                            {{$buttonName}}
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
