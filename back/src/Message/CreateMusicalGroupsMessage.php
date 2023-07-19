<?php

namespace App\Message;

class CreateMusicalGroupsMessage
{

    public function __construct(private string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
