<?php

namespace App\Form\Model;

use App\Entity\Book;

class BookDto
{
    public $title;
    public $base64Image;
    public $categories;

    public function __construct()
    {
        $this->categoires = [];
    }

    public function createFromBook(Book $book): self
    {
        $dto = new self();
        $dto->title = $book->getTitle();

        return $dto;
    }
}
