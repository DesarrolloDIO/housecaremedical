<div>
    <x-jet-button wire:click="showModal">
        {{ $texto }}
    </x-jet-button>


    <x-jet-dialog-modal wire:model="show" id="create_group">
        <x-slot name="title">
            {{ __('Crear Usuario') }}
        </x-slot>
    
        <x-slot name="content">

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
                <x-jet-input-error for="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model.lazy="email" required />
                <x-jet-input-error for="email" />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Teléfono') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone"  wire:model.lazy="phone" required />
                <x-jet-input-error for="phone" />
            </div>

            <div class="mt-4">
                <x-jet-label for="address" value="{{ __('Dirección') }}" />
                <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address"  wire:model.lazy="address" required />
                <x-jet-input-error for="address" />
            </div>

            <div class="mt-4">
                <x-jet-label class="mt-2" value="{{ __('Estado') }}" />
                <div class="flex">
                    <x-jet-input id="estatus" class="mr-2" type="checkbox" name="estatus"  wire:model.lazy="estatus" required />
                    <x-jet-label for="estatus" value="{{ __('Activo') }}" />
                    <x-jet-input-error for="estatus" />
                </div>
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="clouseModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
    
            <x-jet-button class="ml-3" wire:click="create" wire:loading.attr="disabled">
                {{ __('Guardar Eps') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>
