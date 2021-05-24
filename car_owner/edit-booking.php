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
$Date = $_POST['Date'];
$Time = $_POST['Time'];
$FullName = $_POST['FullName'];
$MobileNumber = $_POST['MobileNumber'];
$Address = $_POST['Address'];

$id=$_GET['id'];

$sql="UPDATE booking SET CarNumber=:CarNumber,Date=:Date,Time=:Time,
FullName=:FullName,MobileNumber=:MobileNumber,Address=:Address WHERE id=:id";

$query = $dbh->prepare($sql);
$query->bindParam(':CarNumber',$CarNumber,PDO::PARAM_STR);
$query->bindParam(':Date',$Date,PDO::PARAM_STR);
$query->bindParam(':Time',$Time,PDO::PARAM_STR);
$query->bindParam(':FullName',$FullName,PDO::PARAM_STR);
$query->bindParam(':MobileNumber',$MobileNumber,PDO::PARAM_STR);
$query->bindParam(':Address',$Address,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();


$msg="Booking updted successfully";

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
										<form method=POST name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

<?php	
$id=$_GET['id'];
$ret="select * from booking where id=:id";
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
            <label class="col-sm-4 control-label"> Car</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo htmlentities($result->CarNumber);?>" name="CarNumber" id="brand" required>
            </div>
            <br>

            <label class="col-sm-4 control-label">Date </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo htmlentities($result->Date);?>" name="Date" id="brand" required>
            </div>
            <br>

            <label class="col-sm-4 control-label">Time</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo htmlentities($result->Time);?>" name="Time" id="brand" required>
            </div>
            <br>

            <label class="col-sm-4 control-label">Full Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo htmlentities($result->FullName);?>" name="FullName" id="brand" required>
            </div>
            <br>

            <label class="col-sm-4 control-label">Mobile Number</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo htmlentities($result->MobileNumber);?>" name="MobileNumber" id="brand" required>
            </div>
            <br>

            <label class="col-sm-4 control-label"> Address </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" value="<?php echo htmlentities($result->Address);?>" name="Address" id="brand" required>
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