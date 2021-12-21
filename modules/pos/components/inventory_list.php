<?php 
    require_once "../../../connection.php";
    $keyword = $_POST['keyword'];
    $InvoiceNumber = $_POST['InvoiceNumber'];

    $getAllInventory = $conn -> query("SELECT * FROM tblmaterials WHERE MaterialCode LIKE '%$keyword%' AND  soh > 0 ORDER BY  (soh/maxstock) * 100 <= 20 DESC") -> fetchAll();
?>


<?php foreach($getAllInventory as $invt): ?>
<tr>
    <td>
        <div class="d-flex px-3 py-1">
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm"><?php echo $invt['MaterialCode'] ?></php></h6>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex py-1">
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm"><?php echo $invt['MaterialDescription'] ?></php></h6>
            </div>
        </div>
    </td>
    <td class="align-middle text-center text-sm">
        <span class="text-xs font-weight-bold"> <?php echo number_format($invt['price'], 2) ?></span>
    </td>
    <td class="align-middle text-center text-sm">
        <span class="text-xs font-weight-bold"> <?php echo number_format($invt['tax'], 2) ?></span>
    </td>
    <td class="align-middle text-center text-sm">
        <span class="text-xs font-weight-bold"> <?php echo number_format($invt['price'] + $invt['tax'], 2) ?></span>
    </td>
    <td>
        <a class="cursor-pointer" onclick="add_to_cart(<?php echo $invt['MaterialID'] ?>, <?php echo $invt['price'] ?>, 1, <?php echo $invt['tax'] ?>)">
            <i class="fa fa-plus text-info"></i>
        </a>
    </td>
</tr>
<?php endforeach ?>