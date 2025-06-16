<?php

trait ImageTrait {
    public function getImage() : string {
        return $this->path;
    }
    public function setImage(string $path) : void {
        $this->path = $path;
    }
}