<?php
trait Serio
{
    public static function size(): int
    {
        return count(self::cases());
    }
}
