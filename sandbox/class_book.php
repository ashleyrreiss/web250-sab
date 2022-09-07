<?php

class Book {

  //properties
  var $title;
  var $author;

  //methods

  function show_due_date() {
    // return today's date
    return date('d F, Y');
  }

  function display_book_author() {
    return "This book is titled " . $this->title . " and is written by " . $this->author . ".<br>";
  }

  function reservation_status($int) {
    // 0 = checked out
    // 1 = available
    
  }
}

// instantiate class into an object
$book = new Book;

$book->title = "The Hobbit";
$book->author = "J.R.R. Tolkien";

echo $book->display_book_author();

$book2 = new Book;

$book2->title = "The Lord of the Flies";
$book2->author = "William Golding";

echo $book2->display_book_author();

?>