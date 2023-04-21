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

        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Url</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Fecha de creacion</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse ($files as $item)
                    <tr class="hover:bg-gray-50">
                        
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-4">
                                
                                    <button x-data="{ tooltip: 'Delete' }" wire:click="confirmation_delete({{ $item->id }})">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="h-6 w-6"
                                            x-tooltip="tooltip"
                                        >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        />
                                        </svg>
                                    </button>
                            </div>
                        </td>

                        <td class="px-6 py-4">{{ $item->id }}</td>
                        
                        <td class="px-6 py-4">
                            <a target="_blanck" href="{!! $item['url'] !!}">{!! $item['url'] !!}</a>
                            {{-- {{ $item->getPathFile() }} --}}
                        </td>
                        <td class="px-6 py-4">{{ $item->created_at }}</td>

                        
                    </tr>
                @empty
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-center" colspan="3">No hay datos disponibles</td>
                </tr>
                @endforelse
            </tbody>
        </table>
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


    <x-jet-confirmation-modal wire:model="show_confirmation_delete" id="">
        <x-slot name="title">
            ¿Seguro que quiere eliminar el archivo?
        </x-slot>
    
        <x-slot name="content">

            <div>
                <b>¿Seguro que quiere eliminar el archivo?</b>
            </div>

        </x-slot>
    
        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('show_confirmation_delete')" wire:loading.attr="disabled">
                {{ __('Cerrar') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete_archive" wire:loading.attr="disabled">
                {{ __('Eliminar archivo') }}
            </x-jet-secondary-button>

    
        </x-slot>
    </x-jet-confirmation-modal>

</div>