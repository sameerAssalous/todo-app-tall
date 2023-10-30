
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    {{ $userName }} {{ __('messages.list') }}
</h2>
</x-slot>

<div id="content" class="mx-auto" style="max-width:500px;">
<div class="container content py-6 mx-auto">
@if(auth()->user()->id == $userId)
    @include('livewire.includes.todo_form')
@endif
</div>

<div id="todos-list">
@foreach($todos as $todo)

    @include('livewire.includes.todo_item', ['todo' => $todo, 'index' => $loop->iteration ])
    @endforeach
<div class="my-2">
    {{ $todos->links() }}
</div>
</div>
</div>

