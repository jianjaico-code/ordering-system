<?php

    require_once "../../../connection.php";

    $InvoiceNumber = $_POST['InvoiceNumber'];
    $AmountPaid = $_POST['AmountPaid'];
    $Remarks = $_POST['Remarks'];
    $AmountChange = $_POST['AmountChange'];
    $EmployeeID = $_POST['EmployeeID'];
    $DiscountTotal = $_POST['DiscountTotal'];

    $today = date('YmdHis');
    $getCount = $conn -> query("SELECT COUNT(*) FROM fs_inv") -> fetchColumn(0);

    $ORNumber =  ("OR".($today));

    try {

        $checkCart = $conn -> query("SELECT * FROM tblcart WHERE InvoiceNumber = '$InvoiceNumber'") -> fetchAll();
        
        if(count($checkCart) >= 1){
            $insertSummary = $conn -> prepare("INSERT INTO _tblpos_summary (ORNumber,EmployeeID,InvoiceNumber,AmountPaid,AmountChange,Remarks) VALUES (?,?,?,?,?,?)");
            $insertSummary -> execute([$ORNumber, $EmployeeID, $InvoiceNumber, $AmountPaid, $AmountChange, $Remarks]);

            foreach($checkCart as $cart){
                $insertDetail = $conn -> prepare("INSERT INTO _tblpos_detail (ORNumber, MaterialID, Price, Quantity, FinalAmount) VALUES (?, ?, ?, ?, ?)");
                $insertDetail -> execute([$ORNumber, $cart['MaterialID'], $cart['Price'], $cart['Quantity'], $cart['FinalAmount']]);
                

                $insertFS = $conn -> prepare("INSERT INTO fs_inv (ControlNumber, MaterialID, Cost, Quantity, FinalAmount, AccountingType, EmployeeID) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $insertFS -> execute([$InvoiceNumber, $cart['MaterialID'], $cart['Price'], $cart['Quantity'], $cart['FinalAmount'], 'INV', $EmployeeID]);

                $MaterialID = $cart['MaterialID'];

                $soh = $conn -> query("SELECT soh FROM tblmaterials WHERE MaterialID = '$MaterialID'") -> fetchColumn();

                $updateSoh = $conn -> prepare("UPDATE tblmaterials SET soh = ? WHERE MaterialID = ?");
                $updateSoh -> execute([($soh - $cart['Quantity']), $MaterialID]);
            }

            $deleteCart = $conn -> query("DELETE FROM tblcart WHERE InvoiceNumber = '$InvoiceNumber'");

            echo $ORNumber;
        }

    } catch (Exception $th) {
        echo $th;
    }