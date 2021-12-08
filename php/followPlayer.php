<?php 
include ("connectToDB.inc");

// This is the json string coming from savePlayer.js
$data = $_POST['data'];

/* json_decode() takes a json string and turns it into an associative array -- the true parameter is what makes the return 
value an associative array. If false it would return an object. */
$stats = json_decode($data, true);

// Here we are pulling each of the values out of our array.
$player_id = $stats['player_id'];
$first_name = $stats['first_name'];
$last_name = $stats['last_name'];
$appearances = $stats['appearances'];
$minutes = $stats['minutes'];
$goals = $stats['goals'];
$assists = $stats['assists'];
$user = $stats['userName'];

// Connect to the mysql database.
$database = connectDB();

// Query to see if the player is already being followed.
$exists = mysqli_query($database, "SELECT * FROM player WHERE PlayerId = '$player_id'");

// If player already being followed, a messaged is display in the console.
if (mysqli_num_rows($exists) > 0) {
    echo "Player already in player table.";

// Otherwise, add the player to player table and then add the stats to the follow table
} else {

    $addPlayer = "INSERT INTO player (PlayerId, FirstName, LastName) VALUES ('$player_id', '$first_name', '$last_name')";
    $addPlayerResult = mysqli_query($database, $addPlayer) or die('Failed to add player: ' . mysqli_error($database)); 
    
    if ($addPlayerResult) {
        echo  "Success! " . $first_name . " " . $last_name . " added to database.";
    }
    
}

$updateStats = "INSERT INTO follow (Username, PlayerId, Appearances, Minutes, Goals, Assists)
                VALUES ('$user', '$player_id', '$appearances', '$minutes', '$goals', '$assists')"; 

$updateStatsResult = mysqli_query($database, $updateStats) or die('Failed to update stats: '  . mysqli_error($database));
if ($addPlayerResult) {
    echo  "Success! " . $first_name . " " . $last_name . " stats have been updated.";
    
}
mysqli_close($database);


?>