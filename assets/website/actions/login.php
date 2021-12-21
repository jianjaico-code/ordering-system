<?php
    session_start();

    require_once "../../../connection.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $getUser = $conn -> prepare("SELECT * FROM tbluseraccount WHERE UserName = ? AND `Password` = ?");
        $getUser -> execute([$username, $password]);
        $getUser = $getUser -> fetch();

        if($getUser){
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["valid"] = true;

            
            
            echo $getUser['EmployeeID'];
        }
        else echo 'error';

    } catch (PDOException $th) {
        echo $th;
    }