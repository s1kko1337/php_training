<?php
require_once 'page.php';

abstract class Cached extends Page
{
    protected $expires;
    protected $store;

    public function __construct($title = '', $content = '', $expires = 60)
    {
        parent::__construct($title, $content);
        $this->expires = $expires;

        // $this->store = new Redis(
        //     'host' => getenv('REDIS_HOST'),
        //     'port' => getenv('REDIS_PORT'),
        //     'connectTimeout' => $this->expires); 

        $this->set($this->id('title'), $title);
        $this->set($this->id('content'), $content);
    }

    // Проверить, есть ли позиция $key в кеше 
    protected function isCached($key)
    {
        // return (bool) $this->store->get($key);
    }

    // Поместить в кеш по ключу $key значение $value.     
    // В случае, если ключ уже существует:
    // 1. Не делать ничего, если $force принимает значение false.     
    // 2. Переписать, если $force принимает значение true. 
    protected function set($key, $value, $force = false)
    {
        // if ($force) {
        //     $this->store->set($key, $value, $this->expires);
        // } else {
        //     if ($this->isCached($key)) {
        //         $this->store->set($key, $value, $this->expires);
        //     }
        // }
    }

    protected function get($key)
    {
        // return $this->store->get($key);
    }

    // Формируем уникальный ключ для хранилища
    abstract public function id(mixed $name): string;

    // Получение заголовка страницы  
    final public function title()
    {
        // if ($this->isCached($this->id('title'))) {
        //     return $this->get($this->id('title'));
        // } else {
            return parent::title();
        // }
    }
    // Получение содержимого страницы    
    final public function content()
    {
        // if ($this->isCached($this->id('content'))) {
        //     return $this->get($this->id('content'));
        // } else {
            return parent::content();
        // }
    }
}
