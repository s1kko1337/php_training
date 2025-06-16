<?php
require_once 'topic.php';
require_once 'traits/seo.php';
require_once 'traits/authors.php';
// class Article extends Topic implements Authors, Seo
// {
//     public array $authors;
//     private ?string $seo_title;
//     private ?string $seo_description;
//     private ?array $seo_keywords;


//     public function getAuthors(): array
//     {
//         return $this->authors;
//     }
//     public function setAuthors(array $authors): void
//     {
//         $this->authors = $authors;
//     }

//     public function Seo(?string $title, ?string $description, ?array $keywords)
//     {
//         $this->seo_title = $title;
//         $this->seo_description = $description;
//         $this->seo_keywords = $keywords;
//     }
//     public function title(): ?string
//     {
//         if (!empty($this->seo_title)) {
//             return $this->seo_title;
//         } else {
//             return $this->title;
//         }
//     }

//     public function description(): ?string
//     {
//         return $this->seo_description;
//     }

//     public function keywords(): ?array
//     {
//         return $this->seo_keywords;
//     }
//     public function __construct(
//         string $title,
//         string $content,
//         $published_at = null
//     ) {
//         parent::__construct($title, $content, $published_at);
//     }
// }

class Article{
    use AuthorsTrait;
    use SeoTrait;
}

$obj = new Article('Заголовок', 'Содержимое');
$obj->setAuthors(['Дмитрий Котеров', 'Игорь Симдянов']);
$obj->seo('SEO-заголовок');
echo $obj->title(); // SEO-заголовок 

print_r($obj);
