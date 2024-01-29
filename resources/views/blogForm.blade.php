<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger text-gray-800 dark:text-gray-200 ">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="py-12 flex justify-center">
    @livewire('BlogForm', ['action' => $action, 'categories' => $categories])
        
    </div>
</x-app-layout>
