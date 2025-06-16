<?php

trait Translatable
{
    public function russian(): string
    {
        return match ($this) {
            static::Red => 'Красный',
            static::Оrange => 'Оранжевый',
            static::Yellow => 'Желтый',
            static::Green => 'Зеленый',
            static::Blue => 'Голубой',
            static::Indigo => 'Синий',
            static::Violet => 'Фиолетовый'
        };
    }

    public function english(): string
    {
        return match ($this) {
            static::Red => 'Red',
            static::Оrange => 'Оrange',
            static::Yellow => 'Yellow',
            static::Green => 'Green',
            static::Blue => 'Blue',
            static::Indigo => 'Indigo',
            static::Violet => 'Violet'
        };
    }
}
