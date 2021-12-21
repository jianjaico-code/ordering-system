<?php

    require_once "../../../connection.php";

    $code = $_POST['code'];

    try {
        
        $checkCode = $conn -> query("SELECT *,'success' as response FROM tblmaterials_cuopon WHERE CuoponCode = '$code' LIMIT 1") -> fetch();

        if($checkCode){
            echo json_encode($checkCode);
        }
        else
            echo json_encode('false');
        

    } catch (Exception $th) {
        echo $th;
    }