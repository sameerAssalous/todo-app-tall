<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Lists extends Component
{

    public array $subscribedIds;

    public function subscribe(User $user)
    {
        auth()->user()->subscribed()->attach($user);
    }

    public function unsubscribe(User $user)
    {
        auth()->user()->subscribed()->detach($user);
    }

    public function render()
    {
        $this->subscribedIds = auth()->user()->subscribedIds;
        return view('livewire.lists', [
            'lists' => User::withCount('todos')
            ->whereNot('id', auth()->user()->id)
            ->paginate(5)
        ]);
    }
}
