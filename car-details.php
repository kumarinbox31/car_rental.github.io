<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  {
header('location:index.php');
}
else{
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Car Rental Portal</title>
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
</head>

<body>
<section class="header">
<?php include("includes/header.php") ?>
</section>



<!-- slide show ends -->

<?php
$id=$_GET['id'];
$ret="select * from tblcars where id=:id";
$query= $dbh -> prepare($ret);
$query->bindParam(':id',$id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{

$filename=$result->CImage;
$folder="admin/img/".$filename; 
?>


<div class="container-fluid">
<div class="col-md-6" style="margin-top:22px;">
<!--  your first column here  -->
   <img src="<?php echo htmlentities($folder); ?>" width="500px" height="300px">
  </div>
  <div class="col-md-6" style="margin-top:22px;">
    <!-- Your second column here -->
        <div class="col-md-12">
        <h6 style="float:left;"> Brand Name:</h6>
        <h6 style="margin-left: 221px"> <?php echo htmlentities($result->BrandName); ?> </h6>

        <h6 style="float:left;"> Car Owner Name:</h6>
        <h6 style="margin-left: 221px"> <?php echo htmlentities($result->OwnerName); ?> </h6>

        <h6 style="float:left;"> Owner Mobile Number:</h6>
        <h6 style="margin-left: 221px"><?php echo htmlentities($result->OwnerMobile); ?> </h6>

        <h6 style="float:left;"> Driver Mobile Number:</h6>
        <h6 style="margin-left: 221px">  <?php echo htmlentities($result->DriverMobile); ?></h6>

        <h6 style="float:left;"> Address: </h6>
        <h6 style="margin-left: 221px">  <?php echo htmlentities($result->Address); ?></h6>

        <div class="col-md-6">
        <a href="booking_request.php?id=<?php echo $result->id;?>" style="margin-left: 30px;color: green;font-weight: bold;"> 
        <h5 style="text-align:center;font-family:math;font-size:30px;background:red;color:white;"> Book Now <h5> 
        </a>
         <!-- OwnerMobile,DriverMobile,VehicleNumber,Address -->

        
        </div>
  </div>
</div>

<?php }} ?>


</bdoy>



<style>

* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
h6{
  font-family:cursive;
}
</style>

</html>
<?php } ?>