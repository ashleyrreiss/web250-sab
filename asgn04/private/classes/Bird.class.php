<?php 

class Bird {
  public $common_name;
  public $habitat;
  public $food;
  public $nest_placement;
  public $behavior;
  protected $conservation_id;
  public $backyard_tips;
  
  protected const CONSERVATION_OPTIONS = [
    1 => 'Low',
    2 => 'Moderate',
    3 => 'High',
    4 => 'Extreme'
  ];

  public function __construct($args=[]) {
    $this->common_name = $args['common_name'] ?? '';
    $this->habitat = $args['habitat'] ?? '';
    $this->food = $args['food'] ?? '';
    $this->nest_placement = $args['nest_placement'] ?? '';
    $this->behavior = $args['behavior'] ?? '';
    $this->conservation_id = $args['conservation_id'] ?? '';
    $this->backyard_tips = $args['backyard_tips'] ?? '';
  }

  public function conservation() {
    if($this->conservation_id > 0) {
      return self::CONSERVATION_OPTIONS[$this->conservation_id];
    } else {
      return 'Unknown';
    }
  }
}
?>
