<?php

function connectDB(){
	$dbConnection = mysqli_connect("127.0.0.1","root","mYsQ1066!", "didtheyplay", "8889");
	if (mysqli_connect_errno()){
		die(mysqli_connect_error());
	}
	return $dbConnection;
}


?>
