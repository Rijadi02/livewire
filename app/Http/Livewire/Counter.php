<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;
    function increment(){
        $this->count++;
    }

    function decrement(){
        $this->count--;

    }

    public function render()
    {
        return view('livewire.counter');
    }
}
