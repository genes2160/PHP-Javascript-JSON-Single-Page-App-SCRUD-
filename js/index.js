const appName = {
    name: "Eugene Dee",
    version: "5.6",
    date: "26th December, 2018",
    run: function(){
    return console.log("%cApp Info=> Name: "+this.name+" - Version: "+this.version+" - Date: "+this.date+" - .", "background: #000;padding:5px;color:#fff;");
    }
}

appName.run();

setTimeout(() => {

    var newurl = "forms_details.json";
    var tr;
    $.getJSON(newurl,
    function (json) {
        for (var i = 0; i < json.length; i++) {

        tr = $('<tr>');
            if(typeof json[i].date_submitted == "undefined" || json[i].date_submitted == ''){
                json[i].date_submitted = new Date();
            }
            if(typeof json[i].city == "undefined" || json[i].city == ''){
                json[i].city = 'Accra';
            }
            $id = parseInt(i) + 1;
            tr.append("<td>" + json[i].name + "</td>");
            tr.append("<td>" + json[i].email + "</td>");
            tr.append("<td>" + json[i].phone_number + ' / ' + json[i].alternative_phone_number  + "</td>");
            tr.append("<td>" + json[i].country + "</td>");
            tr.append("<td>" + json[i].city + "</td>");
            tr.append("<td>" + json[i].amount_to_invest + "</td>");
            tr.append("<td>" + json[i].currency + "</td>");
            tr.append("<td>" + json[i].contract_period + "</td>");
            tr.append("<td>" + json[i].payment_method + "</td>");
            tr.append("<td>" + json[i].date_submitted + "</td>");
            tr.append("<td> <a href='javascript:void(0);' data-edit='"+ i +"'  data-id='"+ json[i].id  +"'  class='btn btn-sm btn-warning edit_form'  > Edit </a> <a href='javascript:void(0);' data-delete='"+ i +"'  data-id='"+ json[i].id  +"'  class='btn btn-sm btn-danger delete_form'  > Delete</a> </td>");
            //console.log("Date Submitted "+json[i].date_submitted);
            tr.append('</tr>');
            $('.tbody').append(tr);
        }
        if(tr == "<tr>"){
            tr.append("<td colspan='9' style='text-align:center;' > No Data Available </td>");

        }else{
            //$('.tbody').append(tr);
        }
    });

        if(tr == "<tr>"){
            //tr.append("<td colspan='9' style='text-align:center;' > No Data Available </td></tr>");

        }else{
            //tr.append('</tr>');
            //$('.tbody').append(tr);
        }
        
        $(".dataTable_ttj").dataTable();

}, 100);

$(document).on('click', '.add_form', function(){
    let add_form = $(this).data('add');
    let id = $(this).data('id');
    console.log("The ID is "+id);
    $.ajax({
        url: "form_process",
        type:"post",
        dataType: "json",
        data:{add_form: add_form, id: id},
        beforeSend: function(){
            console.warn("File is being contacted ...");
        },
        success: function(data){
            $(".load_modal").html(data.modal);
            console.log(data);
            $(".add_form_show").modal("show");
        },
        error: function(){
            console.error("Could not be reached");
        }
    });
});

$(document).on('click', '.edit_form', function(){
    let edit_form = $(this).data('edit');
    console.log("Edit form is "+edit_form);
    $.ajax({
        url: "form_process",
        type:"post",
        dataType: "json",
        data:{edit_form: edit_form},
        beforeSend: function(){
            console.warn("File is being contacted ...");
        },
        success: function(data){
            console.log(data);
            $(".load_modal").html(data.modal);
            $(".edit_form_show").modal("show");
        },
        error: function(){
            console.error("Could not be reached");
        }
    });
});

$(document).on('click', '.delete_form', function(){
    let delete_form = $(this).data('delete_form');
    //$(bootbox);
    $.ajax({
        url: "form_process",
        type:"post",
        dataType: "json",
        data:{delete_form: delete_form},
        beforeSend: function(){
            console.warn("File is being contacted ...");
        },
        success: function(data){
            console.log(data);
            $(".edit_form_show").modal("show");
        },
        error: function(){
            console.error("Could not be reached");
        }
    });
});

  
$(document).on('submit', '.submit_partner_form', function(event){
    $(".submit_form").attr("disabled", true);
    $(".submit_form").html("Submitting");
    event.preventDefault();
    $.ajax({
        url: "form_process",
        type: "post",
        dataType: "json",
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log("Submitting ...");
        },
        success: function (data) {
            $(".submit_form").attr("disabled", false);
            $(".submit_form").html("Submit");
            $(".submit_partner_form")[0].reset();
	    $("#add_form_show").modal("hide");
            toastr.success("Bravo your form has been successfully submiited");
            console.warn(data);
            
        },
        error: function () {
	    $("#add_form_show").modal("hide");
	    toastr.error("Sorry your form could not be submitted. Please try again later");
            $(".submit_form").attr("disabled", false);
            $(".submit_form").html("Submit");
            console.warn("500 internal error");
            


        }
    });
});
  
$(document).on('submit', '.update_submit_partner_form', function(event){
    $(".update_submit_form").attr("disabled", true);
    $(".update_submit_form").html("Updating ...");
    event.preventDefault();
    $.ajax({
        url: "form_process",
        type: "post",
        dataType: "json",
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log("Submitting ...");
        },
        success: function (data) {
            $(".update_submit_form").attr("disabled", false);
            $(".update_submit_form").html("Update");
            $(".update_submit_partner_form")[0].reset();
	    $("#edit_form_show").modal("hide");
            toastr.success("Bravo your form has been successfully submiited");
	    $("form").modal("hide");
            
            console.warn(data);
            //console.warn(data.status);
            //console.warn(data.message);
    
            
        },
        error: function () {
	    $("#edit_form_show").modal("hide");
	    toastr.error("Sorry your form could not be submitted. Please try again later");
            $(".update_submit_form").attr("disabled", false);
            $(".update_submit_form").html("Update");
            console.warn("500 internal error");
            


        }
    });
});
