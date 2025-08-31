@props([
    'name_person'=>false,
    'lastname_person'=>false,
    'documentType_person'=>false,
    'document_person'=>false,
    'email_person'=>false,
    'phone_person'=>false
    ])
<div class="relative z-10"
     aria-labelledby="modal-title" role="dialog"
     aria-modal="true">

    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4
                pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                <div>
                    <div class="mx-auto flex size-12 items-center justify-center rounded-full bg-yellow-200">
                        <svg class="size-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                            />
                        </svg>
                    </div>
                    <div class="mt-1 text-center sm:mt-5">
                        <h3 class="text-base font-semibold text-gray-900" id="modal-title">Persona
                            registrada !</h3>
                    </div>
                    <div class="mt-1.5 grid grid-cols-4 gap-0.5">
                        <div class="text-base font-titles">Documento.</div>
                        <div class="font-bold -ml-4 w-48">{{$documentType_person}}</div>
                        <div class="text-base font-titles ">Número.</div>
                        <div class="font-bold -ml-10 w-52">{{$document_person}}</div>
                        <div class="text-base font-titles">Nombre.</div>
                        <div class="font-bold -ml-10 w-48 text-wrap">{{$name_person}}</div>
                        <div class="text-base font-titles ">Apellido.</div>
                        <div class="font-bold -ml-10 w-52 text-wrap">{{$lastname_person}}</div>
                        <div class="text-base font-titles ">Correo.</div>
                        <div class="font-bold -ml-10 col-span-3">{{$email_person}}</div>
                        <div class="text-base font-titles">Teléfono.</div>
                        <div class="font-bold -ml-10">{{$phone_person}}</div>
                    </div>
                    <p class="mt-1.5 text-blue-700 font-bold">Desea cargar la información ?</p>
                </div>
                <x-headerform.button-group>
                    <x-buttons.cancel
                        @click="openModalData = false; $dispatch('close-modal-data')"
                        wire:click="clearForm"
                        label="Cancelar"
                    ></x-buttons.cancel>
                    <x-buttons.accept
                        wire:click="infoPerson"
                        label="Aceptar"
                    ></x-buttons.accept>
                </x-headerform.button-group>
            </div>
        </div>
    </div>
</div>
