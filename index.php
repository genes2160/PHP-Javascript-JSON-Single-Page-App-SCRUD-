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
  <script src="js/index.js"></script>
<script type="text/javascript">


</script>

</body>
</html>
