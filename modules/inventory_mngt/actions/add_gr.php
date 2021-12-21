<?php

    require_once "../../../connection.php";

    $MaterialID = $_POST['MaterialID'];
    $Cost = $_POST['Cost'];
    $Quantity = $_POST['Quantity'];
    $EmployeeID = $_POST['EmployeeID'];
    $AccountingType = 'GR';
    $FinalAmount = ($Quantity * $Cost);
    $today = date('YmdHi');

    try {
        $getCount = $conn -> query("SELECT COUNT(*) FROM fs_inv") -> fetchColumn(0);

        
        $insertGR = $conn -> prepare("INSERT INTO fs_inv (Quantity,Cost,FinalAmount,AccountingType,EmployeeID,MaterialID,ControlNumber) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertGR -> execute([$Quantity, $Cost, $FinalAmount, $AccountingType, $EmployeeID, $MaterialID, ("GR".($today).$getCount+1)]);

        $soh = $conn -> query("SELECT soh FROM tblmaterials WHERE MaterialID = '$MaterialID'") -> fetchColumn();

        $updateSoh = $conn -> prepare("UPDATE tblmaterials SET soh = ? WHERE MaterialID = ?");
        $updateSoh -> execute([($soh + $Quantity), $MaterialID]);

        echo "success";
    } catch (PDOException $th) {
        echo $th;
    }