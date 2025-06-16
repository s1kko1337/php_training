<?php
require_once 'backendUser.php';
require_once 'traits/image.php';

class Moderator extends BackendUser
{
    use ImageTrait;
}

$user = new Moderator('igorsimdyanov@gmail.com',   'password',   'Игорь',   'Симдянов');
$user->setImage('avatar.png');
echo $user->getImage(); 