<?php

    class Book
    {
        private $book_title;
        private $id;

        function __construct($book_title, $id = null)
        {
            $this->book_title = $book_title;
            $this->id = $id;
        }

        function getBookTitle()
        {
            return $this->book_title;
        }

        function setBookTitle($new_book_title)
        {
            $this->book_title = (string) $new_book_title;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO books (book_title) VALUES ('{$this->getBookTitle()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }

        }
            
        static function getAll()
        {
           $returned_books = $GLOBALS['DB']->query("SELECT * FROM books;");
           $books = array();
           foreach($returned_books as $book) {
               $book_name = $book['book_title'];
               $id = $book['id'];
               $new_book = new Book($book_name, $id);
               array_push($books, $new_book);
           }
           return $books;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM books;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

    }
 ?>
