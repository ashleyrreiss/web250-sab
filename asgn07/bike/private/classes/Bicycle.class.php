<?php

class Bicycle extends DatabaseObject {

  static protected $table_name = 'bicycles';

  /**
   * establish the column names to use for Bicycle class
   *
   * @var [array]   column names
   */

  static public $db_columns = ['id', 'brand', 'model', 'year', 'category', 'color', 'gender', 'price', 'weight_kg', 'condition_id', 'description'];


  public $id;
  public $brand;
  public $model;
  public $year;
  public $category;
  public $color;
  public $description;
  public $gender;
  public $price;
  public $weight_kg;
  public $condition_id;

  public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];

  public const GENDERS = ['Mens', 'Womens', 'Unisex'];

  public const CONDITION_OPTIONS = [
    1 => 'Beat up',
    2 => 'Decent',
    3 => 'Good',
    4 => 'Great',
    5 => 'Like New'
  ];


  /**
   * Construct the properties of a bicycle object
   *
   * @param   [array]  $args  An array of arguments to populate
   *    the properties of a bicycle object
   *
   */
  public function __construct($args=[]) {
    //$this->brand = isset($args['brand']) ? $args['brand'] : '';
    $this->brand = $args['brand'] ?? '';
    $this->model = $args['model'] ?? '';
    $this->year = $args['year'] ?? '';
    $this->category = $args['category'] ?? '';
    $this->color = $args['color'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->gender = $args['gender'] ?? '';
    $this->price = $args['price'] ?? 0;
    $this->weight_kg = $args['weight_kg'] ?? 0.0;
    $this->condition_id = $args['condition_id'] ?? 3;

    // Caution: allows private/protected properties to be set
    // foreach($args as $k => $v) {
    //   if(property_exists($this, $k)) {
    //     $this->$k = $v;
    //   }
    // }
  }

  /**
   * Builds a proper name for a bicycle object
   *
   * @return  [string]  Combines brand, model, and year into
   *    a name for the bicycle
   */
  public function name() {
    return "{$this->brand} {$this->model} {$this->year}";
  }

  /**
   * Format the weight in kilograms to have two decimal points
   *
   * @return  [string]  the formatted weight in kilograms with 'kg'
   */
  public function weight_kg() {
    return number_format($this->weight_kg, 2) . ' kg';
  }

  /**
   * Set the weight in kilograms, formatted
   *
   * @param   [int]  $value  the weight to set
   *
   */
  public function set_weight_kg($value) {
    $this->weight_kg = floatval($value);
  }

  /**
   * Convert weight in kilograms to weight in pounds, formatted
   *
   * @return  [string]  Formatted weight in pounds
   */
  public function weight_lbs() {
    $weight_lbs = floatval($this->weight_kg) * 2.2046226218;
    return number_format($weight_lbs, 2) . ' lbs';
  }

  /**
   * Set the weight in pounds, formatted
   *
   * @param   [int]  $value  weight to set, in pounds 
   *
   */
  public function set_weight_lbs($value) {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }

  /**
   * Convert the condition number to the matching condition string
   *  in condition_options  
   *
   * @return  [string]  Either a condition string, or unknown if no condition id
   */
  public function condition() {
    if($this->condition_id > 0) {
      return self::CONDITION_OPTIONS[$this->condition_id];
    } else {
      return "Unknown";
    }
  }

  /**
   * Validate that brand and model are not NULL when inserting or editing
   * the bicycle class
   *
   * @return  [string]  errors, if there are any. Otherwise, nothing.
   */
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->brand)) {
      $this->errors[] = "Brand cannot be blank.";
    }
    if(is_blank($this->model)) {
      $this->errors[] = "Model cannot be blank.";
    }
    return $this->errors;
  }

}

?>
