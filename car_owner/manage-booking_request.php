<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['blogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "delete from booking_request  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$msg="Page data updated successfully";

}


if(isset($_GET['bid'])){
	$bid=$_GET['bid'];
	$sql = "SELECT * from  booking_request where id=:bid ";
	$query = $dbh -> prepare($sql);
	$query-> bindParam(':bid', $bid, PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$cnt=1;
	if($query->rowCount() > 0)
	{
	foreach($results as $result)
	{
		
	$CarNumber=$result->CarNumber;
	$date = $result->Date;
	$time = $result->Time;
	$FullName = $result->FullName;
	$MobileNumber = $result->MobileNumber;
	$Addres = $result->Address;
	$RandomNumber=$result->RandomNumber;

	$sql="INSERT INTO  booking(CarNumber,Date,Time,FullName,MobileNumber,Address,status,RandomNumber) 
	VALUES(:CarNumber,:date,:time,:FullName,:MobileNumber,:Addres,1,:RandomNumber)";
	
	$query = $dbh->prepare($sql);
	$query->bindParam(':CarNumber',$CarNumber,PDO::PARAM_STR);
	$query->bindParam(':date',$date,PDO::PARAM_STR);
	$query->bindParam(':time',$time,PDO::PARAM_STR);
	$query->bindParam(':FullName',$FullName,PDO::PARAM_STR);
	$query->bindParam(':MobileNumber',$MobileNumber,PDO::PARAM_STR);
	$query->bindParam(':Addres',$Addres,PDO::PARAM_STR);
	$query->bindParam(':RandomNumber',$RandomNumber,PDO::PARAM_STR);
	
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if($lastInsertId)
	{
	echo "<script> alert('Data Updated Successfully')</script>";
	echo "<script>window.location('action_booking_request.php')</script>";
	}
	}
	}else{
		echo"<script>alert('NO DATA FOUND')</script>";
		echo "<script>window.location('dashboard.php')</script>";
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
	
	<title>Car Rental Portal | Booking Request for Car Owner   </title>

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

						<h2 class="page-title">Manage Bookings Requests
						
						</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Bookings Info</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Car</th>
											<th>Date</th>
											<th>Time</th>
											<th>Mobile Number</th>
											<th>Address</th>
											<th>Booking DateTime</th>
											<th>RandomNumber</th>
											<th> Email </th>
											<th> Status </th>
							
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>Name</>
											<th>Car</th>
											<th>Date</th>
											<th>Time</th>
											<th>Mobile Number</th>
											<th>Address</th>
											<th>Booking DateTime</th>
											<th>RandomNumber</th>
											<th> Email </th>
											<th> Status </th>

											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

<?php 
$VehicleNumber=$_SESSION['blogin'];
$sql = "SELECT * from  booking_request where CarNumber=:VehicleNumber";
$query = $dbh -> prepare($sql);
$query-> bindParam(':VehicleNumber', $VehicleNumber, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	$bid=$result->id;			?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->FullName);?></td>
											<td><?php echo htmlentities($result->CarNumber);?></td>
											<td><?php echo htmlentities($result->Date);?></td>
											<td><?php echo htmlentities($result->Time);?></td>
											<td><?php echo htmlentities($result->MobileNumber);?></td>
											<td><?php echo htmlentities($result->Address);?></td>
											<td><?php echo htmlentities($result->CurrentDateTime);?></td>
											<td> <?php echo htmlentities($result->RandomNumber);?> </td>
											<td>	</td>
											<td> </td>
											<td>
											<a href="manage-booking_request.php?bid=<?php echo $bid ?>" > OK </a>
											<a style="margin-left:10px;"href="manage-booking_request.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
                                          
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

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
</body>
</html>
<?php } ?>
