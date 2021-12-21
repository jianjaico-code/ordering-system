<?php

    require_once "../../../connection.php";

    $MaterialID = $_POST['MaterialID'];
    $MaterialDescription = $_POST['MaterialDescription'];
    $price = $_POST['price'];
    $maxstock = $_POST['maxstock'];

    try {
        $updateMaterial = $conn -> prepare("UPDATE tblmaterials SET MaterialDescription = ?, price = ?, maxstock = ? WHERE MaterialID = ?");
        $updateMaterial -> execute([$MaterialDescription, $price, $maxstock, $MaterialID]);

        echo "success";
    } catch (PDOException $th) {
        echo $th;
    }