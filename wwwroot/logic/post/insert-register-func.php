<?php
    /* MySql variables */
    $servername = "den1.mysql5.gear.host";
    $username = "publicnotesdb";
    $password = "Mu11h?wV~k15";
    $dbname = "publicnotesdb";

    /* Loads the info inside the url with get method */
    $info = $_GET["info_to_save"];

    /* Tests connection. If connection fails, error page will be shown */
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    /* Creates the sql query */
    $sql = "INSERT INTO note (note_content)
    VALUES ('$info')";

    /* Executes the sql query */
    if ($conn->query($sql) === TRUE) {

        /* If success, this php page will go back to index.php 
	    showing the main page again which loads the list again */
        $url = "../";
        header('Location: '.$url);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>