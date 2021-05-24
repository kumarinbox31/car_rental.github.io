<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['blogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
{
$CarNumber=$_POST['CarNumber'];
$CarOwner = $_POST['CarOwner'];
$date = $_POST['date'];
$time = $_POST['time'];
$FullName = $_POST['FullName'];
$MobileNumber = $_POST['MobileNumber'];
$Addres = $_POST['Addres'];


$sql="INSERT INTO  booking(CarNumber,CarOwner,Date,Time,FullName,MobileNumber,Address) 
VALUES(:CarNumber,:CarOwner,:date,:time,:FullName,:MobileNumber,:Addres)";

$query = $dbh->prepare($sql);
$query->bindParam(':CarNumber',$CarNumber,PDO::PARAM_STR);
$query->bindParam(':CarOwner',$CarOwner,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':time',$time,PDO::PARAM_STR);
$query->bindParam(':FullName',$FullName,PDO::PARAM_STR);
$query->bindParam(':MobileNumber',$MobileNumber,PDO::PARAM_STR);
$query->bindParam(':Addres',$Addres,PDO::PARAM_STR);


$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Booking Created successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Rental Portal | Admin Create Car</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Create Booking</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<form  class='create_booking' method=POST>


											<label for="CarNumber" class='font'>Car Number:</label>

										
											<?php $VehicleNumber=$_SESSION['blogin']?>
											<input type="text" name="CarNumber" class="form-control" value="<?php echo htmlentities($VehicleNumber); ?>" disabled >

											
											<label class='font'>Car Owner</label>
											
<?php 
$VehicleNumber=$_SESSION['blogin'];
$sql = "SELECT OwnerName from  tblcars where VehicleNumber=:VehicleNumber";
$query = $dbh -> prepare($sql);
$query-> bindParam(':VehicleNumber', $VehicleNumber, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	

	?>
											<input type="text" name="CarOwner" class="form-control" value="<?php  echo htmlentities($result->OwnerName)?> " required disabled>
										<?php }} ?>
											
											<label class='font'>Date *</label>
											<input type="date" name="date" class="form-control " id="txtDate"  value="<?php echo date('Y-m-d'); ?>" onload="getDate()" required >
                                        
											

											<label class='font'>Time *</label>
											<input type="time" name="time" class="form-control"  required>

											<label class='font'>Full Name *</label>
											<input type="text" name="FullName" class="form-control"  required>

											<label class='font'>Mobile Number *</label>
											<input type="text" name="MobileNumber" class="form-control"  required>

											<label class='font'>Address *</label>
											<input type="text" name="Addres" class="form-control"  required>
											
											<br>
											<input type='submit' name='submit' class='btn btn-primary'>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script>
		$(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('#txtDate').attr('min', minDate);
});
	</script>
</body>
<style>
.font{
	font-size: 18px;
}

</style>

</html>
<?php } ?>