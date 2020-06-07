<?php
	session_start();
	error_reporting(0);
	include('includes/config.php');

	if(strlen($_SESSION['login'])==0)
	{	
		header('location:index.php');
	}
	else
	{ 
		if(isset($_REQUEST['del'])){
			$delid=intval($_GET['del']);
			// $sql = "delete from tblvehicles SET id=:status WHERE id=:delid";
			$sql = "UPDATE ads SET delmode=1 WHERE id=:delid";
			$query = $dbh->prepare($sql);
			$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
			$query -> execute();
			$msg="Ads record deleted successfully";
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
	
	<title>SWAPJE.MY</title>

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
	<!-- Start Switcher -->
	<?php include('includes/colorswitcher.php');?>
	<!-- /Switcher -->  

	<!--Header-->
	<?php include('includes/header.php');?>
	<!-- /Header --> 

	<!-- Body -->
	<!-- <div class="ts-main-content" style="padding-top: 30px"> -->
	<div class="ts-main-content" style="padding-top: 90px; padding-bottom: 90px"> 
		<div class="container">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title text-center">Manage Ads</h2>

						<!-- Zero Configuration Table -->
						<!-- <div class="panel panel-default"> -->
						<div class="row">
							<h2 class="panel-heading" style="font-size: large; font-weight: 1000;">Ads Details</h2>
							
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
								<table id="zctb" class="text-center display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<!-- table header -->
									<thead>
										<tr>
											<th>#</th>
											<th>Ads</th>
											<th>Category</th>
											<th>Description</th>
											<th>Company Name</th>
											<th>PayPal Business Account</th>
											<th>Contact Nombor</th>
											<th>Action</th>
										</tr>
									</thead>

									<!-- table footer -->
									<tfoot>
										<tr>
											<th>#</th>
											<th>Ads</th>
											<th>Category</th>
											<th>Description</th>
											<th>Company Name</th>
											<th>PayPal Business Account</th>
											<th>Contact Nombor</th>
											<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<!-- table body -->
<h1><?= $id ?></h1>
									<?php 
										$sql = "SELECT * FROM ads WHERE userId=:userId AND delmode=0 ORDER BY updationDate DESC";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':userId', $id, PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
echo $sql . $id; 										
										if($query->rowCount() > 0){
											foreach($results as $result){
									?>
										<!-- html -->
									<tr>
										<td><?php echo htmlentities($cnt);?></td>
										<td>
											<?php echo htmlentities($result->title);?>
<!-- ??? -->
											<img src="img/adsImages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image">
										</td>
										<td><?php echo htmlentities($result->category);?></td>
										<td><?php echo htmlentities($result->description);?></td>
										<td><?php echo htmlentities($result->companyName);?></td>
										<td><?php echo htmlentities($result->payPalBusinessAccount);?></td>
										<td><?php echo htmlentities($result->contactNo);?></td>
										<td>
											<a href="edit-ads.php?id=<?php echo $result->id;?>">
												<i class="fa fa-edit"></i>
											</a>&nbsp;&nbsp;
											<a href="manage-ads.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">
												<i class="fa fa-close"></i>
											</a>
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
	<!-- /Body -->
	
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

	<script src="assets/js/interface.js"></script> 
	<!--Switcher-->
	<script src="assets/switcher/js/switcher.js"></script>
	<!--bootstrap-slider-JS--> 
	<script src="assets/js/bootstrap-slider.min.js"></script> 
	<!--Slider-JS--> 
	<script src="assets/js/slick.min.js"></script> 
	<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>

<?php } ?>