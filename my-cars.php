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


                        <section class="cars">
                        <div class="content-wrapper" id="container" >
                        <div class="container-fluid">
                        <div class="row">
                        <div class="col-md-12">
                        <h1 class="col-md-12"style="text-align: center;font-family: math;"> Cars</h1>

                        <div class="row">
                        <?php
                        $ret="select * from tblcars";
                        $query= $dbh -> prepare($ret);
                        //$query->bindParam(':id',$id, PDO::PARAM_STR);
                        $query-> execute();
                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                        if($query -> rowCount() > 0)
                        {
                        foreach($results as $result)
                        {

                            $filename=$result->CImage;
                            $folder="admin/img/".$filename; 
                        ?>

                        <div class="col-sm">
                        <div class="col-sm">


                        <a href="car-details.php?id=<?php echo $result->id;?>">
                        <div class="col-md-3"  style="padding:10px;">
                        <div class="divs">
                        <div class="head">
                        <h6 style="float:right;color:white;"> <?php echo htmlentities($result->VehicleNumber) ?></h6>
                        <h6 style="color: black;font-family: cursive;"> <?php echo htmlentities($result->OwnerName) ?> </h6>
                        </div>
                        <img src="<?php echo htmlentities($folder);?>" alt="" width="100%" height="200px;">
                        <!-- <p> <?php echo htmlentities($folder); ?> </p> -->

                        <!-- <a href="booking_request.php?id=<?php echo $result->VehicleNumber;?>" style="margin-left: 30px;color: green;font-weight: bold;"> Book Now </a>&nbsp;&nbsp; -->




                        </div>
                        </div>
                        </a>
                        </div>
                        </div>
                        <?php }} ?>
                        </div>
                        </div>



                        </section>
    

</div>
</body>
<style>
.cars{
    height: -webkit-fill-available;
    width: -webkit-fill-available;
}

.divs{
    background:linear-gradient(to top left, #cc33ff 0%, #ffcc99 100%);;
    padding:10px;
}
.head{
    width:100%;
    height:50px;
}
</style>
</html>

<?php }?>