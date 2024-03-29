<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($category) }}
        </h2>
        @if ($blog)
        <div>
            <a class="cursor-pointer ml-6 text-sm text-white" href="/blog/create">
                Make blog
            </a>
        </div>
        @endif
        @if ($del)
        <div>
            @livewire('DelCat')
        </div>
        <div>
            <a class="cursor-pointer ml-6 text-sm text-white" href="/categories/edit?id={{ $_GET['id'] }}">
                edit category
            </a>
        </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-row  flex-wrap">
                    @foreach($blogs as $blog)
                    <div class=" basis-1/3">
                        <div class="px-4 py-2 m-2 text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700 rounded-lg">
                            <img src="{{ $blog->tumbnail }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                            <a href="/blog?id={{ $blog->id }}">{{ $blog->title }}</a>
                            <p>author: {{$blog->author}} </p>
                            <form action="/blog/like" method="POST">
                                @csrf
                                <input type="hidden" name="bId" value="{{$blog->id}}">
                                <input type="hidden" name="like" value="1">
                                <button type="submit" class="border-2 rounded-lg @if($blog->ulike) text-green-500 @endif">Like: {{$blog->like}}</button>
                            </form>
                            <form action="/blog/like" method="POST">
                                @csrf
                                <input type="hidden" name="bId" value="{{$blog->id}}">
                                <input type="hidden" name="like" value="0">
                                <button type="submit" class="border-2 rounded-lg @if(isset($blog->ulike) && $blog->ulike === false) text-red-500 @endif">Dislike: {{$blog->dislike}}</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>