<?php
    include 'conn.php';

    //input data management

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
        $firstname = test_input($_POST["first_namde"]);
        $lastname = test_input($_POST["last_name"]);
        $password = test_input(encryptPassword($_POST["password"]));
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function encryptPassword($password){
        $result = sha1($password,false);
        return $result;
    }

    //registering user
    try{
        $sql = "INSERT INTO users (email, first_name, last_name, password)
                    VALUES ('$email', '$firstname', '$lastname', '$password')";
        $conn->exec($sql);
        echo("User registered successfully!"."<br>");
    }
    catch(PDOException $e){
        echo("Couldn't register properly! .<br>. $e->getMessage()");
    }



?>