<?php

namespace Module\Todo\Commands;

class UpdateTodoCommand
{
    public function __construct(
        public int $todoId,
        public string $content
    )
    {
    }
}
