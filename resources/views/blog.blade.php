<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($blog->title) }}
        </h2>
        @if ($edit)
        <div>
        <a class="cursor-pointer ml-6 text-sm text-white" href="/blog/edit?id={{ $_GET['id'] }}" >
Edit blog
</a>
@endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                {!! $blog->content !!}
                <p>author: {{$blog->author}} </p>
                <p class="@if($blog->ulike) text-green-500 @endif">like: {{$blog->like}} </p>
                <p class="@if(isset($blog->ulike) && $blog->ulike === false) text-red-500 @endif">dislike: {{$blog->dislike}} </p>
                <div class="flex flex-row  flex-wrap">
                    @foreach($blog->reactions as $comment)
                        <div class=" basis-1/3">
                            <div class="px-4 py-2 m-2 text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700 rounded-lg">
                                <p>author: {{$comment->author}} </p>
                                <p>comment: {{$comment->message}} </p>
                                <p class="@if($comment->ulike) text-green-500 @endif">like: {{$comment->like}} </p>
                                <p class="@if(isset($comment->ulike) && $comment->ulike === false) text-red-500 @endif">dislike: {{$comment->dislike}} </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>