# PHP-LatLong
Latitude and Longtitude distance calculation using PHP and MySql

arrays.php
Fills a table with random latitudes and longtitudes (within some specs) 

calculate.php
Gets all the points to array, and measures the distance from a center point. 
If the distance is less than X meters, echo the coordinates and calculate how many points were found.

Results:
issues after 200k lines of select, limit select output to avoid
