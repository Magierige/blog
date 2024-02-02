<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
        @if ($check == true)
        <a class="font-semibold bg-green-500 text-l text-gray-800 dark:text-gray-200 leading-tight" href="/categories/create">Create</a>
        @endif

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-row  flex-wrap">
                    @foreach($catPages as $catPage)
                    <a href="/categories/category?id={{ $catPage->id }}" class=" basis-1/3">
                        <div>

                            <div class="px-4 py-2 m-2 text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700 rounded-lg">
                                <img src="{{$catPage->thumbnail }}" alt="image" class="w-full h-32 object-cover">

                                <p>{{ $catPage->name }}</p>

                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            {{ $catPages->links() }}
        </div>
    </div>
</x-app-layout>