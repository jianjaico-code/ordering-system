<?php 

require_once "../../connection.php";

    $today = date('YmdHi');
    $getCount = $conn -> query("SELECT COUNT(*) FROM fs_inv") -> fetchColumn(0);

    $invoiceNumber =  ("INV".($today).$getCount+1);
?>

<style>
/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
/* ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
} */

/* Handle */
::-webkit-scrollbar-thumb {
    background: #aaa;
    border-radius: 10px;
}

.thheader{
    position:sticky;
    top: 0 ;
}
</style>

<div class="row mb-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Inventory</h6>
                        <p class="text-sm mb-0">

                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div style="margin-left: 2%;" class="input-group input-group-outline w-30 mb-3">
                    <input type="text" step="any" min="0.1" id="srch-mat" placeholder="Search Inventory" class="form-control">
                </div>
                <div class="table-responsive " style="height: 335px;">
                    <table id="invt-table" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Material Code</th>
                                <th
                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Material Description</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Price</th>

                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Tax</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Gross Price</th>
                                <th>

                                </th>
                                
                            </tr>
                        </thead>
                        <tbody id="inventory-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100" id="carting-item">

        </div>
    </div>
</div>

<script src="modules/pos/scripts/main.js"></script>
<script>
$(() => {
    localStorage.InvoiceNumber = '<?php echo $invoiceNumber ?>';
})

$("#srch-mat").on("keydown",function search(e) {
    if(e.keyCode == 13) {
        load_inventory_list($("#srch-mat").val())
    }
});
</script>