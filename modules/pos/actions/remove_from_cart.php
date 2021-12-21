<?php

    require_once "../../../connection.php";

    try {
        $removeCart = $conn -> prepare("DELETE FROM tblcart WHERE TempCartID = ?");
        $removeCart -> execute([$_POST['TempCartID']]);

        echo "success";
    } catch (Exception $th) {
        echo $th;
    }