<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class DelCat extends Component
{
    public function render()
    {
        return view('livewire.del-cat');
    }

    public function conDel($id){
        
    }

    public function delete()
    {
        $id = request('id');
        $cat = Category::where('id', $id)->first();
        $cat->delete();
        return redirect('/categories');
    }
}
