<?php

class Dumper {
    public static function print($ob) : void{
        print_r($ob);     
    }
}

Dumper::print(new class {
    public $title;
    public function __construct()
    {
        $this->title = 'Hello world';
    }
});