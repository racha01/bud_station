$(function() {
    $('#my-data-table').DataTable();
});
function editMember(event){
    let member = event.currentTarget.name;
    console.log(member);
    var obj = JSON.parse(member);
    $("#editMemberID").val(obj.id);
    $("#editIDMember").val(obj.id_member);
    $("#editFirstName").val(obj.first_name);
    $("#editLastName").val(obj.last_name);
    $("#editStatus").val(obj.status);
}

$(document).on(
    "click",
    "#editBt, #deleteBt",
    (event) => {
        let id = event.currentTarget.id;
        switch (id) {
            case "editBt":
                editMember(event);
                break;
            case "deleteBt":
                deleteMember(event);
                break;
            default:
                console.log("no any events click");
        }
    }
);