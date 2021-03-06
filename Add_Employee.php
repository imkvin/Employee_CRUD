<?php

include 'connection.php';

if(isset($_POST['submit'])){
	$eid=$_POST['eid'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$stid=$_POST['stid'];
	$sal=$_POST['sal'];
	$desg=$_POST['desg'];
	$did='';
	$mgrid='';
	if(isset($_POST['did'])){
		$did=$_POST['did'];
	}
	if(isset($_POST['mgrid'])){
		$mgrid=$_POST['mgrid'];
	}

	$lname=strtoupper($lname);
	$fname=strtoupper($fname);

	if($desg=="MANAGER-1"){
		$desg="MANAGER";
		$sql="INSERT into employee value ($eid,'$fname','$lname',$stid,null,$sal,null,'$desg')";
	}elseif($desg=="MANAGER-2"){
		$desg="MANAGER";
		$sql="INSERT into employee value ($eid,'$fname','$lname',$stid,$did,$sal,$mgrid,'$desg')";	
	}else{
		$sql="INSERT into employee value ($eid,'$fname','$lname',$stid,$did,$sal,$mgrid,'$desg')";	
	}
	if(mysqli_query($conn,$sql)){
	 	echo '<script>alert("New employee record of  *** '.$fname.' '.$lname.' *** inserted")</script>';
	}else{
	 	echo '<script>alert("Employee record could not be inserted")</script>';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Employee @ JB</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<style type="text/css">
	a.head{
		font-family: 'Pacifico', cursive;
		font-size: 30px;
	}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>
<body>

<div class="container-fluid p-0">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0">
  <a class="navbar-brand head" style="color: #2268FF" href="">John Brothers</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link">Sales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Employee.php">Employee <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <span class="navbar-text" style="font-size: 20px;font-weight: bold;">
      ADD EMPLOYEE
    </span>
  </div>
</nav>
<div class="container-fluid">
<div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
              <h3 class="m-0 font-weight-bold text-primary float-left">New Employee</h3>
            </div>
            <div class="card-body p-5">
            <div class="container py-4 px-5 bg-light rounded">
            	<div class="h4 mx-auto text-center">Fill out the below information</div>
              <form method="POST" class="form-wrapper px-5">
              	<div class="form-group">
              		<label class="h6">Employee's Name <span class="light" style="color: #cacaca;">[Firstname Lastname]</span></label><br>
              		<div class="row">
              			<div class="col-md-6">
              				 <input type="text" name="fname" placeholder="John" required class="form-control form-control-user">
              			</div>
              			<div class="col-md-6">
              				<input type="text" name="lname" placeholder="Deo" required class="form-control form-control-user">	 
              			</div>
              		</div>
              	</div>
              	<div class="form-group">
              		<div class="row">
              			<div class="col-md-6">
              				<label class="h6">Employee's ID</label><br>
              				<?php
              					$sql="SELECT eid FROM `employee`";
              					$r=mysqli_query($conn,$sql);
              					$count=mysqli_num_rows($r);
              					$id= (int)$count + 100;
              					echo '<input type="text" name="eid" readonly class="form-control  form-control-user" value="'.$id.'">';
              				?>
              			</div>
              			<div class="col-md-6">
		              		<label class="h6">Employee's Gross Salary (in Rs.)</label><br>
              				<input type="number" name="sal" placeholder="1000" min="1000" alt="Salary Must be greater than 1000" required class="form-control form-control-user">
              			</div>
              		</div>
              	</div>
              	<div class="form-group">
              		<div class="row">
              			<div class="col-md-6">
              				<label class="h6">Employee's Designation</label><br>
				            <select title="Please select correct input" id="desg" onchange="call()" required class="form-control form-control-user" name="desg">
				              	<option value="none">
				              		--SELECT--
				              	</option>
					            <option value="MANAGER-1">
					            	STORE MANAGER
					            </option>
					           	<option value="MANAGER-2">
					           		DEPARTMENT MANAGER
					           	</option>
				              	<option value="SALESMAN">
				              		SALESMAN
				              	</option>
				              	<option value="CLERK">
									CLERK	              				
			             		</option>
				           	</select>	
              			</div>
              			<div  class="col-md-6">
              				<label class="h6">Store No.</label><br>
		              		<select name="stid" required class="form-control">
		              			<option value="none">
				              		--SELECT--
				              	</option>
		              			<?php
              						$sql="SELECT stid from store";
              						$r=mysqli_query($conn,$sql);
              						while($row=mysqli_fetch_assoc($r)){
              							echo "<option value=\"".$row['stid']."\">".$row['stid']."</option>";
              						}
              					?>
		              		</select>	
              			</div>
              		</div>
              	</div>
              	<div class="form-group">
              		<div class="row">
              			<div class="col-md-6">
		              		<label>Manager's ID</label>
		              		<select name="mgrid" required id="mgrid" class="form-control">
		              			<option readonly value="none">
				              		--SELECT--
				              	</option>
		              			<?php
              						$sql="SELECT eid from employee where desg='MANAGER'";
              						$r=mysqli_query($conn,$sql);
              						while($row=mysqli_fetch_assoc($r)){
              							echo "<option value=\"".$row['eid']."\">".$row['eid']."</option>";
              						}
              					?>
		              		</select>	
              			</div>
              			<div class="col-md-6">
              				<label class="h6">Department No.</label><br>
              				<select name="did" required id="did" class="form-control">
              					<option value="none">
				              		--SELECT--
				              	</option>
              					<?php
              						$sql="SELECT did from department";
              						$r=mysqli_query($conn,$sql);
              						while($row=mysqli_fetch_assoc($r)){
              							echo "<option value=\"".$row['did']."\">".$row['did']."</option>";
              						}
              					?>
              				</select>
              			</div>
              		</div>
              	</div>
              	<div class="form-group">
              		<input type="submit" name="submit" value="Get Started" class="float-right btn-success btn form-control form-control-user">
              	</div>
              </form>
            </div>	
        </div>
</div>
</div>
<footer class="bg-light pr-3 text-right text-secondary font-weight-bold">
	&copy 2019: John Brothers
</footer>
</div>
<script type="text/javascript">
	
	var designation=document.getElementById('desg');

	function disable(e){
		e.disabled = true;
	}

	function enable(e){
		e.disabled = false;
	}

	function call(){
		if(designation.value=="MANAGER-1" || designation.value=="none"){
			disable(document.getElementById('mgrid'));
			disable(document.getElementById('did'));
			document.getElementById('mgrid').value="none";
			document.getElementById('did').value="none";
		}else{
			enable(document.getElementById('mgrid'));
			enable(document.getElementById('did'));
		}
	}

</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>