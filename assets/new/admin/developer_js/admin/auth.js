$(document).ready(function(){

var getCookie = function(name) {
  var match = document.cookie.match(new RegExp('(^|; )' + name + '=([^;]+)'));
  return match ? match[2] : null;
}

$(document).on('submit', '#signupForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    var formData = obj.serializeArray();
    var aff_id = getCookie('aff_id');
    formData.push({'name':'aff_id','value':aff_id});
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/auth/process_signup",
        type: "POST",
        dataType: 'json',
        data: formData,
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal({
                  title: "Success",
                  text: '"Please check your email to confirm" You can login into your VIP members area from the link we have sent you. Thank you and see you on the other side!',
                  icon: "success",
                  button: "Ok",
                });
            } 
            else{
                if(data.subscribe){
                  swal("You will be redirected after PayPal to make your unique login via Sign up.", {
                    icon:'warning',
                    buttons: {
                      catch: {
                        text: "Click here to subscribe",
                        value: "subscription",
                      }
                    },
                  })
                  .then((value) => {
                    switch (value) {

                      case "subscription":
                        var url = base_url+'orders/subscribe';
                        window.location.replace(url);
                        break;

                      default:
                    }
                  });
                }
                else{
                  errors(data.errors);
                }
            }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

$(document).on('submit', '#loginForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/auth/process_login",
        type: "POST",
        dataType: 'json',
        data: obj.serializeArray(),
        success: function (data) {
            if(data.response){
                window.location.href = base_url + "admin/dashboard";
            }
            else{
                if(data.blocked){
                    swal({
                      title: "Warning",
                      text: "You account has been blocked.Please contact support.",
                      icon: "error",
                      button: "Ok",
                    });
                }
                else if(data.credentials){
                    swal({
                      title: "Warning",
                      text: "Please enter valid credentials for login.",
                      icon: "error",
                      button: "Ok",
                    });
                }
                else if(data.activateAccount){
                    swal({
                      title: "Warning",
                      text: "Please check your email or spam folder to activate your account.",
                      icon: "warning",
                      button: "Ok",
                    });
                }
                else{
                  errors(data.errors);
                }
            }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

$(document).on('submit', '#forgotPasswordForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/auth/forgot_password_link",
        type: "POST",
        dataType: 'json',
        data: obj.serializeArray(),
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal({
                  title: "Success",
                  text: "An email sent to your email id please follow the link given in email to reset password within 50 minutes.",
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

$(document).on('submit', '#resetPasswordForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/auth/process_reset_password",
        type: "POST",
        dataType: 'json',
        data: obj.serializeArray(),
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal("Password has been set successfully.")
                .then((value) => {
                  var redirect = base_url + "admin/auth/login";
                  window.location.replace(redirect); 
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
  return false;
}

});
