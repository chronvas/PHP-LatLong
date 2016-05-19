<?php
 
$time_start = microtime(true);
 

$servername = "localhost";
$username = "_____";
$password = "_____";
$dbname = "_____";

try {
	$db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $statement = $db->prepare("SELECT lat, longt FROM Locations LIMIT 190000");
	$statement->execute(); 
	$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
	//print_r($rows);
	
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

// THE Center point
$latitudeFrom = 30.000000;
$longitudeFrom = 30.000000;
$howmanyresults = 0;

foreach ($rows as &$value) {
	echo "</p>";
    echo "</p>";
    $distanceInMeters =  vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom,$value['lat'],$value['longt']);
    
    if ($distanceInMeters < 20000){
		// If the distance is less than 20.000 meters
		echo "point found:: ",$value['lat'], " " ,$value['longt'];
		echo "</p>";
		$howmanyresults = $howmanyresults + 1;
	}
}

$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Time for operation";
echo $time;
echo "</p>";
echo "Results found: ";
echo $howmanyresults;
	
	
function vincentyGreatCircleDistance(  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo ){
	$earthRadius = 6371000;
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}


?>
