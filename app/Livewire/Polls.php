<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Attributes\On;
use Livewire\Component;

class Polls extends Component
{
    #[On('poll-created')] 
    public function render()
    {
        // $polls = Poll::select(['id', 'title', 'updated_at'])
        //     ->with(['options' => fn($query) => $query->select(['id', 'poll_id', 'name'])])
        //     ->orderByDesc('updated_at')
        //     ->get();

        $polls = Poll::orderByDesc('updated_at')->get();

        return view('livewire.polls', ['polls' => $polls]);
    }
}
