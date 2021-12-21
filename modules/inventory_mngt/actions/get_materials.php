<?php   

    require_once "../../../connection.php";

    $getAllMat = $conn -> query("SELECT * FROM tblmaterials") -> fetchAll();

    echo json_encode($getAllMat);