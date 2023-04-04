<x-app-layout>

    <div class="container mx-auto pt-4">
        <div class="mb-6">
            @livewire('admin.result.result-view', ['id_use' => $id])
        </div>
    </div>
</x-app-layout>