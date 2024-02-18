<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $posts = Post::all();
        return view('livewire.home', [
            'posts' => $posts
        ]);
    }
}
