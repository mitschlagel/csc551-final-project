<?php 
include ("connectToDB.inc");

$data = $_POST['data'];

$stats = json_decode($data, true);

$player_id = $stats['player_id'];
$first_name = $stats['first_name'];
$last_name = $stats['last_name'];
$appearances = $stats['appearances'];
$minutes = $stats['minutes'];
$goals = $stats['goals'];
$assists = $stats['assists'];
$user = $stats['userName'];


$database = connectDB();

$exists = mysqli_query($database, "SELECT * FROM player WHERE PlayerId = '$player_id'");


if (mysqli_num_rows($exists) > 0) {
    echo "Player already in player table.";
    
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