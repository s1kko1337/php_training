<?php

class Base {
    public static function title() : void {
        echo __CLASS__;
    }

    public static function test() : void {
        static::title(); // self:: в наследнике будет родительский класс решение- static::
    }
}

class Children extends Base {
    public static function title() : void {
        echo __CLASS__;
    }
}

Children::test();
