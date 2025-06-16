<?php require_once 'cached.php';
class StaticPage extends Cached
{
    // Конструктор класса 
    public function __construct($id)
    {
        // Проверяем, нет ли такой страницы в кеше  
        if ($this->isCached($this->id($id))) {
            // Есть, инициализируем объект содержимым кеша      
            parent::__construct($this->title(), $this->content());
        } else {             // Данные пока не кешированы, извлекаем            
            // содержимое из базы данных     
            // $query = "SELECT * FROM news WHERE id = :id LIMIT 1"       
            // $sth = $dbh->prepare($query);       
            // $sth = $dbh->execute($query, [$id]);      
            // $page = $sth->fetch(PDO::FETCH_ASSOC);          
            // parent::__construct($page['title'], $page['title']);   
            parent::__construct(
                'Новости',
                'Содержимое страницы Новости'
            );
        }
    }
    // Уникальный ключ для кеша   
    public function id(mixed $name): string
    {
        return "news_{$name}";
    }
}
