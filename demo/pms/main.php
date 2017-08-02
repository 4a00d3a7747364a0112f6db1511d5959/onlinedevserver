
<link rel="stylesheet" href="css/bootstrap.css">
<style>
	.head{
		margin: 20px 0;
	}
	.appended_content{
		margin: 10px;
	}
	h4{
		text-align: center;
	}
	.alert.alert-success{
		display: none;
	}
</style>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?php echo 'Hello, <small>'.$_SESSION['login_user_email'].'</small>'; ?></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="history.php"> History </a></li>
      <li class="active"><a href="logout.php">Logout</a></li>           
    </ul>
  </div>
</nav>

<div class="container">

<div class="alert alert-success">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>

<div class="MainArea">
	<ul class="head list-inline clearfix">
		<li class="col-md-3"><strong>Project Name</strong></li>
		<li class="col-md-2"><strong>Time From</strong></li>
		<li class="col-md-2"><strong>Time to</strong></li>
		
		<li class="col-md-3"><strong>Detail Description</strong></li>	
		<li class="col-md-1"><a href="javascript:void(0)" class="btn btn-primary add_btn"> Add Project </a></li>
	</ul>
	<hr>

	<?php		
		//$sql = "SELECT * FROM `content` WHERE `emp_id` = '$get_role->user_id' ";
		$sql = "SELECT * FROM `content` where emp_id = '{$get_role->user_id}' AND DATE(created_date) = curdate();";
		$res = mysqli_query($connection->connection_status, $sql);
		if(mysqli_num_rows($res) == 0){
			echo '<h4> Sorry! No record Found! </h4>';
		}
		while($details = mysqli_fetch_assoc($res)){ ?>
			<div class="appended_content clearfix">
			<ul class=" list-inline clearfix">
			<div class="alert alert-info alert-dismissable" id="notification" style="padding: 4px 10px;">			
				<ul class="list-inline">
					<li> <strong> Created date:</strong> <?php echo $date = date('Y-m-d',strtotime($details['created_date'])); ?> </li>
					<li> <strong> Created date:</strong> <?php echo $time = date('H:i:s',strtotime($details['created_date'])); ?> </li>
				</ul>	
			</div>
					
			<li class="col-md-3"><input type="text" name="project_name" class="form-control" value="<?php echo $details['proj_name'];  ?>" ></li>
			
			<li class="col-md-2"><input type="text" name="time_from" class="form-control" value="<?php echo $details['time_from'];  ?>"></li>
			
			<li class="col-md-2"><input type="text" name="time_to" class="form-control" value="<?php echo $details['time_to'];  ?>"></li>
			
			<li class="col-md-3"><textarea name="detail_description" class="form-control" value="<?php echo $details['content_details'];  ?>"><?php echo $details['content_details'];  ?></textarea>  </li>
			<li class="col-md-1"><a href="javascript:void(0)" data-content-id="<?php  echo $details['content_id']; ?>" class="btn btn-primary update_btn"> Update </a></li>
			<li class="col-md-1"><a href="javascript:void(0)" data-content-id="<?php  echo $details['content_id']; ?>" class="btn btn-danger delete_btn"> Delete </a></li>
			</ul>
			</div>
	<?php }	?>
</div>
	


</div>

<script src="js/jquery.js"></script>
<script>
	var content = '<div class="appended_content clearfix"><ul class=" list-inline">'+
			'<li class="col-md-3"><input type="text" name="project_name"  class="form-control"></li>'+
			'<li class="col-md-2"><input type="text" name="time_to" class="form-control"></li>'+
			'<li class="col-md-2"><input type="text" name="time_from" class="form-control"></li>'+
			'<li class="col-md-3"><textarea name="detail_description" class="form-control" ></textarea>  </li>'+
			'<li class="col-md-1"><a href="javascript:void(0)" class="btn btn-primary save_btn"> Save </a></li>'+
		'</ul></div>';
	$(document).on('click','.add_btn', function (argument) {
		$('h4').remove();
		$('.container > .MainArea').append(content);
	});
	var userId = '<?php echo $get_role->user_id; ?>';

	var content_details = {user_id: userId ,project_name: undefined, time_to : undefined , time_from:undefined, detail_description:undefined };
	$(document).on('click','.save_btn',function (argument) {		
			
		content_details.project_name = $.trim($(this).parent().parent().find('input[name=project_name]').val());
		content_details.time_to = $.trim($(this).parent().parent().find('input[name=time_to]').val());
		content_details.time_from = $(this).parent().parent().find('input[name=time_from]').val();
		content_details.detail_description = $(this).parent().parent().find('textarea[name=detail_description]').val();
		//$(this).remove();
		if(content_details.project_name == undefined || content_details.project_name == ''){
			alert('Project name Cannot be blank!');
		}else{
			if(content_details.time_to == undefined || content_details.time_to == ''){
				alert('Time to Cannot be blank!');
			}else{

			$.ajax({
				url: 'add_details.php',
				type: 'POST',			
				data: content_details,
			}).success(function (result) {
				$('.alert.alert-success').fadeIn();
			setTimeout(function(){ $('.alert.alert-success').fadeOut(); },2000);
				updateDiv();
				function updateDiv()
				{ 
				    $( ".MainArea" ).load(window.location.href + " .MainArea" );
				}
			});			
		}
	}

	});

	var update_details = {

		user_id: userId, 
		U_content_id: undefined ,
		project_name: undefined, 
		time_to : undefined , 
		time_from:undefined, 
		detail_description:undefined 
	};

	$(document).on('click','.update_btn',function (argument) {		
			
		update_details.project_name = $(this).parent().parent().find('input[name=project_name]').val();
		update_details.U_content_id = $(this).attr('data-content-id');
		update_details.time_to = $(this).parent().parent().find('input[name=time_to]').val();
		update_details.time_from = $(this).parent().parent().find('input[name=time_from]').val();
		update_details.detail_description = $(this).parent().parent().find('textarea[name=detail_description]').val();		
		$.ajax({
			url: 'update_details.php',
			type: 'POST',			
			data: update_details,
		}).success(function (result) {
			//alert(result);
			$('.alert.alert-success').fadeIn();
			setTimeout(function(){ $('.alert.alert-success').fadeOut(); },2000);
			updateDiv();
			function updateDiv()
			{ 
			    $( ".MainArea" ).load(window.location.href + " .MainArea" );
			}
		});			
		

	});
	var delete_details = {user_id: userId, U_content_id: undefined};

	$(document).on('click','.delete_btn',function (argument) {

		delete_details.U_content_id = $(this).attr('data-content-id');
		
		$.ajax({
			url: 'delete_details.php',
			type: 'POST',			
			data: delete_details,
		}).success(function (result) {
			//alert(result);
			$('.alert.alert-success').fadeIn();
			setTimeout(function(){ $('.alert.alert-success').fadeOut(); },2000);
			updateDiv();
			function updateDiv()
			{ 
			    $( ".MainArea" ).load(window.location.href + " .MainArea" );
			}
		});			

	});

</script>


