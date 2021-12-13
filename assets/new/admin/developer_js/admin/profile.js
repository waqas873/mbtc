$(document).ready(function(){

$(document).on('submit', '#updateProfileForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "traders/profile/process_update",
        type: "POST",
        dataType: 'json',
        data: obj.serializeArray(),
        success: function (data) {
            if(data.response){
                swal({
                  title: "Success",
                  text: "Your profile has been updated successfully.",
                  icon: "success",
                  button: "Ok",
                });
            }
            else{
                errors(data.errors);
            }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

$(document).on('submit', '#changePasswordForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/profile/process_change_password",
        type: "POST",
        dataType: 'json',
        data: obj.serializeArray(),
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal({
                  title: "Success",
                  text: "Your password has been changed successfully.",
                  icon: "success",
                  button: "Ok",
                });
            }
            else{
                errors(data.errors);
            }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

function errors(arr = ''){
  $.each(arr, function( key, value ) {
    $('.'+key+'_error').html(value);
  });
}

});
