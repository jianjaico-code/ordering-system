<?php 

    require_once "../../../connection.php";

    $MaterialID = $_POST['MaterialID'];

    $deleteMatID = $conn -> query("DELETE FROM fs_inv WHERE MaterialID = '$MaterialID'");
    $deleteMatID = $conn -> query("DELETE FROM tblmaterials WHERE MaterialID = '$MaterialID'");

    echo "success";