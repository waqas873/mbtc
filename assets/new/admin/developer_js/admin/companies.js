$(document).ready(function(){

$(document).on('click', '#addButton', function (e) {
    e.preventDefault();
    $('.all_errors').empty();
    //$('#addForm').trigger("reset");
    $('#addModal').modal("show");
});

$(document).on('submit', '#addGuardFeedbackForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    var form_data = new FormData(this);
    $.ajax({
        url: base_url + "admin/companies/addGuardFeedbackForm",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal("Data has been saved successfully.")
                .then((value) => {
                  location.reload(); 
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

$(document).on('submit', '#addDoorSupervisorForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    var form_data = new FormData(this);
    $.ajax({
        url: base_url + "admin/companies/addDoorSupervisorForm",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal("Data has been saved successfully.")
                .then((value) => {
                  location.reload(); 
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

$(document).on('submit', '#addFormSite', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    var form_data = new FormData(this);
    $.ajax({
        url: base_url + "admin/companies/addFormSite",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal("Data has been saved successfully.")
                .then((value) => {
                  location.reload(); 
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

$(document).on('submit', '#addFormVenue', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    var form_data = new FormData(this);
    $.ajax({
        url: base_url + "admin/companies/addFormVenue",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal("Data has been saved successfully.")
                .then((value) => {
                  location.reload(); 
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

$(document).on('submit', '#addGeneralDetailForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    var form_data = new FormData(this);
    $.ajax({
        url: base_url + "admin/companies/addGeneralDetailForm",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                obj.trigger("reset");
                swal("Data has been saved successfully.")
                .then((value) => {
                  location.reload(); 
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

$(document).on('click', '.update_id', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var id = $(this).attr("rel");
    if(id==''){
      return false;
    }
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/companies/update/"+id,
        type: "GET",
        dataType: 'json',
        success: function (data) {
            if(data.response){
              $('#updateForm').trigger("reset");
              $('#admin_id').val(data.result.id);
              $('.first_name').val(data.result.first_name);
              $('.last_name').val(data.result.last_name);
              $('.email').val(data.result.email);
              $('.status').val(data.result.status).change();
              $('#updateModal').modal("show");
            }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

$(document).on('submit', '#updateForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "admin/companies/process_update",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                swal("Data has been updated successfully.")
                .then((value) => {
                  location.reload(); 
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

$('#datatable').DataTable({
  "ordering": true,
  "lengthChange": true,
  "searching": true,
  "processing":true,
  "serverSide": true,
  "ajax": {
      url: base_url + 'admin/companies/get_datatable',
      type: 'POST',
      "data": function (d) {
          return $.extend({}, d, {
            // "user_id": $('#user_id').val(),
            // "status_filter": $('#status_filter').val()
          });
      }
  },
  "order": [
      [0, 'asc']
  ],
  columnDefs: [
      //{'targets': 3, 'orderable': false},
      //{'targets': 4, 'orderable': false}
  ],
  "columns": [
      {"data": "company_name"},
      {"data": "manager_name"},
      {"data": "site_title"},
      {"data": "venue_title"},
      {"data": "created_at"},
      {"data": "action"},
  ]
});

function errors(arr = ''){
  $.each(arr, function( key, value ) {
    $('.'+key+'_error').html(value);
  });
  return false;
}

});
