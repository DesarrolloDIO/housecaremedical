<div>
    <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">ID</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nombre</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Resultado</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Estado</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Creado por</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900">Fecha de creacion</th>
                <th scope="col" class="px-6 py-4 font-medium text-gray-900"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 border-t border-gray-100">
            @forelse ($data as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $item->id }}</td>
                    <td class="px-6 py-4">{{ $item->name }}</td>
                    <td class="px-6 py-4">
                        <div class="flex">
                            @if($item->estatus)
                                <div class="mx-1 px-2 py-1 font-semibold text-sm bg-blue-900 text-white rounded-lg shadow-sm">
                                    Activo
                                </div>
                            @else
                                <div class="mx-1 px-2 py-1 font-semibold text-sm bg-red-500 text-white rounded-lg shadow-sm">
                                    Desactivado
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">{!! Str::words($item->response, 10, ' ...') !!}</td>
                    <td class="px-6 py-4">{{ $item->user->name }}</td>
                    <td class="px-6 py-4">{{ $item->created_at }}</td>

                    <td class="px-6 py-4">
                        <div class="flex justify-end gap-4">

                            @can('result-details.edit')
                                <button x-data="{ tooltip: 'Edite' }" wire:click="showModalEdit({{ $item }})">
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
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"
                                        />
                                    </svg>
                                </button>
                            @endcan
                            @can('result-details.delete')
                                <button x-data="{ tooltip: 'Delete' }" wire:click="confirmation_delete({{ $item->id }}, '{{$item->nombre}}')">
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
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-center" colspan="3">No hay datos disponibles</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <x-jet-dialog-modal wire:model="show" id="create_group">
        <x-slot name="title">
            {{ __('Actualizar Detalle') }}
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
    
            <x-jet-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('Guardar Detalle') }}
            </x-jet-button>
    
        </x-slot>
    </x-jet-dialog-modal>
</div>
