<?php

    //database connection
    $servername = "sql11.freemysqlhosting.net";
    $dbname = "sql11161240";
    $username = "sql11161240";
    $dbpassword = "R3N3nRNGXS";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo("connection successful");
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

?>