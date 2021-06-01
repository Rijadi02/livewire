<form wire:submit.prevent="addComment" style="text-align: center">


    <div class="row">
        <div class="container">
            <div class="d-flex">
                <input type="text" name="body" class="form-control  ml-5" wire:model.lazy="newComment">
                <button type="submit" class="btn btn-primary ml-5 mr-5" >Submit</button>
            </div>
            @error('newComment') <span class="error">{{ $message }}</span> @enderror

            @foreach ($comments as $comment)

            <div class="card mt-5">
               <div class="card-header">
                 Featured
               </div>
               <div class="card-body">
                 <h5 class="card-title">{{$comment->creator->name}}</h5>
                 <p class="card-text">{{$comment->body}} <br></p>
                 <a href="#" class="btn btn-primary">{{$comment->created_at->diffForHumans()}}<br>
                 </a>
               </div>
             </div>





            @endforeach
        </div>
    </div>



</form>