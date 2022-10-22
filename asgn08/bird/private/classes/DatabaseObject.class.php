<?php

class DatabaseObject {
  static protected $database;
  static protected $table_name = "";
  static protected $db_columns = [];
  public $errors = [];

  /**
   * Take database value from database_functions and set it as
   * the database for use on site
   *
   * @param   [string]  $database  [database connect variable from initialize.php]
   */

  static public function set_database($database) {
    self::$database = $database;
  }

  /**
   * Takes SQL statement and finds query in database
   *
   * @param   [string]  $sql  [Takes SQL statement from find_all() 
   *    or find_by_id()]
   *
   * @return  [string/boolean message]        [If no result, returns false,
   *    exits and displays failed message. If result, returns object array
   *    that corresponds to the inserted SQL statement]
   */
  
  static public function find_by_sql($sql) {
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    };

    $result->free();

    return $object_array;
  }

  /**
   * Finds all objects in class
   *
   * @return  [string]  [returns sql statement that finds all
   *    objects in bird class]
   */

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name;
    return static::find_by_sql($sql);
  }

  /**
   * Plugs an ID into a SQL statement and uses find_by_sql function
   * to fetch an object from the object array
   *
   * @param   [string]  $id  [id of an object]
   *
   * @return  [string/boolean]       [Returns first element in object array,
   *    or if object array is empty, returns false]
   */

  static public function find_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE ID='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  /**
   * Takes record (from find_by_sql function) and if it exists, 
   * converts it to a new instantiated object
   *
   * @param   [string]  $record  [variable from find_by_sql function]
   *
   * @return  [string]           [instantiated object value]
   */

  static protected function instantiate($record) {
    $object = new static;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  /**
   * Skeleton for object validation function, to be 
   * customized for each class
   */

  protected function validate() {
    $this->errors = [];

    // Add custom validations

    return $this->errors;
  }

  /**
   * Create instance using SQL statement, taking attributes
   * from attributes()
   *
   * @return  [boolean]  True/False - success in creation
   */

  protected function create() {
    $this->validate();
    if(!empty($this->errors)) { return false; }

    $attributes = $this->sanitized_attributes();
    $sql = "INSERT INTO " . static::$table_name . " (";
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

  /**
   * Update object with new attribute values
   *
   * @return  [string/boolean]  success returns SQL string
   *    Unsuccessful returns false
   */

  protected function update() {
    $this->validate();
    if(!empty($this->errors)) { return false; }
    $attributes = $this->sanitized_attributes();
    $attribute_pairs = [];
    foreach($attributes as $key => $value) {
      $attribute_pairs[] = "{$key}='{$value}'";
    }

    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= join(', ', $attribute_pairs);
    $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }

  /**
   * Creates if it doesn't have an ID value set, or updates
   * if it has already had an ID value set
   *
   * @return  [function]  executes appropriate function
   */

  public function save() {
    // A new record will not have an ID yet
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  /**
   * Takes attribute arguments and merges them into values
   * if the property exists and is not null
   *
   * @param   [array]  $args  the array of arguments to be 
   *    merged
   *
   */

  public function merge_attributes($args=[]) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  /**
   * Builds columns from attributes, excluding the ID column
   * using the db_columns array
   *
   * @return  [array]  attributes array
   */

  public function attributes() {
    $attributes = [];
    foreach(static::$db_columns as $column) {
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }

  /**
   * Escapes characters for sanitized value input
   *
   * @return  [array]  array of escaped attribute values
   */

  protected function sanitized_attributes() {
    $sanitized = [];
    foreach($this->attributes() as $key => $value) {
      $sanitized[$key] = self::$database->escape_string($value);
    }
    return $sanitized;
  }

  /**
   * Builds SQL statement to delete one row in the database
   *
   * @return  [string]  SQL statement for deleting row
   */

  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;

    // After deleting, the instance of the object will still
    // exist, even though the database record does not.
    // This can be useful, as in:
    //    echo $user->first_name . " was deleted.";
    // but, for example, we can't call $user->update() after
    // calling $user->delete();
  }
}

?>