<?php
    $servername = "remotemysql.com";
    $username = "cHS1XD71oA";
    $password = "YtrOfDsT9l";
    
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=cHS1XD71oA;charset=utf8mb4", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        
        }
?>
