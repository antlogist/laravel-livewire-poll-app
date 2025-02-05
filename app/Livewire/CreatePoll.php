<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = [''];

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'options' => 'required|min:1|max:10',
            'options.*' => 'required|min:1|max:255',
        ];
    }

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function createPoll()
    {
        $this->validate();

        Poll::create([
            'title' => $this->title
        ])->options()->createMany(collect($this->options)->map(fn($option) => ['name' => $option])->all());

        // foreach ($this->options as $optionName) {
        //     $poll->options()->create([
        //         'name' => $optionName
        //     ]);
        // }

        $this->dispatch('poll-created');
        $this->reset(['title', 'options']);
    }
}
