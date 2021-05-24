
<?php
session_start();
error_reporting(0);

if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{


require ('admin/includes/config.php');

if(isset($_POST['submit']))
{
	//  CarNumber,date,time,FullName,MobileNumber,Addres,submit

$CarNumber=$_POST['CarNumber'];
$date = $_POST['date'];
$time = $_POST['time'];
$FullName = $_POST['FullName'];
$MobileNumber = $_POST['MobileNumber'];
$Addres = $_POST['Addres'];


$sql="INSERT INTO  booking_request(CarNumber,Date,Time,FullName,MobileNumber,Address) 
VALUES(:CarNumber,:date,:time,:FullName,:MobileNumber,:Addres)";

$query = $dbh->prepare($sql);

$query->bindParam(':CarNumber',$CarNumber,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':time',$time,PDO::PARAM_STR);
$query->bindParam(':FullName',$FullName,PDO::PARAM_STR);
$query->bindParam(':MobileNumber',$MobileNumber,PDO::PARAM_STR);
$query->bindParam(':Addres',$Addres,PDO::PARAM_STR);
// $query->bindParam(':RandomNumber',$RandomNumber,PDO::PARAM_STR);


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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
	
<title>Car Rental Portal | Admin Create Car</title>


<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 


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
<section class="header">
<?php include('includes/header.php') ?>


</section>
	<div class="ts-main-content">

		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Booking Request</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="POST" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

											<form  class='create_booking' method=POST>


											<label for="CarNumber" class='font'>Choose a Car</label>

										
											<?php
											$id = $_GET['id'];
											 $ret="select VehicleNumber from tblcars where id=:id";
                                                $query= $dbh -> prepare($ret);
                                                $query->bindParam(':id',$id, PDO::PARAM_STR);
                                                $query-> execute();
                                                $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                if($query -> rowCount() > 0)
                                                {
                                                foreach($results as $result)
                                                {
                                                ?>
                                                <input type="text" name="CarNumber" class="form-control" value="<?php echo htmlentities($result->VehicleNumber);?>" disabled>
												 <?php }} ?>
											
											<label class='font control-label' >Date <span>*<span></label>
											<input type="date" id="txtDate"  name="date" class="form-control"  required>

											<label class='font control-label'>Time <span>*<span> </label>
											<input type="time" name="time" class="form-control"  required>

											<label class='font control-label'>Full Name <span>*<span></label>
											<input type="text" name="FullName" class="form-control"  required>

											<label class='font control-label'>Mobile Number <span>*<span></label>
											<input type="text" name="MobileNumber" class="form-control"  required>

											<label class='font control-label'>Address <span>*<span> </label>
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

</body>
<style>
.font{
	font-size: 18px;
}
.navbar-default .navbar-nav > li > a {
    color: #fff;
    display: block;
    font-size: 13px;
    font-weight: 800;
    line-height: 27px;
    padding: 20px 22px;
    text-transform: uppercase;
    position: relative;
}

</style>

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
	
</html>
<?php } ?>