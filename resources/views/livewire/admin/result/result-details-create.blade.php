<div>
    <x-jet-button wire:click="showModal">
        {{ $texto }}
    </x-jet-button>


    <x-jet-dialog-modal wire:model="show" id="create_group">
        <x-slot name="title">
            {{ $texto }}
        </x-slot>
    
        <x-slot name="content">

            <div class="">
                
                <div>
                    <x-jet-label for="name" value="{{ __('Nombre') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name" />
                </div>

                <div>
                    <x-jet-label for="response" value="{{ __('Respuesta') }}" />

                    <textarea id="response" class="block mt-1 w-full" type="text" name="response" wire:model.lazy="response" required autofocus autocomplete="response">
                    </textarea>

                    <x-jet-input-error for="response" />
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
    
            <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Guardar Detalle') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>
