//DELETE BUTTON CODE
$(document).on("click", "button.btn-delete", function (e) {
    var element = $(this);
    var url = element.data('url');
    var formType = element.data('form');
    var idForm = $(this).data('id-form');

    if(element.data('msg') == null){
        var msg = "Are you sure you want to delete?<br />You cannot undo this action.";
    }else{
        var msg = element.data('msg');
    }
    bootbox.confirm(msg, function (result){
        if (result == true) {
            if(formType == true) {
                $('form#'+idForm).attr('action', url);
                $('form#'+idForm).submit();
            } else {
                window.location = url;
            }
        }
    });
});
//BACK BUTTON CODE
$(document).on("click", "button.btn-back", function (e) {
    var element = $(this);
    var url = element.data('url');

    window.location = url;
});