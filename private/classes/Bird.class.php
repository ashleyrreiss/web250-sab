<?php

class Bird extends DatabaseObject {

  // ----- START OF ACTIVE RECORD CODE ------
  static protected $database;
  static protected $db_columns = ['id', 'common_name', 'habitat', 'food'];
  static protected $table_name = 'birds';

  public $id;
  public $common_name;
  public $habitat;
  public $food;

  public function __construct($args=[]) {
    $this->common_name = $args['common_name'] ?? '';
    $this->habitat = $args['habitat'] ?? '';
    $this->food = $args['food'] ?? '';
  }

  static public function set_database($database) {
    self::$database = $database;
  }

  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = self::instantiate($record);
    }

    $result->free();

    return $object_array;
  }

  static public function find_all() {
    $sql = "SELECT * FROM birds";
    return self::find_by_sql($sql);
  }

  static public function find_by_id($id) {
    $sql = "SELECT * FROM birds ";
    $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = self::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static protected function instantiate($record) {
    $object = new self;
    // Could manually assign values to properties
    // but automatically assignment is easier and re-usable
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

public function merge_attributes($arg=[]) {
  foreach($arg as $key => $value) {
   // echo "key: $key value: $value<br>";
    if(property_exists($this, $key) && !is_null($value)) {
      // echo "this->key: " . $this->$key . "<br>";
      // echo "value:"  . $value . "<br>";
      $this->$key = $value;
    }
  }
}

// TODO - show how array_keys and array_values work
public function create() {
  $attributes = $this->sanitized_attributes();
  $sql = "INSERT INTO birds (";
  $sql .= join(', ', array_keys($attributes));
  $sql .= ") VALUES ('";
  $sql .= join("', '", array_values($attributes));
  $sql .= "')";
  $result = self::$database->query($sql);
  if($result) {
    $this->id = self::$database->insert_id;
  }
  return $result;
}

  // The properties which have the database columns excluding id
  public function attributes() {
    $attributes = [];
    foreach(self::$db_columns as $column) {
      if($column == 'id') { 
        continue; 
      }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }
  // ----- END OF ACTIVE RECORD CODE ------

  public function name() {
    return "{$this->common_name}";
  }

}

?>
