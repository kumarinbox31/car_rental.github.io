<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
{

$BrandName=$_POST['BrandName'];
$OwnerName = $_POST['OwnerName'];
$OwnerMobile = $_POST['OwnerMobile'];
$DriverMobile = $_POST['DriverMobile'];
$VehicleNumber = $_POST['VehicleNumber'];
$Addres = $_POST['Addres'];


$id=$_GET['id'];

$sql="UPDATE tblcars SET BrandName=:BrandName,OwnerName=:OwnerName,OwnerMobile=:OwnerMobile,
DriverMobile=:DriverMobile,VehicleNumber=:VehicleNumber,Address=:Addres WHERE id=:id";

$query = $dbh->prepare($sql);
$query->bindParam(':BrandName',$BrandName,PDO::PARAM_STR);
$query->bindParam(':OwnerName',$OwnerName,PDO::PARAM_STR);
$query->bindParam(':OwnerMobile',$OwnerMobile,PDO::PARAM_STR);
$query->bindParam(':DriverMobile',$DriverMobile,PDO::PARAM_STR);
$query->bindParam(':VehicleNumber',$VehicleNumber,PDO::PARAM_STR);
$query->bindParam(':VehicleNumber',$VehicleNumber,PDO::PARAM_STR);
$query->bindParam(':Addres',$Addres,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);


$query->execute();
$lastInsertId = $dbh->lastInsertId();


$msg="Car updted successfully";


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
	
	<title>Car Rental Portal | Admin Create Brand</title>

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
					
						<h2 class="page-title">Edit Car</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method=POST name="chngpwd" class="form-horizontal" onSubmit="return valid();" enctype="multipart/form-data">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<?php	
$id=$_GET['id'];
$ret="select * from tblcars where id=:id";
$query= $dbh -> prepare($ret);
$query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
	
?>

								<div class="form-group">
									<label class="col-sm-4 control-label">Brand Name</label>
									<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo htmlentities($result->BrandName);?>" name="BrandName" id="brand" required desabled>
										
									</div>
									<br>

									<label class="col-sm-4 control-label">Owner Name</label>
									<div class="col-sm-8">
									<input type="text" class="form-control" value="<?php echo htmlentities($result->OwnerName);?>" name="OwnerName" id="brand" required>
									</div>
									<br>

									<label class="col-sm-4 control-label">Owner Mobile</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo htmlentities($result->OwnerMobile);?>" name="OwnerMobile" id="brand" required>
									</div>
									<br>

									<label class="col-sm-4 control-label">Driver Mobile</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo htmlentities($result->DriverMobile);?>" name="DriverMobile" id="brand" required>
									</div>
									<br>

									<label class="col-sm-4 control-label">Vehichle Number</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo htmlentities($result->VehicleNumber);?>" name="VehicleNumber" id="brand" required>
									</div>
									<br>

									<label class="col-sm-4 control-label"> Address </label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo htmlentities($result->Address);?>" name="Addres" id="brand" required>
									</div>

									
									

									
								</div>
								<div class="hr-dashed"></div>
											
										<?php }} ?>
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
												</div>
											</div>

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

</body>

</html>
<?php } ?>






