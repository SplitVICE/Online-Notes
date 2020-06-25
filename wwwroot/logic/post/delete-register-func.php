<?php

/* MySQL variables */
$servername = "den1.mysql5.gear.host";
$username = "publicnotesdb";
$password = "Mu11h?wV~k15";
$dbname = "publicnotesdb";

/* Tests connection. If connection fails, error page will be shown */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

/* SQL query. Gets the value inside the url with Get method*/
$sql = "DELETE FROM note WHERE id='$_GET[delete_id]'";

/* Executes the query */
if ($conn->query($sql) === TRUE) {

	/* If success, this php page will go back to index.php 
	showing the main page again which loads the list again */
	$url = "../";
	header('Location: '.$url);
} else {
	echo "Error deleting record. Please go back. Error details: " . $conn->error;
}
$conn->close();
?>