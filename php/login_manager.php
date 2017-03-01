<?php

	include 'conn.php';

    //input data management

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test_input($_POST["email"]);
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

    //logging user
    try{
        $sql = "SELECT password FROM user WHERE email = '$email'";
        $qResult = $conn->query($sql);
        if($qResult->fetchColumn() == $password){
            //starting the session
            session_start();
            $sql_firstname = $conn->query("SELECT first_name FROM users WHERE email = '$email'");
            $sql_lastname =  $conn->query("SELECT last_name FROM users WHERE email = '$email'");
            $fn = $sql_firstname->fetchColumn();
            $ln = $sql_lastname->fetchColumn();

            echo("<br>"."Welcome back ".$fn." ".$ln."!"."<br>");

            //initialize sessions variables
            $_SESSION["email"] = $email;
            $_SESSION["firstname"] = $fn;
            $_SESSION["lastname"] =  $ln;

            echo("Welcome back".$_SESSION["firstname"]." ".$_SESSION["lastname"]);

            echo("<br>");

        }
        else{
            echo("<br>"."Wrong email or password! Try again!");
        }
    }
    catch(PDOException $e){
        echo("Wrong password or email <br>". $e->getMessage());
    }

?>