<?php

class Bicycle {
  var $brand;
  var $model;
  var $year;
  var $description = "Used bicycle";
  var $weight_kg = 0.0;

  function name() {
    return $this->brand . " " . $this->model . " " . "(" . $this->year . ")" . "<br>";
  }

  function weight_lbs() {
    return "The weight is " . floatval($this->weight_kg) * 2.2046226218 . " lbs.";
  }

  function set_weight_lbs($value) {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }
}

$trek = new Bicycle;

$trek->brand = "Trek";
$trek->model = "Enonda";
$trek->year = "2017";
$trek->weight_kg = "1.0";

$cd = new Bicycle;

$cd->brand = "Cannondale";
$cd->model = "Synapse";
$cd->year = "2016";
$cd->weight_kg = "8.0";

echo $trek->name() . "<br>";
echo $cd->name() . "<br>";

echo "The weight is " . $trek->weight_kg . " kg.<br>";
echo $trek->weight_lbs() . "<br>";

$trek->set_weight_lbs(2);
echo "The weight is " . $trek->weight_kg . " kg.<br>";
echo $trek->weight_lbs() . "<br>";

?>
