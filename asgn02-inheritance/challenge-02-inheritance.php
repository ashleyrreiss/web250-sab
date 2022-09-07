<?php 

class Books {
  var $title;
  var $author;

  function book_by_author() {
    return $this->title . " is by " . $this->author . ".<br>";
  }
}

class Novel extends Books {
  var $is_fiction = true;
  var $main_character;

  function type() {
    return "This book is a fictional story about a character named " . $this->main_character . ".<br>";
  }
}

class Textbook extends Books {
  var $is_fiction = false;
  var $subject;

  function type() {
    return "This book is a nonfiction book about " . $this->subject . ".<br>";
  }
}

$b1 = new Novel;
$b1->title = "Hatchet";
$b1->author = "Gary Paulsen";
$b1->main_character = "Brian";

$b2 = new Textbook;
$b2->title = "A Web-Based Introduction to Programming";
$b2->author = "Mike O'Kane";
$b2->subject = "computer programming";

echo $b1->book_by_author() . "<br>";
echo $b1->type() . "<br>";

echo $b2->book_by_author() . "<br>";
echo $b2->type() . "<br>";


?>
