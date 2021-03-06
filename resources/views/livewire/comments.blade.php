<form wire:submit.prevent="addComment" style="text-align: center">


    <div class="row">
        <div class="container">
            <section>
                @if($image)
                <img src="{{$image}}" width="200" alt="">
                @endif
                <input type="file" id="image" wire:change="$emit('fileChoosen')">
            </section>

            <div class="d-flex">
                <input type="text" name="body" class="form-control  ml-5" wire:model.lazy="newComment">
                <button type="submit" class="btn btn-primary ml-5 mr-5" >Submit</button>
            </div>
            @error('newComment') <span class="error">{{ $message }}</span> @enderror

            <div class="mt-5 ml-5  mr-5">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            @foreach ($comments as $comment)

            <div class="card mt-5">
               <div class="card-header">
                @if($comment->image)
                <img src="http://127.0.0.1:8000/storage/{{$comment->image}}" alt="">
                @endif
               </div>
               <div class="card-body">
                 <h5 class="card-title">{{$comment->creator->name}}</h5>
                 <p class="card-text">{{$comment->body}} <br></p>
                 <a href="#" class="btn btn-primary">{{$comment->created_at->diffForHumans()}}</a>
                 <a href="#" class="btn btn-danger" wire:click="remove({{$comment->id}})" >Delete</a>
                </a>

               </div>
             </div>
            @endforeach
        </div>
    </div>
    {{$comments->links('pagination-links')}}


    <script>
        Livewire.on('fileChoosen', () => {
           let inputField = document.getElementById('image');
           let file = inputField.files[0];
           let reader = new FileReader();
            reader.onloadend = () => {
                window.Livewire.emit('fileUpload', reader.result);
            }
            reader.readAsDataURL(file);
        })
    </script>
</form>
