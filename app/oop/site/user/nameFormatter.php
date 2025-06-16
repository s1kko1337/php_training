<?php
require_once 'interfaces/namable.php';

class NameFormatter {
    public function format(Namable $user) : string {
        $name = trim($user->getFirstName() . ' ' . $user->getSecondName());
        return $name ?: 'Anon user';
    }
}