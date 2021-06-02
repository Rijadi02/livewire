<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $newComment;


    public function updated($field){
        $this->validateOnly($field,['newComment'=>'required|max:255']);
    }


    public function addComment(){
        $this->validate(
            ['newComment'=>'required']
        );

        $createdComment = Comment::create(['body' =>$this->newComment, 'user_id' => 1 ]);
        // $this->comments->prepend($createdComment);
        $this->newComment = "";
        session()->flash('message','Comment added successfully 😃');


    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        // $this->comments = $this->comments->except($commentId);
        $comment->delete();
        session()->flash('message','Comment deleted succesfully 😅');


    }

    public function render()
    {
        return view('livewire.comments', ['comments'=>Comment::latest()->paginate(2)]);
    }
}
