<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostForm extends Component
{
    use WithPagination;

    public $title;
    public $description;
    public $post;
    public $is_edit = false;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
    ];

    public function storePost()
    {
        $this->validate();
        $post = Post::create([
            'title' => $this->title,
            'description' => $this->description
        ]);
        $this->reset();
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->is_edit = true;
    }

    public function update()
    {
        $this->post->update([
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->reset();
        $this->post = null;
    }

    public function destroy($id)
    {
        Post::destroy($id);
    }


    public function render()
    {
        return view('livewire.post-form', ['posts' => Post::latest()->paginate(10)]);
    }
}
