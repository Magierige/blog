<?php

namespace App\Livewire;

use Livewire\Component;

class BlogForm extends Component
{
    public $content;

    public $title;

    public $action;

    public $categories;

    public function render()
    {
        return view('livewire.blog-form', ['content' => $this->content]);
    }
}
