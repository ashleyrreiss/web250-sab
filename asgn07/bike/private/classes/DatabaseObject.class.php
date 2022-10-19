<?php require_once('Bicycle.class.php');


class DatabaseObject {
  
  static protected $database;
  static protected $table_name = "";
  static protected $columns = [];
  public $errors = [];

  /**
   * Set the database to be used
   *
   * @param   [string]  $database  name of the database
   *
   */
  static public function set_database($database) {
    self::$database = $database;
  }

  /**
   * Use SQL statement to find something in the database
   *
   * @param   string  $sql  SQL statement - built in find_by_id() or 
   *    find_all()
   *
   * @return  [string/array]     an error, if no results, or an array of 
   * results from the SQL statement
   */
  static public function find_by_sql($sql) {
    $result = static::$database->query($sql);
    if(!$result) {
      exit("Database query failed");
    }

    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = static::instantiate($record);
    };

    $result->free();

    return $object_array;
  }

  /**
   * Builds SQL statement to find all columns from a given table
   *
   * @return  [string]  SQL statement
   */
  static public function find_all() {
    $sql="SELECT * FROM " . static::$table_name . " ";
    return static::find_by_sql($sql);
  }

  /**
   * Build SQL statement from given id
   *
   * @param   string  $id  the id to be located in database
   *
   * @return  [string/bool]       first object in array, or false if no results
   */
  static public function find_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name;
    $sql .= " WHERE id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  /**
   * Instantiate a new object
   *
   * @param   [string]  $record  record to be instantiated
   *
   * @return  [string]           returns instantiated object
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
   * Skeleton for object validation function, to be customized
   * for each class
   *
   */
  protected function validate() {
    $this->errors = [];

    // add custom variations 
    
    return $this->errors;
  }

  /**
   * an instance function: create instance using SQL statement,
   * taking attributes from the attributes() function
   *
   * @return  [boolean]  True/False - succeeded in creation
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
   * Update object with new information
   *
   * @return  [string/boolean]  success (SQL string) or not success (false)
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
   * Creates if it isn't created yet, or updates if it has already
   * been created
   *
   * @return  [function]  executes a function
   */
  public function save() {
    if(isset($this->id)) {
      return $this->update();
    } else {
      return $this->create();
    }
  }

  /**
   * Takes attribute arguments and merges them
   *
   * @param   [array]  $args  the array of arguments to be merged
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
   * Builds columns from attributes, excluding the id column,
   * using the db_columns() function
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
   * @return  [array]  array of escaped values
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

    // After deleting, the instance of the object will still exist even
    // though the database record does not. This can be useful, as in:
    //  echo $user->first_name . " was deleted.";
    // but, for example, we can't call $user->update() after calling
    // $user->delete().
  }
}

?>
