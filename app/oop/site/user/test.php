<?php
require_once 'traits/image.php';


class testUser
{
    public function __construct(
        public string $email,
        private string $password,
        public ?string $first_name = null,
        public ?string $last_name = null
    ) {}
    public function fullName(): string
    {
        $arr_name = array_filter([$this->first_name, $this->last_name]);
        $full_name = implode(' ', $arr_name);
        return empty($full_name) ? 'Анонимный пользователь' : $full_name;
    }
}


trait Name
{
    public function fullName(): string
    {
        return parent::fullName() . ' modertator';
    }
}

class Moderator extends testUser
{
    use ImageTrait;
    use Name;
    public function fullName(): string
    {
        return parent::fullName() . ' HUY';
    }
}


//наследник>трейт>базовый класс

$user = new Moderator('igorsimdyanov@gmail.com',   'password',   'Игорь',   'Симдянов');
echo $user->fullName();



trait Tag
{
    public function tags(): void
    {
        echo 'Tag::tags<br />';
    }
    public function themes(): void
    {
        echo 'Tag::themes<br />';
    }
}
trait Theme
{
    public function tags(): void
    {
        echo 'Theme::tags<br />';
    }
    public function themes(): void
    {
        echo 'Theme::themes<br />';
    }
}

class PageTest
{
    use Theme, Tag {
        Tag::tags insteadof Theme;
        Theme::themes insteadof Tag;
        Theme::tags as themeTags;
        Tag::themes as tagThemes;
    }
}

$page = new PageTest();
$page->themes();
$page->tags();
$page->themeTags();
$page->tagThemes();