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

@php
if (isset($blog)) {
    $title = $blog->title;
    $content = $blog->content;
    $content = str_replace('src="https://source.unsplash.com/random/800x600"', 'src="'.$blog->tumbnail.'', $content);
}else{
    $title = "Een title";
    $content = '
        <p>
            So she tucked her arm affectionately into Alice\'s, and they walked off together. Alice laughed so.
        </p>
        <img src="https://source.unsplash.com/random/800x600">
        <p>
            SOME change in my time, but never ONE with such a curious appearance in the lap of her going,.
        </p>';
}
@endphp

    <div class="py-12 flex justify-center">
        @livewire('BlogForm', [
            'action' => $action, 
            'categories' => $categories,
            'content' => $content,
            'title' => $title,
        ])
    </div>
</x-app-layout>
