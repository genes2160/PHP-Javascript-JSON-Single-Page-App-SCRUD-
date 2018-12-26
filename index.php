<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CRUD JSON</title>
    <link rel="stylesheet" href="css/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/toastr.min.css" />
</head>
<body>
<div class="container row">
   <div class="col-md-12 text-center">
   <h3> JSON CRUD Web App</h3><br/>

		<?php
			//fetch data from json
			$data = file_get_contents('forms_details.json');
			//decode into php array
			$data = json_decode($data);

            $index = 0;
            $id = 0;
            if($data):
                foreach($data as $row){
                    $id = $row->id;
                }
            else:
                $id = 1;
            endif;
   ?>
   <a class="btn btn-sm btn-success add_form" data-add="<?php echo mt_rand().time(); ?>"  data-id="<?php echo $id+1; ?>"   href="#add_form" data-toggle="modal"><i class="icon-plus icon-large"></i>&nbsp; Add Form </a><br/>
   </div>

   <div class="col-md-12">
 
     <table class="table-bordered table-hover table-striped dataTable_ttj" style="width:100% !important;">
        <thead style="font-weight:900;">
                <tr>
                    <td> Name </td>
                    <td> Email </td>
                    <td> Phone No. <br/> (Alternative No.) </td>
                    <td> Country </td>
                    <td> City </td>
                    <td> Amount to Invest </td>
                    <td> Currency </td>
                    <td> Contract Period </td>
                    <td> Payment Method </td>
                    <td> Date Submitted </td>
                    <td> Action </td>
                </tr>
        </thead>
        <tbody class="tbody">
            
        </tbody>
     </table>
</div>
</div>
<div class="load_modal"></div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/toastr.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
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
            alert("Bravo your form has been successfully submiited");
            
            console.warn(data);
            //console.warn(data.status);
            //console.warn(data.message);
    
            
        },
        error: function () {
            alert("Sorry your form could not be submitted. Please try again later");
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
            alert("Bravo your form has been successfully submiited");
            
            console.warn(data);
            //console.warn(data.status);
            //console.warn(data.message);
    
            
        },
        error: function () {
            alert("Sorry your form could not be submitted. Please try again later");
            $(".update_submit_form").attr("disabled", false);
            $(".update_submit_form").html("Update");
            console.warn("500 internal error");
            


        }
    });
});

</script>

</body>
</html>