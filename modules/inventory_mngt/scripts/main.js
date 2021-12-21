$(() => {
    load_inventory_list('')
})

function load_inventory_list(key){
    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/components/inventory-list.php",
        data:{
            keyword: key
        },
        dataType: "html",
        success: function (response) {
            $("#inventory-tbody").html(response);

            init_stock_info();
        }
    });
}

function init_add_mat(){
    $("#invt-add").modal('show');
}

function save_material(){
    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/actions/add_material.php",
        data: {
            MaterialCode: $("#frm-matcode").val(),
            Desc: $("#frm-matdesc").val(),
            Price: $("#frm-matprice").val(),
            maxstock: $("#frm-maxstock").val(),
            tax: $("#frm-mattax").val(),
            MaterialCategoryID: $("#frm-matcat").val()
        },
        dataType: "html",
        success: function (response) {
            console.log(response)
            if(response == "success"){
                alert("Successfully Added");

                $("#new-mat-form").trigger('reset');
                load_inventory_list('');
            }
            else alert("Material Code already in the database");
        }
    });
}

function init_add_gr(){
    $("#invt-gr").modal('show');

    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/actions/get_materials.php",
        dataType: "html",
        success: function (response) {
            console.log(response)
            $("#frm-getmatcode").empty();
            if(response != '[]'){
                let data = JSON.parse(response);

                data.forEach(val => {
                    $("#frm-getmatcode").append(`<option value="${val.MaterialID}">${val.MaterialCode}</option>`);
                }); 
                
            }
        }
    });
}

function save_gr(){
    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/actions/add_gr.php",
        data: {
            MaterialID: $("#frm-getmatcode").val(),
            Cost: $("#frm-matcost").val(),
            Quantity: $("#frm-matqty").val(),
            EmployeeID: localStorage.employeeid
        },
        dataType: "html",
        success: function (response) {
            console.log(response)
            if(response == "success"){
                $("#new-gr-form").trigger('reset');

                load_inventory_list('');
            }
            else alert("Error");
        }
    });
}

function init_stock_info(){
    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/components/stocks-info.php",
        dataType: "html",
        success: function (response) {
            $("#stocks-info").html(response);
        }
    });
}

function init_edit_material(MaterialID){
    localStorage.MaterialID = MaterialID;

    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/actions/get_material.php",
        data: {
            MaterialID: MaterialID
        },
        dataType: "html",
        success: function (response) {
            $("#invt-edit").modal('show');

            if(response){
                let data = JSON.parse(response);

                $("#frm-matcode-edit").val(data.MaterialCode)
                $("#frm-matdesc-edit").val(data.MaterialDescription)
                $("#frm-matprice-edit").val(data.price)
                $("#frm-maxstock-edit").val(data.maxstock)
            }
        }
    });
}

function update_material(){
    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/actions/update_material.php",
        data: {
            MaterialID: localStorage.MaterialID,
            MaterialDescription:  $("#frm-matdesc-edit").val(),
            price: $("#frm-matprice-edit").val(),
            maxstock: $("#frm-maxstock-edit").val()

        },
        dataType: "html",
        success: function (response) {
            if(response == "success"){
                alert("Successfully Updated");

                $("#invt-edit").modal('hide');

                load_inventory_list('');
            }

            console.log(response);
        }
    });
}

function init_delete_material(MaterialID){
    let r = confirm("Are you sure to delete this Material? All Accounting Entries will be deleted too");

    if (r == true) {
        delete_material(MaterialID);
    }
}

function delete_material(MaterialID){
    $.ajax({
        type: "POST",
        url: "modules/inventory_mngt/actions/delete_material.php",
        data: {MaterialID: MaterialID},
        dataType: "html",
        success: function (response) {

            console.log(response);
            if(response == "success") load_inventory_list('');
        }
    });
}