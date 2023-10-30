<?php

namespace Module\Todo\Commands;

class CreateTodoCommand
{
    public function __construct(
        public int $userId,
        public string $content,
    )
    {
    }

}
