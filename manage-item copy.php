 <?php
	session_start();
	error_reporting(0);
	include('includes/config.php');

	if(strlen($_SESSION['login'])==0)
	{	
		echo 'aasdjfb ';
		header('location:index.php');
	}
	else
	{ 
		// insert data into tblpostitem
		if(isset($_POST['submit']))
		{
			$userId=$_POST['userId'];
			$productName=$_POST['productName'];
			$usedYear=$_POST['usedYear'];
			$overview=$_POST['overview'];
			$totalPrice=$_POST['totalPrice'];
			$pricePerDay=$_POST['pricePerDay'];
			$value=$_POST['value'];
			$payPalBusinessAccount=$_POST['payPalBusinessAccount'];
			$contactNo=$_POST['contactNo'];
			$vimage1=$_FILES["img1"]["name"];
			$vimage2=$_FILES["img2"]["name"];
			$vimage3=$_FILES["img3"]["name"];
			$vimage4=$_FILES["img4"]["name"];
			$vimage5=$_FILES["img5"]["name"];
			$sell=$_POST['sell'];
			$rent=$_POST['rent'];
			$swap=$_POST['swap'];
			move_uploaded_file($_FILES["img1"]["tmp_name"],"img/itemImages/".$_FILES["img1"]["name"]);
			move_uploaded_file($_FILES["img2"]["tmp_name"],"img/itemImages/".$_FILES["img2"]["name"]);
			move_uploaded_file($_FILES["img3"]["tmp_name"],"img/itemImages/".$_FILES["img3"]["name"]);
			move_uploaded_file($_FILES["img4"]["tmp_name"],"img/itemImages/".$_FILES["img4"]["name"]);
			move_uploaded_file($_FILES["img5"]["tmp_name"],"img/itemImages/".$_FILES["img5"]["name"]);

			$sql="INSERT INTO tblpostitem(user_id, productName,usedYear,overview,totalPrice,pricePerDay,value,payPalBusinessAccount,contactNo,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,sell,rent,swap)
			 VALUES(:userId,:productName,:usedYear,:overview,:totalPrice,:pricePerDay,:value,:payPalBusinessAccount,:contactNo,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:sell,:rent,:swap)";
			$query = $dbh->prepare($sql);
			$query->bindParam(':userId',$userId,PDO::PARAM_STR);
			$query->bindParam(':productName',$productName,PDO::PARAM_STR);
			$query->bindParam(':usedYear',$usedYear,PDO::PARAM_STR);
			$query->bindParam(':overview',$overview,PDO::PARAM_STR);
			$query->bindParam(':totalPrice',$totalPrice,PDO::PARAM_STR);
			$query->bindParam(':pricePerDay',$pricePerDay,PDO::PARAM_STR);
			$query->bindParam(':value',$value,PDO::PARAM_STR);
			$query->bindParam(':payPalBusinessAccount',$payPalBusinessAccount,PDO::PARAM_STR);
			$query->bindParam(':contactNo',$contactNo,PDO::PARAM_STR);
			$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
			$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
			$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
			$query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
			$query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
			$query->bindParam(':sell',$sell,PDO::PARAM_STR);
			$query->bindParam(':rent',$rent,PDO::PARAM_STR);
			$query->bindParam(':swap',$swap,PDO::PARAM_STR);
			
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId)
			{
				$msg="Item posted successfully";
			}
			else 
			{
				$error="Something went wrong. Please try again" . $userId . $sql;
			}

		}
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<!-- <title>Car Rental Portal | Post Item</title> -->
	<title>SellRentSwap System | Post Item</title>

	<!--  -->
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
	<!--  -->
	<!--Bootstrap -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
	<!--Custome Style -->
	<link rel="stylesheet" href="assets/css/style.css" type="text/css">
	<!--OWL Carousel slider-->
	<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
	<!--slick-slider -->
	<link href="assets/css/slick.css" rel="stylesheet">
	<!--bootstrap-slider -->
	<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
	<!--FontAwesome Font Style -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<!-- SWITCHER -->
	<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
	<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
			
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
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
	<!-- <h1><?= $id ?></h1> -->
	<!-- Start Switcher -->
	<?php include('includes/colorswitcher.php');?>
	<!-- /Switcher -->  

	<!--Header-->
	<?php include('includes/header.php');?>
	<!-- /Header --> 

	<!--Page Header-->
	<section class="page-header contactus_page">
		<div class="container">
			<div class="page-header_wrap">
			<div class="page-heading">
				<h1>Manage Item</h1>
			</div>
			<ul class="coustom-breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li>Manage Item</li>
			</ul>
			</div>
		</div>

		<!-- Dark Overlay-->
		<div class="dark-overlay"></div>
	</section>
	<!--/Page Header--> 

	<!--Body-->
	<div class="ts-main-content section-padding">
		<!-- <div class="content-wrapper"> -->
		<div class="container">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Manage Items</h2>

						<!-- Zero Configuration Table -->
						<!-- <div class="panel panel-default"> -->
						<div class="row">
							<div class="panel-heading">Item Details</div>
							
							<div class="panel-body">
								<!-- notify( success/fail ) -->
								<?php 
										if($error){
									?>
										<div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?></div>
									<?php 
										} else if($msg){
									?>
										<div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?></div>
									<?php 
										}
								?>

								<!-- table -->
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<!-- table header -->
									<thead>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>Image</th>
											<th>Used Year</th>
											<th>Overview</th>
											<th>Total Price( sell ), RM</th>
											<th>Price Per Day( rent ), RM</th>
											<!--  -->
											<th>Value( swap ), RM</th>
											<th>PayPal Business Account</th>
											<th>Contact Nombor</th>
											<td>Updation Date</td>
										</tr>
									</thead>

									<!-- table footer -->
									<tfoot>
										<tr>
											<th>#</th>
											<th>Product Name</th>
											<th>Image</th>
											<th>Used Year</th>
											<th>Overview</th>
											<th>Total Price( sell ), RM</th>
											<th>Price Per Day( rent ), RM</th>
											<th>Value( swap ), RM</th>
											<th>PayPal Business Account</th>
											<th>Contact Nombor</th>
											<td>Updation Date</td>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<!-- table body -->
										<!-- get data from( tblvehiclestbl, brands ) -->
									<?php 
										/* $sql = 
											"SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id 
											from tblvehicles 
											join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand"; */
										$sql = "SELECT * from tblpostitem where user_id=$id";

										echo $id;

										$query = $dbh -> prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										
										if($query->rowCount() > 0){
											foreach($results as $result){
									?>
										<!-- html -->
									<tr>
										<td><?php echo htmlentities($cnt);?></td>
										<td><?php echo htmlentities($result->productName);?></td>
										<td><?php echo htmlentities($result->Vimage1);?></td>
										<td><?php echo htmlentities($result->usedYear);?></td>
										<td><?php echo htmlentities($result->overview);?></td>
										<td><?php echo htmlentities($result->totalPrice);?></td>
										
										<td><?php echo htmlentities($result->pricePerDay);?></td>
										<td><?php echo htmlentities($result->value);?></td>
										<td><?php echo htmlentities($result->payPalBusinessAccount);?></td>
										<td><?php echo htmlentities($result->contactNo);?></td>
										<td><?php echo htmlentities($result->updationDate);?></td>

										<td>
											<a href="edit-vehicle.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
											<a href="manage-vehicles.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a>
										</td>
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

	<!--  -->
	<!--  -->
	<!--  -->
	
	<!--/Body-->

	<!-- Cancel & Save btn -->
	<!-- <div class="form-group">
		<div class="col-sm-8 col-sm-offset-2">
			<button class="btn btn-default" type="reset">Cancel</button>
			<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
		</div>
	</div> -->

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js">
		</script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js">
	</script>

	<!--Footer -->
	<?php include('includes/footer.php');?>
	<!-- /Footer--> 

	<!--Back to top-->
	<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
	<!--/Back to top--> 

	<!--Login-Form -->
	<?php include('includes/login.php');?>
	<!--/Login-Form --> 

	<!--Register-Form -->
	<?php include('includes/registration.php');?>

	<!--/Register-Form --> 

	<!--Forgot-password-Form -->
	<?php include('includes/forgotpassword.php');?>
	<!--/Forgot-password-Form --> 

	<!-- Scripts --> 
	<script src="assets/js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script> 
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

	<script src="assets/js/interface.js"></script> 
	<!--Switcher-->
	<script src="assets/switcher/js/switcher.js"></script>
	<!--bootstrap-slider-JS--> 
	<script src="assets/js/bootstrap-slider.min.js"></script> 
	<!--Slider-JS--> 
	<script src="assets/js/slick.min.js"></script> 
	<script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:26:12 GMT -->
</html>

<?php } ?>