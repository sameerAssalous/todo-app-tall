<?php

namespace Module\Todo\Commands;

use Module\Todo\Repositories\TodoRespository;

class CreateTodoHandler
{
    public function __construct(private TodoRespository $todoRespository)
    {
    }

    public function handle(CreateTodoCommand $command)
    {
        $this->todoRespository->createTodo($command->userId, $command->content);
    }

}
