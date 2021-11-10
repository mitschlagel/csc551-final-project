<?php

function connectDB(){
	$dbConnection = mysqli_connect("sql311.epizy.com","epiz_30333032","T4Cxlhqv7skxB", "epiz_30333032_soccer");
	if (mysqli_connect_errno()){
		die(mysqli_connect_error());
	}
	return $dbConnection;
}


?>