//#region website
function logout(){
    alert("Logging Out")
}
//#endregion



//#region Dashboard
function load_maindashboard(){
    $(".main_page").load('dashboard/main_dashboard/main_dashboard.php')
}
//#endregion

//#region Modules
function load_inventory(){
    $(".main_page").load('modules/inventory_mngt/inventory_mngt.php')
}

function load_pos(){
    $(".main_page").load('modules/pos/pos.php')
}
//#endregion