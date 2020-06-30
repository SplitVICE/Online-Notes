<?php

// Creates the SQL Connection by creating a variable called "conn"
// Variables are created by reading the MySQL credentials.
// Data for the variables are stored in the .env variable.
// .env variable can be find (and must be placed) at the project's root.
// .env.template contains all the environment variables the project needs to work.
function create_connection_and_return_conn_variable()
{   
    // Creates mysqli variable called con with data stored at environment variables.
    $conn = new mysqli(
        $_ENV['database_server_name'],
        $_ENV['database_username'],
        $_ENV['database_password'],
        $_ENV['database_name']
    );

    // If connection fails, returns true. Otherwise returns mysqli connection variable.
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
        return null;
    }else{
        return $conn;
    }
}
