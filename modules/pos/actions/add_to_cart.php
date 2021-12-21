<?php

    require_once "../../../connection.php";

    $InvoiceNumber = $_POST['InvoiceNumber'];
    $MaterialID = $_POST['MaterialID'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];
    $tax = $_POST['tax'];

    try {

        $checkInvoiceMat = $conn -> query("SELECT * FROM tblcart WHERE InvoiceNumber = '$InvoiceNumber' AND MaterialID = '$MaterialID'") -> fetch();

        if(!$checkInvoiceMat){
            $insertToCart = $conn -> prepare("INSERT INTO tblcart (InvoiceNumber, MaterialID, Quantity, Price, FinalAmount) VALUES (?, ?, ?, ?, ?)");
            $insertToCart -> execute([$InvoiceNumber, $MaterialID, $Quantity, ($Price + $tax), (($Price + $tax) * $Quantity)]);

            echo "success";
        }
        else{
            $updateCart = $conn -> prepare("UPDATE tblcart SET Quantity = ?, FinalAmount = ? WHERE InvoiceNumber = ? AND MaterialID = ?");
            $updateCart -> execute([($checkInvoiceMat['Quantity'] + $Quantity), (($checkInvoiceMat['Quantity'] + $Quantity) * ($Price + $tax)), $InvoiceNumber, $MaterialID]);

            echo "success";
        }

    } catch (Exception $th) {
        echo $th;
    }