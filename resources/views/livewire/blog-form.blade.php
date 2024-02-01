<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="flex">
        <form action="/blog/{{$action}}" method="POST" enctype="multipart/form-data" class="text-gray-800 dark:text-gray-200 bg-gray-300 dark:bg-gray-700">
            @csrf
            <div class="flex flex-col">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="border-2 rounded-lg text-gray-800" wire:model.change="title">
            </div>
            <div class="flex flex-col">
                <label for="tumbnail">Tumbnail</label>
                <input type="file" name="tumbnail" id="tumbnail" class="border-2 rounded-lg ">
            </div>
            <div class="flex flex-col">
                <label for="category">Category</label>
                <select name="category" id="category" class="border-2 rounded-lg text-gray-800">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col">
                <label for="content">Content</label>
                <textarea name="content" id="content" cols="30" rows="10" class="border-2 rounded-lg text-gray-800" wire:model.change="content">
                            '<html>
                                <body>
                                    <p>
                                        So she tucked her arm affectionately into Alice's, and they walked off together. Alice laughed so.
                                    </p>
                                    <img src='https://source.unsplash.com/random/800x600'></img>
                                    <p>
                                        SOME change in my time, but never ONE with such a curious appearance in the lap of her going,.
                                    </p>
                                </body>
                            </html>'
                        </textarea>
                <div class="flex flex-col">
                    <button type="submit" class="border-2 rounded-lg">Submit</button>
                </div>
        </form>
    </div>
    <div id="preview" >
    <div class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-200 leading-tight">
            {{$title}}
        </h2>
                    </div>
</div>
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg py-12">
    {{!! $content !!}}
    </div>
    </div>
</div>