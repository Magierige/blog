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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <form action="/categories/{{$action}}" method="POST" enctype="multipart/form-data" class="text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700">
                    @csrf
                    <div class="flex flex-col">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="border-2 rounded-lg">
                    </div>
                    <div class="flex flex-col">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="border-2 rounded-lg">
                    </div>
                    <div class="flex flex-col">
                        <button type="submit" class="border-2 rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>