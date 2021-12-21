<?php

    include_once "../../../connection.php";

    $MaterialID = $_POST['MaterialID'];

    $getMaterial = $conn -> query("SELECT * FROM tblmaterials WHERE MaterialID = '$MaterialID'") -> fetch();

    echo json_encode($getMaterial);