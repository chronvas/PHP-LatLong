<?php
// Functions 
// random float with range function
function random_float ($min,$max) {
   return ($min+lcg_value()*(abs($max-$min)));
}

function insert_into_SQL($lat_arr,$long_arr,$max_array_size){
	//Sql pdo
	$servername = "localhost";
	$username = "_____";
	$password = "_____";
	$dbname = "_____";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		for ($i = 0; $i < $max_array_size; $i += 1) {
			$sql = "INSERT INTO Locations (lat, longt)
			VALUES ('$lat_arr[$i]', '$long_arr[$i]')";
			// use exec() because no results are returned
			$conn->exec($sql);
		}    
    
		
		echo "New records created successfully";
		}
	catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
    }

	$conn = null;

}

// create empty arrays of 10k for lat and long
$max_array_size = 50000;
$lat_arr = array_fill(0, $max_array_size, NULL);
$long_arr  = array_fill(0, $max_array_size, NULL);

// fill the elements in the array with random floats with range
for ($i = 0; $i < $max_array_size; $i += 1) {
  $lat_arr[$i] = random_float(20.000001,40.000001);
  $long_arr[$i] = random_float(20.000001,40.000001);
}
echo "----</p>";
// print the array
for ($i = 0; $i < $max_array_size; $i += 1) {
	//echo "----</p>";
  //echo sprintf("Array element %d. Lat is %d Long is %d", $i, $lat_arr[$i], $long_arr[$i]);
}

//insert into mysql
insert_into_SQL($lat_arr,$long_arr,$max_array_size);

?> 
