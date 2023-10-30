<?php

namespace Module\Todo\Repositories;


use Module\Todo\Models\Todo;

class TodoRespository
{
    public function createTodo($userId, $content)
    {
        Todo::create([
            'user_id' => $userId,
            'content' => $content,
        ]);
    }

    public function updateTodo($id, $fields)
    {
        Todo::where('id',$id)->update($fields);
    }

    public function deleteTodo($id)
    {
        Todo::where('id',$id)->delete();
    }

    public function addTodoToUser($todoId, $userId)
    {
        $todo = Todo::findOrFail($todoId);
    }

    public function listTodos()
    {

    }
}
