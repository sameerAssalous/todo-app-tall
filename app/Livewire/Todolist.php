<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Module\Todo\Commands\CreateTodoCommand;
use Module\Todo\Commands\CreateTodoHandler;
use Module\Todo\Commands\UpdateTodoCommand;
use Module\Todo\Commands\UpdateTodoHandler;
use Module\Todo\Models\Todo;

class Todolist extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:5000')]
    public $content = '';

    public $userId;

    public $userName;

    #[Rule('required|min:3|max:5000')]
    public $editedContent;
    public $editedTodoId = null;

    public function boot(
        CreateTodoHandler $createTodoHandler,
        UpdateTodoHandler $updateTodoHandler,
    ){
        $this->createTodoHandler = $createTodoHandler;
        $this->updateTodoHandler = $updateTodoHandler;
    }

    public function deleteTodo(Todo $todo)
    {
        $todo->delete();
    }

    public function toggleComplete(Todo $todo)
    {
        $todo->completed_at = ($todo->completed_at) ? null : Carbon::now()->toDateTimeString();
        $todo->save();
    }

    public function editTodo(Todo $todo)
    {
        if (request()->user()->cannot('edit', $todo)) {
            abort(403);
        }
        $this->editedTodoId = $todo->id;
        $this->editedContent = $todo->content;
    }

    public function cancelEdit()
    {
        $this->reset('editedTodoId', 'editedContent');
    }
    public function updateTodo(Todo $todo)
    {
        $this->validateOnly('editedContent');
        $this->updateTodoHandler->handle(
            new UpdateTodoCommand(
                $todo->id,
                $this->editedContent
            )
        );
        $this->cancelEdit();
    }

    public function addTodo()
    {
        $this->validateOnly('content');
        $this->createTodoHandler->handle(
            new CreateTodoCommand(
                auth()->user()->id,
                $this->content
            )
        );
        $this->reset('content');
        session()->flash('success', 'Saved');
    }

    public function render()
    {
        $this->userName = User::findOrFail($this->userId)->name;
        return view('livewire.todolist', [
            'todos' => Todo::where('user_id',$this->userId)->latest()->paginate(5)]);
    }
}
