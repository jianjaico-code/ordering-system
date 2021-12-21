<?php 
    require_once "../../connection.php";

    $getCategories = $conn -> query("SELECT * FROM tblmaterials_category") -> fetchAll();
?>

<!-- The Modal -->
<form id="new-mat-form" class="text-start">
<div class="modal fade" id="invt-add">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Material</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div class="input-group input-group-outline my-3">
                        <label class="pr-4">Menu Code</label>&nbsp;
                        <input type="text" required id="frm-matcode" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label class="pr-4">Description</label>&nbsp;
                        <input type="text" id="frm-matdesc"  required class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="pr-4">Price</label>&nbsp;
                                <input type="number" min="0.1" step="any" id="frm-matprice"  required class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="pr-4">Tax</label>&nbsp;
                                <input type="number" min="0.1" step="any" id="frm-mattax"  required class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="pr-4">Max Stocks</label>&nbsp;
                                <input type="number" min="0.1" step="any" id="frm-maxstock"  required class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="pr-4">Category</label>&nbsp;
                                <select id="frm-matcat" class="form-control">
                                    <?php foreach($getCategories as $category): ?>
                                        <option value="<?php echo $category['MaterialCategoryID'] ?>"><?php echo $category['Description'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">Add Material</button>
                <button type="button" class="btn btn-danger" onclick="$('#invt-add').modal('hide')">Close</button>
            </div>

        </div>
    </div>
</div>
</form>

<!-- The Modal -->
<form id="edit-mat-form" class="text-start">
<div class="modal fade" id="invt-edit">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Material</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                    <div class="input-group input-group-outline my-3">
                        <label class="pr-4">Material Code</label>&nbsp;
                        <input type="text" required id="frm-matcode-edit" disabled class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <label class="pr-4">Description</label>&nbsp;
                        <input type="text" id="frm-matdesc-edit"  required class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="pr-4">Price</label>&nbsp;
                                <input type="number" min="0.1" step="any" id="frm-matprice-edit"  required class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline mb-3">
                                <label class="pr-4">Max Stocks</label>&nbsp;
                                <input type="number" min="0.1" step="any" id="frm-maxstock-edit"  required class="form-control">
                            </div>
                        </div>
                    </div>
                    
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">Update Material</button>
                <button type="button" class="btn btn-danger" onclick="$('#invt-edit').modal('hide')">Close</button>
            </div>

        </div>
    </div>
</div>
</form>

<!-- The Modal -->
<form id="new-gr-form" class="text-start">
<div class="modal fade" id="invt-gr">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Goods Receive</h4>

            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="input-group input-group-outline my-3">
                    <label class="pr-4">Material Code</label>&nbsp;
                    <select required id="frm-getmatcode" class="form-control">
                        
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="pr-4">Cost</label>&nbsp;
                            <input type="number" step="any" min="0.1" id="frm-matcost"  required class="form-control">
                        </div>
                    </div>  
                    <div class="col-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="pr-4">Quantity</label>&nbsp;
                            <input type="number" step="any" min="0.1" id="frm-matqty"  required class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="submit" class="btn bg-gradient-primary">Add GR</button>
                <button type="button" class="btn btn-danger" onclick="$('#invt-gr').modal('hide')">Close</button>
            </div>

        </div>
    </div>
</div>
</form>

<script>
    $("#new-mat-form").submit((e) => {
        e.preventDefault();
    
        save_material();
    });

    $("#new-gr-form").submit((e) => {
        e.preventDefault();
        
        var r = confirm("Are you sure to add this?");
        if (r == true) {
            save_gr();
        }
        
    });

    $("#edit-mat-form").submit((e) => {
        e.preventDefault();
        
        update_material();
    })
</script>