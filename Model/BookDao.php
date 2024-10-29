<?php
interface BookDao {
    public function getAllBooks();
    public function getBook($id);
    public function createBook($book);
    public function updateBook($book);
    public function deleteBook($id);
}

