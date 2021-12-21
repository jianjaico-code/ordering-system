<?php 
    include_once "../../../connection.php";

    $getRestocks = $conn -> query("SELECT COUNT(*) FROM tblmaterials WHERE (soh/maxstock) * 100 <= 20") -> fetchColumn(0);

?>

<i class="fa <?php if($getRestocks >= 1) echo "fa-close text-danger"; else echo 'fa-check text-success' ?>" aria-hidden="true"></i>
<span class="font-weight-bold ms-1"><?php echo $getRestocks ?> Item/s</span> needs to restock this month