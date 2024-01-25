<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Http\Controllers\userControler;

class DelCat extends Component
{
    public function render()
    {
        return view('livewire.del-cat');
    }

    public function delete($id)
    {
        $user = new userControler();
        $del = $user->catRight();
        if(!$del){
            return redirect('/categories?id='.$id.'&error=1');
        }
        $cat = Category::where('id', $id)->first();
        $cat->delete();
        return redirect('/categories');
    }
}
