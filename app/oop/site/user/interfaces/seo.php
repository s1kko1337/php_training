<?php

interface Seo {
    public function Seo(
        ?string $title,
        ?string $description,
        ?array $keywords
    );
    public function title() : ?string;
    public function description() : ?string;
    public function keywords() : ?array;
}