<?php 

class Books {
  public $title;
  public $author;
  public $format;

  public function book_by_author() {
    return $this->title . " is by " . $this->author . ".<br>";
  }

  public function format() {
    return "Format: " . $this->format;
  }

  public function set_format($value) {
    $this->format = $value;
  }
}

class Novel extends Books {
  protected $is_fiction = true;
  public $main_character;

  public function type() {
    return "This book is a fictional story about a character named " . $this->main_character . ".<br>";
  }
}

class Textbook extends Books {
  protected $is_fiction = false;
  public $subject;

  public function type() {
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

echo $b1->book_by_author();
echo $b1->type();
$b1->set_format("Hardcover");
echo $b1->format() . "<br><br>";

echo $b2->book_by_author();
echo $b2->type();
$b2->set_format("Paperback");
echo $b2->format() . "<br><br>";


?>
