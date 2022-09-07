<?php

class Bird {
  var $commonName;
  var $food;
  var $nestPlacement;
  var $clutchSize;
  var $conservationLevel;
  var $song;

  function birdSong() {
    return "The " . $this->commonName . "'s song sounds like someone saying " . $this->song . "<br>";
  }
}

$bird1 = new Bird;

$bird1->commonName = "Eastern Towhee";
$bird1->food = "Seeds, fruits, insects, spiders";
$bird1->nestPlacement = "Ground";
$bird1->clutchSize = "2 - 6 eggs";
$bird1->conservationLevel = "Low";
$bird1->song = "drink-your-tea!";

$bird2 = new Bird;

$bird2->commonName = "Indigo Bunting";
$bird2->food = "Small seeds, berries, buds, insects";
$bird2->nestPlacement = "fields and on the edges of woods, roadsides, railroads";
$bird2->clutchSize = "3 - 4 eggs";
$bird2->conservationLevel = "Low";
$bird2->song = "what! what!";

echo "Bird: " . $bird1->commonName . "<br>";
echo "Food: " . $bird1->food . "<br>";
echo "Nest Placement " . $bird1->nestPlacement . "<br>";
echo "Clutch Size: " . $bird1->clutchSize . "<br>";
echo "Conservation Level: " . $bird1->conservationLevel . "<br>";
echo $bird1->birdSong() . "<br>";

echo "Bird: " . $bird2->commonName . "<br>";
echo "Food: " . $bird2->food . "<br>";
echo "Nest Placement " . $bird2->nestPlacement . "<br>";
echo "Clutch Size: " . $bird2->clutchSize . "<br>";
echo "Conservation Level: " . $bird2->conservationLevel . "<br>";
echo $bird2->birdSong() . "<br>";

?>
