<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resultados') }}
        </h2>
    </x-slot>

    <div class="container mx-auto pt-4">
        @can('result.create')
            <div class="my-5 flex justify-end">
                @livewire('admin.result.result-create')
            </div>
        @endcan

        <div class="mb-6">
            @livewire('admin.result.result-list')
        </div>

    </div>
</x-app-layout>