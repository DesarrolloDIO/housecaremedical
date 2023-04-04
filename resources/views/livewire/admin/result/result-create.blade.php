<div>
    <x-jet-button wire:click="showModal">
        {{ $texto }}
    </x-jet-button>


    <x-jet-dialog-modal wire:model="show" id="create_group">
        <x-slot name="title">
            {{ __('Crear Resultado') }}
        </x-slot>
    
        <x-slot name="content">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-jet-label for="code" value="{{ __('Codigo') }}" />
                    <x-jet-input id="code" class="block mt-1 w-full" type="text" name="code" wire:model.lazy="code" required autofocus autocomplete="code" />
                    <x-jet-input-error for="code" />
                </div>
    
                <div>
                    <x-jet-label for="name" value="{{ __('Nombre') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name" />
                </div>

                <div>
                    <x-jet-label for="patient_identification" value="{{ __('Identificación del paciente') }}" />
                    <x-jet-input id="patient_identification" class="block mt-1 w-full" type="text" name="patient_identification" wire:model.lazy="patient_identification" required autocomplete="patient_identification" />
                    <x-jet-input-error for="patient_identification" />
                </div>

                <div>
                    <x-jet-label for="identification_type" value="{{ __('Tipo de identificación') }}" />
                    <x-jet-input id="identification_type" class="block mt-1 w-full" type="text" name="identification_type" wire:model.lazy="identification_type" required autocomplete="identification_type" />
                    <x-jet-input-error for="identification_type" />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Correo') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model.lazy="email" required />
                    <x-jet-input-error for="email" />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="age" value="{{ __('Año') }}" />
                    <x-jet-input id="age" class="block mt-1 w-full" type="date" name="age"  wire:model.lazy="age" required />
                    <x-jet-input-error for="age" />
                </div>
                
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex">
                        <div class="w-full">
                            <x-jet-label for="eps_id" value="{{ __('Eps') }}" />
                            <select name="eps_id" id="eps_id" wire:model.lazy="eps_id" class="w-full">
                                <option value=""></option>
                                @foreach ($eps as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="eps_id" />
                        </div>
                        <div class="pl-3">
                            <div class="my-6">
                                @livewire('admin.eps.eps-create', ['texto' => '+'])
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="mt-4 flex">
                    <div class="">
                        <x-jet-label for="doc_result" value="{{ __('Comprobantes') }}" />
                        <x-jet-input id="doc_result" class="block mt-1 w-full" type="file" name="doc_result"  wire:model="doc_result" multiple />
                        <x-jet-input-error for="doc_result" />
                    </div>

                    <div wire:loading wire:target="doc_result">
                        <img class="w-2/3" src="{{ asset('imgs/upload-animated-gif-3.gif') }}" alt="uploading..." title="uploading...">
                    </div>
                </div> --}}

                <div class="mt-4"
                    id="{{ $imageId }}"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <!-- File Input -->
                    <x-jet-label for="doc_result" value="{{ __('Comprobantes') }}" />
                    <x-jet-input id="doc_result" class="block mt-1 w-full" type="file" name="doc_result"  wire:model="doc_result" multiple />
                    <x-jet-input-error for="doc_result" />
                
                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
    
                <div class="mt-4">
                    <x-jet-label class="mt-2" value="{{ __('Estado') }}" />
                    <div class="flex">
                        <x-jet-input id="estatus" class="mr-2" type="checkbox" name="estatus"  wire:model.lazy="estatus" required />
                        <x-jet-label for="estatus" value="{{ __('Activo') }}" />
                        <x-jet-input-error for="estatus" />
                    </div>
                </div>

            </div>


        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="clouseModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-3" wire:click="create"  wire:loading.attr="disabled" wire:target="create, doc_result">
                {{ __('Guardar Resultado') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>
