<?php
    $host = "feenix-mariadb.swin.edu.au";
    $username = "s104181721";
    $pwd = "Bo0147";
    $sql_db = "s104181721_db";

    // Create a database connection
    $conn = @mysqli_connect($host, $username, $pwd, $sql_db);

    // Check the connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Sanitizing data
    function sanitize_input($data)
    {
        // remove leading and trailing spaces
        $data = trim($data);
        // remove backslashes
        $data = stripcslashes($data);
        // remove HTML control characters
        $data = htmlspecialchars($data);
        return $data;
    }
?>