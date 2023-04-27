<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Eps') }}
        </h2>
    </x-slot>

    <div class="container mx-auto pt-4">
        @can('eps.create')
            <div class="my-5 flex justify-end">
                @livewire('admin.eps.eps-create')
            </div>
        @endcan

        <div class="mb-6">
            @livewire('admin.eps.eps-list')
        </div>

    </div>
</x-app-layout>