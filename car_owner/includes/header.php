
		<?php $VehicleNumber=$_SESSION['blogin'];
		$sql ="SELECT OwnerName from tblcars where VehicleNumber LIKE '%{$VehicleNumber}%' ";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$regusers=$query->rowCount();
		$cnt=1;
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>

		 ?>
<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 20px;"> Welcom To Car Rental Portal | <?php echo htmlentities($result->OwnerName);?> </a>  

	<?php }} ?>
		<span class="menu-btn"><i class="fa fa-bars"></i></span>
		<ul class="ts-profile-nav">
		<li class="ts-account">


				<li><a href="#">  Car Number: <?php echo htmlentities($VehicleNumber);?> </a> </li>



			</li>


		<li class="ts-account">
			
		</il>
			<li class="ts-account">
				<a href="#">Account <i class="fa fa-angle-down hidden-side"></i></a>
				<ul>

					<li> <a href="edit-car.php?id=<?php echo $result->id;?>">Change Details</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
