<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $newComment;
    public $image;
    protected $listeners = ['fileUpload' => 'handleFileUpload'];

    public function handleFileUpload ($imagedata){
        $this->image = $imagedata;
    }

    public function updated($field){
        $this->validateOnly($field,['newComment'=>'required|max:255']);
    }

    public function addComment(){
        $this->validate(
            ['newComment'=>'required']
        );
        $image = $this->storeImage();
        $createdComment = Comment::create(
            ['body' =>$this->newComment,
            'user_id' => 1,
            'image' => $image ]);
        $this->newComment = "";
        session()->flash('message','Comment added successfully 😃');
    }

    public function remove($commentId){
        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        // $this->comments = $this->comments->except($commentId);
        $comment->delete();
        session()->flash('message','Comment deleted succesfully 😅');
    }

    public function storeImage(){
        if(!$this->image){
            return null;
        }

        $img = Image::make($this->image)->encode('jpg');
        $name = Str::random().'.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function getImagePath()
    {
        return Storage::disk('public')->url($this->image);
    }

    public function render()
    {
        return view('livewire.comments', ['comments'=>Comment::latest()->paginate(2)]);
    }
}
