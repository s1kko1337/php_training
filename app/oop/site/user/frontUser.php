<?php
require_once 'user.php';
require_once 'interfaces/avatar.php';

class FrontUser extends User implements Avatar {
    private readonly string $path;

    public function setImage(string $path): void
    {
        $this->path = $path;
    }
    public function getImage(): string
    {
        return $this->path;
    }
} 