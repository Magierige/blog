<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-row  flex-wrap">
                    @foreach($categories as $category)
                        <div class=" basis-1/3">
                            
                            <div class="px-4 py-2 m-2 text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700 rounded-lg">
                                    <a href="/category?id={{ $category->id }}">{{ $category->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>