<?php

trait AuthorsTrait
{
    public array $authots;

    public function getAuthors(): array
    {
        return $this->authors;
    }
    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }
}
