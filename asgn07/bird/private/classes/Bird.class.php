<?php 

class Bird {

  // ----- START OF ACTIVE RECORD CODE -----
  static protected $database;

  /**
   * Take database value from database_functions and set it as
   * the database for use on site
   *
   * @param   [string]  $database  [database connect variable from initialize.php]
   *
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
      $object_array[] = self::instantiate($record);
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
    $sql = "SELECT * FROM birds";
    return self::find_by_sql($sql);
  }

  /**
   * Plugs an ID into a SQL statment and uses find_by_sql function
   * to fetch an object from the object array
   *
   * @param   [string]  $id  [id of an object]
   *
   * @return  [string/boolean]       [Returns first element in object array,
   *    or if object array is empty, returns false]
   */

  static public function find_by_id($id) {
    $sql = "SELECT * FROM birds ";
    $sql .= "WHERE ID='" . self::$database->escape_string($id) . "'";
    $obj_array = self::find_by_sql($sql);
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
    $object = new self;
    foreach($record as $property => $value) {
      if(property_exists($object, $property)) {
        $object->$property = $value;
      }
    }
    return $object;
  }

  // ------ END OF ACTIVE RECORD CODE -----

  public $id;
  public $common_name;
  public $habitat;
  public $food;
  protected $conservation_id;
  public $backyard_tips;
  
  protected const CONSERVATION_OPTIONS = [
    1 => 'Low',
    2 => 'Moderate',
    3 => 'High',
    4 => 'Extreme'
  ];

  /**
   * Constructs class variables for object creation
   *
   * @param   [string/array]  $args  [Array of class variables to populate
   *    the new object]
   *
   */
  public function __construct($args=[]) {
    $this->common_name = $args['common_name'] ?? '';
    $this->habitat = $args['habitat'] ?? '';
    $this->food = $args['food'] ?? '';
    $this->conservation_id = $args['conservation_id'] ?? '';
    $this->backyard_tips = $args['backyard_tips'] ?? '';
  }

  /**
   * Takes conservation id number and converts it to the phrase
   * that correlates with the id number from the CONSERVATION_OPTIONS
   * constant array in the class instantiation
   *
   * @return  [string]  [correlating string from array CONSERVATION_OPTIONS]
   */

  public function conservation() {
    if($this->conservation_id > 0) {
      return self::CONSERVATION_OPTIONS[$this->conservation_id];
    } else {
      return 'Unknown';
    }
  }

  /**
   * Create a name to be used on site, as for page title
   *
   * @return  [string]  [The full name of the bird]
   */

  public function name() {
    return "{$this->common_name}";
  }
}
?>
