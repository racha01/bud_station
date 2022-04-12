$(function() {
    $('#my-data-table').DataTable();
});
function editMenu(event){
    let menu = event.currentTarget.name;
    console.log(menu);
    var obj = JSON.parse(menu);
    $("#editMenuID").val(obj.id);
    $("#editMenuCode").val(obj.menu_code);
    $("#editMenuName").val(obj.food_menu);
    $("#editPreice").val(obj.price);
    $("#editFoodType").val(obj.food_type);
    $("#editStatus").val(obj.status);
}

function deleteMenu(event) {
    let lot = event.currentTarget.name;
    console.log(lot);
    var obj = JSON.parse(lot);
    $("#deleteMenuID").val(obj.id);
    $("#deleteMenuCode").val(obj.menu_code);
}

$(document).on(
    "click",
    "#editBt, #deleteBt",
    (event) => {
        let id = event.currentTarget.id;
        switch (id) {
            case "editBt":
                editMenu(event);
                break;
            case "deleteBt":
                deleteMenu(event);
                break;
            default:
                console.log("no any events click");
        }
    }
);