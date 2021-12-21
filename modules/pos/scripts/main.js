var DiscountTotal = 0;

$(() => {
    load_inventory_list('');
})

function load_inventory_list(key){
    $.ajax({
        type: "POST",
        url: "modules/pos/components/inventory_list.php",
        data: {
            keyword: key,
            InvoiceNumber: localStorage.InvoiceNumber
        },
        dataType: "html",
        success: function (response) {
            $("#inventory-tbody").html(response);
            DiscountTotal = 0;
            load_cart();
        }
    });
}

function load_cart(){
    $.ajax({
        type: "POST",
        url: "modules/pos/components/cart_details.php",
        data: {
            InvoiceNumber: localStorage.InvoiceNumber
        },
        dataType: "html",
        success: function (response) {
            $("#carting-item").html(response);
        }
    });
}

function add_to_cart(MaterialID, Price, Quantity, tax){
    $.ajax({
        type: "POST",
        url: "modules/pos/actions/add_to_cart.php",
        data: {
            InvoiceNumber: localStorage.InvoiceNumber,
            MaterialID: MaterialID,
            Price: Price,
            Quantity: Quantity,
            tax: tax
        },
        dataType: "html",
        success: function (response) {
            if(response == "success"){
                load_cart();
            }
            console.log(response);
        }
    });
}

function init_remove_cart(TempCartID){
    let confirmle = confirm("Are you sure to remove this item?");

    if(confirmle){
        $.ajax({
            type: "POST",
            url: "modules/pos/actions/remove_from_cart.php",
            data: {
                TempCartID: TempCartID
            },
            dataType: "html",
            success: function (response) {
                if(response == "success"){
                    load_cart();
                }

                console.log(response);
            }
        });
    }
}

function init_pay(total){

    let amountPay = parseFloat($("#add-amount").val());

    if(amountPay < (total - DiscountTotal)){
        alert("Input amount must be GREATER than total!");

        return false;
    }

    let amountChange = (amountPay - (total - DiscountTotal));

    let confirmle = confirm("Are you sure to COMPLETE this transaction?");
    if(confirmle){
        $.ajax({
            type: "POST",
            url: "modules/pos/actions/pay.php",
            data: {
                InvoiceNumber: localStorage.InvoiceNumber,
                AmountPaid: amountPay,
                Remarks: $("#add-remarks").val(),
                AmountChange: amountChange,
                EmployeeID: localStorage.employeeid,
                DiscountTotal: DiscountTotal
            },
            dataType: "html",
            success: function (response) {

                alert(`YOUR CHANGE IS: ${amountChange.toFixed(2)} WITH THE OR NUMBER - ${response}`);

                load_pos();
                
            }
        });
    }
}