<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('inicio') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md mx-auto w-1/3">
            <img class="w-full" src="{{ asset('imgs/ima-inicio@2x.jpg') }}" alt="">
        </div>

    </div>
</x-app-layout>
