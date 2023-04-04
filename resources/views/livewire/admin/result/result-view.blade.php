<div class="w-full">

    <div class="grid grid-cols-3 gap-4">
        <div>
            <x-jet-label for="code" value="{{ __('Codigo') }}" />
            <x-jet-input id="code" wire:model.lazy="code" class="block mt-1" type="text" name="code"/>
            <x-jet-input-error for="code" />
        </div>
        <div>
            <x-jet-label for="name" value="{{ __('Nombre') }}" />
            <x-jet-input id="name" wire:model.lazy="name" class="block mt-1" type="text" name="name"/>
            <x-jet-input-error for="name" />
        </div>
        <div>
            <x-jet-label for="age" value="{{ __('Año') }}" />
            <x-jet-input id="age" wire:model.lazy="age" class="block mt-1" type="date" name="age"/>
            <x-jet-input-error for="age" />
        </div>
        <div>
            <x-jet-label for="email" value="{{ __('Correo') }}" />
            <x-jet-input id="email" wire:model.lazy="email" class="block mt-1" type="email" name="email"/>
            <x-jet-input-error for="email" />
        </div>
        <div>
            <x-jet-label for="identification_type" value="{{ __('Tipo de identificación') }}" />
            <x-jet-input 
                type="text"
                class="block mt-1"
                id="identification_type"
                name="identification_type"
                wire:model.lazy="identification_type"
                />
            <x-jet-input-error for="coidentification_typede" />
        </div>
        <div>
            <x-jet-label for="patient_identification" value="{{ __('Identificación del paciente') }}" />
            <x-jet-input 
                type="text"
                class="block mt-1"
                id="patient_identification"
                name="patient_identification"
                wire:model.lazy="patient_identification"
                />
            <x-jet-input-error for="patient_identification" />
        </div>

        <div class="">
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
            <x-jet-input-error for="eps_id" />
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

    <div class="">
        <h1 class="text-2xl">Archivos de resultados</h1>
        @forelse ($files as $item)
        <div class="">
            <a href="{{ Storage::url($item['url']) }}">{{ $item['url'] }}</a>
        </div>
        @empty
            
        @endforelse
    </div>
    <div class="my-5 flex justify-center">
        
        <x-jet-action-message class="mr-3 my-2" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:click="update" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-jet-button>
    </div>

    <x-jet-section-border />

    <div class="">
        <h1 class="text-2xl">Detalles de resultados</h1>
        
        @can('result-details.create')
            <div class="my-5 flex justify-end">
                @livewire('admin.result.result-details-create', ['id_use' => $id_use, 'eps_use' => $eps_id])
            </div>
        @endcan

        <div class="mb-6">
            @livewire('admin.result.result-details-list', ['id_use' => $id_use])
        </div>

    </div>

</div>