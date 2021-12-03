<?php 
include ("connectToDB.inc");



$data = $_POST['data'];

$decodedData = json_decode($data, true);

$player_id = $decodedData['player_id'];
$first_name = $decodedData['first_name'];
$last_name = $decodedData['last_name'];

$database = connectDB();

$query = "INSERT INTO player (PlayerId, FirstName, LastName) VALUES ($player_id, '$first_name', '$last_name')";

$result = mysqli_query($database, $query) or die('Query failed: ' . mysqli_error($database)); 
if ($result) {
    echo  "Success! " . $first_name . " " . $last_name . " added to database.";
}

?>