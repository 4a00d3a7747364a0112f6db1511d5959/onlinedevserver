
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
	.filter-form {
		position: relative;
	}
</style>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><?php echo 'Hello, <small>'.$_SESSION['login_user_email'].'</small>'; ?></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a class="active" href="http://onlinedevserver.biz/dev/demo/pms"> Home </a></li>
      <li><a class="active" href="history.php"> History </a></li>
      <li><a href="logout.php">Logout</a></li>           
    </ul>
  </div>
</nav>

<div class="container">
	
	
	<?php
		if(!empty($_GET['action']) && $_GET['action'] == 'edit'){ ?>
			<div class="update-wrapper" >
				<?php include('update_content.php'); ?>
			</div>
	<?php	}
	
?>

	<div>
		<form action="#" class="form-inline filter-form" method="get">
		  <div class="form-group">
			<label for="exampleInputName2">From Date : </label>
			<input type="text" name="start_date" class="form-control" id='datetimepicker1' >
		  </div>
		  <div class="form-group">
			<label for="exampleInputEmail2"> To Date : </label>
			<input type="text" name="end_date" class="form-control" id="datetimepicker2" >
		  </div>
		  <button type="submit" class="btn btn-success">Search</button>
		</form>
	<div>
<div class="MainArea">

	<?php		
		//$sql = "SELECT * FROM `content` WHERE `emp_id` = '$get_role->user_id' ";
		$sql = "SELECT * FROM `content` where emp_id = '{$get_role->user_id}'";
		if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
			$sql .= " AND DATE(created_date) >='{$_GET['start_date']}' AND DATE(created_date) <= '{$_GET['end_date']}'";
		}
		$res = mysqli_query($connection->connection_status, $sql);
		if(mysqli_num_rows($res) == 0){
			echo '<h4> Sorry! No record Found! </h4>';
		}
		?>
		<table class="table table-striped">
			<tr>
				<th>Project Name </th>
				<th>Date </th>
				<th>Time Form</th>
				<th>Time To </th>
				<th>Task Type </th>
				<th>Work Detail </th>
				<th>Options</th>
			</tr>
			<?php while($details = mysqli_fetch_assoc($res)){ ?>
				<tr>									
					<td>
						<?php echo $details['proj_name'];  ?>
					</td>		
					<td>
						<?php echo $date = date('M d Y',strtotime($details['created_date'])); ?>
					</td>		
					<td>
						<?php echo $details['time_to'];  ?>
					</td>						
					<td>
						<?php echo $details['time_from'];  ?>
					</td>						
					<td>
						Develop
					</td>
					<td>
						<?php echo $details['content_details'];  ?>
						<?php echo $details['content_id'];  ?>
					</td>
					<td>
						<a href="?action=edit&id=<?php echo $details['content_id'];  ?>" >Edit</a> |
						<a class ='del' href="?action=delete&id=<?php echo $details['content_id'];  ?>" >Delete</a>
					</td>
					
				</tr>
			<?php }	?>
		</table>
</div>
	


</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="js/jquery.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>


<script type="text/javascript">
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY-MM-DD'
		});
		$('#datetimepicker2').datetimepicker({
			format: 'YYYY-MM-DD'
		});
		$(".del").click(function(){
			if (!confirm("Do you want to delete")){
			  return false;
			}	
		});
	});
</script>