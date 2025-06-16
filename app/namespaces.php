<?php

namespace PHP8;

const VERSION = PHP_VERSION;


function printer(array|object $obj): void
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

class Page
{
    protected string $title;
    protected string $content;

    public function __construct(string $title = '', string $content = '')
    {
        $this->title = $title;
        $this->content = $content;
    }
}
