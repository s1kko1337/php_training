<?php

class Container
{
    private $title = 'CONTAINER';
    protected $id = 1;
    public function anonym()
    {
        return new class($this->title) extends Container {
            private $name;

            public function __construct($title)
            {
                $this->name = $title;
            }

            public function __toString()
            {
                echo "{$this->name} : {$this->id}";
            }
        };
    }
}

echo (new Container)->anonym();
