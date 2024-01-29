<?php

namespace App\Livewire;

use Livewire\Component;

class BlogForm extends Component
{
    public $content = "<html>
                                <body>
                                    <p>
                                        So she tucked her arm affectionately into Alice's, and they walked off together. Alice laughed so.
                                    </p>
                                    <!-- dit is een standaart foto die vervangen word met je thumbnail -->
                                    <img src='https://source.unsplash.com/random/800x600'></img>
                                    <p>
                                        SOME change in my time, but never ONE with such a curious appearance in the lap of her going,.
                                    </p>
                                </body>
                            </html>";

    public $action;

    public $categories;

    public function render()
    {
        return view('livewire.blog-form', ['content' => $this->content]);
    }
}
