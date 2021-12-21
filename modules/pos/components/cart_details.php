
<?php
    require_once "../../../connection.php";

    $InvoiceNumber = $_POST['InvoiceNumber'];

    $getAllCart = $conn -> query("SELECT (SELECT SUM(FinalAmount) FROM tblcart WHERE InvoiceNumber = a.InvoiceNumber) as FinalAmountz, a.*, b.MaterialDescription, b.MaterialCode FROM tblcart a INNER JOIN tblmaterials b ON a.MaterialID = b.MaterialID WHERE InvoiceNumber = '$InvoiceNumber'") -> fetchAll();
?>


<div class="card-header pb-0">
    <div class="row">
        <div class="col-6">
            <h6>INVOICE NO.</h6>
        </div>

        <div class="col-6">
        <small class="float-right">#<?php echo $InvoiceNumber; ?></small>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div style="margin-left: 2%;" class="input-group input-group-outline w-100 mb-3">
                    <input type="text" step="any" min="0.1" id="add-amount" placeholder="Amount" class="form-control">
            </div>
        </div>

        <div class="col-6">
            <button onclick="init_pay(<?php echo (COUNT($getAllCart) > 0) ? $getAllCart[0]['FinalAmountz'] : 0 ?>)" class="btn bg-gradient-primary w-100">Pay</button>
        </div>
    </div>

    <div style="margin-left: 2%;" class="input-group input-group-outline w-100 mb-3">
            <input type="hidden" step="any" min="0.1" id="add-remarks" placeholder="Remarks" class="form-control">
            <input type="text" id="add-cuopon" placeholder="Cuopon Code" class="form-control">
    </div>

    <p class="text-sm">
        <i class="fa fa-money text-success" aria-hidden="true"></i>
        <span class="font-weight-bold" id="cuopon-label"><?php echo number_format((COUNT($getAllCart) > 0) ? $getAllCart[0]['FinalAmountz'] : 0, 2) ?></span> to pay
    </p>
    <p class="text-sm">
        <div class="row">
            <div class="col-8">
                <div style="margin-left: 2%;" class="input-group input-group-outline w-100 mb-3">
                        <input type="text" step="any" min="0.1" id="add-mat" placeholder="Add Inventory" class="form-control">
                </div>
            </div>

            <div class="col-4">
                <div style="margin-left: 2%;" class="input-group input-group-outline w-100 mb-3">
                        <input type="number" value="1" step="any" min="0.1" id="add-mat-qty" placeholder="Qty" class="form-control">
                </div>
            </div>
        </div>
    </p>
</div>
<div class="card-body p-3">
    <div class="timeline timeline-one-side">

        <?php foreach($getAllCart as $cart): ?>
        <div class="timeline-block mb-3">
            <span style="cursor: pointer;" class="timeline-step">
                <i onclick="init_remove_cart(<?php echo $cart['TempCartID'] ?>)" class="material-icons text-danger text-gradient">remove_shopping_cart</i>
            </span>

            <div class="timeline-content">
                <h6 class="text-dark text-sm font-weight-bold mb-0"> <?php echo $cart['MaterialDescription'] ?>
                </h6>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?php echo $cart['MaterialCode'] ?></p>
                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">(<?php echo number_format($cart['Price'], 2) ?>) x <?php echo number_format($cart['Quantity']) ?></p>
            </div>
        </div>      
        <?php endforeach ?>  
    </div>
</div>

<script>
$("#add-mat").on("keydown",function search(e) {

    let qty = parseFloat($("#add-mat-qty").val());

    if(e.keyCode == 13) {
        if(qty >= 1){
            $.ajax({
                type: "POST",
                url: "modules/pos/actions/check_material.php",
                data: {
                    MaterialCode: $("#add-mat").val()
                },
                dataType: "html",
                success: function (response) {
                    let data = JSON.parse(response);
                    if(!data) alert("No Inventory Found!");
                    else{
                        add_to_cart(data.MaterialID, parseFloat(data.price), qty, parseFloat(data.tax));
                    }
                }
            });
        }
        else alert("Quantity must be greater than 1");
    }
});

$("#add-mat-qty").on("keydown", function search(e) {
    let MaterialCode = $("#add-mat").val();
    let qty = parseFloat($("#add-mat-qty").val());

    if(e.keyCode == 13){
        if(qty >= 1){
            $.ajax({
                type: "POST",
                url: "modules/pos/actions/check_material.php",
                data: {
                    MaterialCode: $("#add-mat").val()
                },
                dataType: "html",
                success: function (response) {
                    let data = JSON.parse(response);
                    if(!data) alert("No Inventory Foundss!");
                    else{
                        add_to_cart(data.MaterialID, parseFloat(data.price), qty, parseFloat(data.tax));
                    }
                }
            });
        }
        else alert("Quantity must be greater than 1");
    }
});

$("#add-cuopon").on("keydown", function search(e) {
    let total = parseFloat('<?php echo number_format((COUNT($getAllCart) > 0) ? $getAllCart[0]['FinalAmountz'] : 0, 2) ?>');

    if(e.keyCode == 13){
        $.ajax({
            type: "POST",
            url: "modules/pos/actions/check_cuopon.php",
            data: {
                code: $("#add-cuopon").val()
            },
            dataType: "html",
            success: function (response) {
                console.log(response)
                let data = JSON.parse(response);

                if(data.response == "success"){
                    let dicountPrice = total * parseFloat(data.Discount);
                    DiscountTotal = dicountPrice;

                    $("#cuopon-label").html(`${total - dicountPrice} with ${parseFloat(data.Discount) * 100}% Discount`)
                    
                    console.log(total - dicountPrice)
                }
                else alert("Cuopon Code is not valid!")
            }
        });
    }
});
</script>
        