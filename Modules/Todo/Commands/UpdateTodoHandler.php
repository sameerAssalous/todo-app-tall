<?php

namespace Module\Todo\Commands;

use Module\Todo\Repositories\TodoRespository;

class UpdateTodoHandler
{
    public function __construct(private TodoRespository $todoRespository)
    {
    }

    public function handle(UpdateTodoCommand $command)
    {
        $this->todoRespository->updateTodo($command->todoId, ['content' => $command->content] );
    }

}
