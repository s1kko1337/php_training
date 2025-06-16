<?php
require_once 'interfaces/namable.php';

abstract class User implements Namable
{
    public function __construct(
        public string $email,
        private string $password,
        public ?string $first_name = null,
        public ?string $second_name = null
    ) {}
    
    public function getFirstName(): ?string{
        return $this->first_name;
    }

    public function getSecondName() : ?string{
        return $this->second_name;
    }
}
