<?php
include('includes/config.php');

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
$sql="INSERT INTO  booking(CarNumber,Date,Time,FullName,MobileNumber,Address) 
VALUES(:CarNumber,:date,:time,:FullName,:MobileNumber,:Addres)";

$query = $dbh->prepare($sql);
$query->bindParam(':CarNumber',$CarNumber,PDO::PARAM_STR);
$query->bindParam(':date',$date,PDO::PARAM_STR);
$query->bindParam(':time',$time,PDO::PARAM_STR);
$query->bindParam(':FullName',$FullName,PDO::PARAM_STR);
$query->bindParam(':MobileNumber',$MobileNumber,PDO::PARAM_STR);
$query->bindParam(':Addres',$Addres,PDO::PARAM_STR);


$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo"<script>alert('Data Updated successfully')</script>";
echo "<script>window.locatin('action_booking_request.php')</script>";
}
}
}else{
    echo"<script>alert('NO DATA FOUND')</script>";
    echo "<script>window.locatin(dashboard.php')</script>";
}
}

?>