<?php 

class Bird extends DatabaseObject {

  static protected $table_name = 'birds';

  static protected $db_columns = ['id', 'common_name', 'habitat', 'food', 'conservation_id', 'backyard_tips'];

  public $id;
  public $common_name;
  public $habitat;
  public $food;
  public $conservation_id;
  public $backyard_tips;
  
  public const CONSERVATION_OPTIONS = [
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

  /**
   * Validate that common_name and habitat are not NULL when
   * inserting or editing the Bird class
   *
   * @return  [array]  errors, if there are any, otherwise,
   *    nothing.
   */
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->common_name)) {
      $this->errors[] = "Common name cannot be blank.";
    }
    if(is_blank($this->habitat)) {
      $this->errors[] = "Habitat cannot be blank.";
    }
    return $this->errors;
  }
}
?>
