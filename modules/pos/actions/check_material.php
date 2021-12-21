<?php

    require_once "../../../connection.php";

    try {
        
        $checkMaterial = $conn -> prepare("SELECT * FROM tblmaterials WHERE MaterialCode = ? AND soh > 0");
        $checkMaterial -> execute([$_POST['MaterialCode']]);

        echo json_encode($checkMaterial -> fetch());

    } catch (Exception $th) {
        echo $th;
    }