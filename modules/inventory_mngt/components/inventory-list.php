<?php 
    require_once "../../../connection.php";
    $keyword = $_POST['keyword'];

    $getAllInventory = $conn -> query("SELECT * FROM tblmaterials a INNER JOIN tblmaterials_category b ON a.MaterialCategoryID = b.MaterialCategoryID WHERE MaterialCode LIKE '%$keyword%' ORDER BY  (soh/maxstock) * 100 <= 20 DESC") -> fetchAll();
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
        <span class="text-xs font-weight-bold"> <?php echo number_format($invt['price'] + $invt['tax'], 2) ?></span>
    </td>
    <td class="align-middle text-center text-sm">
        <span class="text-xs font-weight-bold"> <?php echo $invt['Description'] ?></span>
    </td>
    <td class="align-middle">
        <?php
            $percentage = ($invt['soh']/$invt['maxstock']) * 100;

            if($percentage >= 100) $percentage = 100;
        ?>
        <div class="progress-wrapper w-50 mx-auto">
            <div class="progress-info">
                <div class="progress-percentage">
                    <span class="text-xs font-weight-bold"><?php echo number_format($percentage) ?>%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar <?php if(number_format($percentage) >= 100) echo 'bg-gradient-success'; else if(number_format($percentage) < 100 && number_format($percentage) > 20) echo 'bg-gradient-info'; else if(number_format($percentage) <= 20) echo 'bg-gradient-danger';?> w-<?php echo number_format($percentage/10) * 10 ?>"
                    role="progressbar" aria-valuenow="<?php echo number_format($percentage) ?>" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
        </div>
    </td>
    <td class="text-center">
        <span class="text-xs font-weight-bold"> <?php echo number_format($invt['soh']) ?></span>
    </td>
    <td>
        <a class="cursor-pointer" onclick="init_edit_material(<?php echo $invt['MaterialID'] ?>)">
            <i class="fa fa-edit text-info"></i>
        </a>
        <a class="cursor-pointer" onclick="init_delete_material(<?php echo $invt['MaterialID'] ?>)">
            <i class="fa fa-trash text-danger"></i>
        </a>
    </td>
</tr>
<?php endforeach ?>