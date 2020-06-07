<?php 
  session_start();
  include('includes/config.php');
  error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  
  <title>SWAP.ME</title>

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

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!-- Banners -->
<!-- <section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-5 col-md-push-7">
          <div class="banner_content">
            <h1>Find the right item for you.</h1>
            <p>We have more than a thousand items for you to choose. </p>
            <a href="page.php?type=aboutus" class="btn">
              Read More
              <span class="angle_arrow">
                <i class="fa fa-angle-right" aria-hidden="true"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- /Banners --> 

<div class="header_search">
  <!-- icon -->
  <div id="search_toggle">
    <i class="fa fa-search" aria-hidden="true"></i>
  </div>
  <!-- textbox -->
  <form action="index.php" method="post" id="header-search-form">
    <input type="text" placeholder="Search..." name="search" class="form-control">
    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
  </form>
  <!-- category -->
  <form action="index.php" method="post" id="categoryForm">
    <div class="col-sm-4">
      <select name="category" id="category" class="form-control" required onChange="submit()">
      <?php 
          $sql = "SELECT * FROM category WHERE delmode=0 ORDER BY name ASC";

          $query = $dbh -> prepare($sql);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          if($query->rowCount() > 0){
            foreach($results as $result){
        ?>									
          <option value="<?=$result->id;?>"><?=$result->name;?></option>
        <?php }} ?>
      </select>
    </div>
  </form>
  <?= $_POST['search']; ?>

</div>

<!-- Body -->
  <!-- Resent Cat-->
<section class="section-padding gray-bg">
  <div class="container">
    <!-- row 1( descritption ) -->
    <div class="section-header text-center">
      <h2>Find the Best <span>ItemForYou</span></h2>
      <p>
        There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
      </p>
    </div>
    
    <div class="row">    
      <!-- row 2( new car btn ) -->
        <!-- Nav tabs -->
      <!-- <a href="#resentnewcar"> -->
        <div class="recent-tab">
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
              <!-- data-toggle="tab"/"modal" -->
              <!-- <a href="#resentnewcar" role="tab" data-toggle="tab" data-dismiss="tab"> -->
              <!-- <a href="#resentnewcar" role="tab" data-toggle="tab"> -->
              <a href="#latestItem" role="tab" style="cursor:pointer;">
                Latest Item
              </a>
            </li>
          </ul>
        </div>
      <!-- </a> -->
        
      <!-- row 3( car list ) -->
        <!-- Recently Listed New Cars -->

      <div class="tab-content">
        <!-- <div role="tabpanel" class="tab-pane active" id="resentnewcar"> -->
        <div id="latestItem">

          <?php 
            if(isset($_REQUEST['category'])){
              $sql = "SELECT * from items WHERE delmode=0 AND category=:category ORDER BY updationDate DESC";
              $category = $_POST['category'];
              $query = $dbh -> prepare($sql);
              $query->bindParam(':category',$category,PDO::PARAM_STR);
            }else if(isset($_REQUEST['search'])){
              // $sql = "SELECT * from items WHERE delmode=0 AND productName LIKE '%:search%' ORDER BY updationDate DESC";
              $sql = "SELECT * from items WHERE delmode=0 AND productName LIKE :search ORDER BY updationDate DESC";
              $search = '%'.$_POST['search'].'%';
              $query = $dbh -> prepare($sql);
              $query->bindParam(':search',$search,PDO::PARAM_STR);
            }else{
              // $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
              $sql = "SELECT * from items WHERE delmode=0 ORDER BY updationDate DESC";
              $query = $dbh -> prepare($sql);
            }
            
            
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            $cnt=1;
            echo $sql . $_POST['search'] . $_POST['category'];
            if($query->rowCount() > 0)
            {
              foreach($results as $result)
              {  
          ?>  

          <div class="col-list-3">
            <div class="recent-car-list">
              <div class="car-info-box">
                <a href="item-details.php?vhid=<?php echo htmlentities($result->id);?>">
                  <img src="img/itemImages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image">
                </a>
                
                <!-- <ul>
                  <li>
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <?php echo htmlentities($result->productName);?>
                  </li>
                  <li>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo htmlentities($result->usedYear);?>
                    Model
                  </li>
                  <li>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo htmlentities($result->SeatingCapacity);?>
                    seats
                  </li>
                </ul> -->
                <ul>
                  <li>
                    <!-- <i class="fa fa-car" aria-hidden="true"></i> -->
                    Sell : 
                    <?php 
                      if($result->sell == 1)
                      { 
                    ?>
                      RM
                    <?php 
                        echo htmlentities($result->totalPrice);
                      }
                      else
                      {
                    ?>
                      N/A
                    <?php
                      }
                    ?>
                  </li>
                  
                  <li>
                    <!-- <i class="fa fa-calendar" aria-hidden="true"></i> -->
                    Rent : 
                    <!--  -->
                    <?php 
                      if($result->rent == 1)
                      { 
                    ?>
                      RM
                    <?php 
                        echo htmlentities($result->pricePerDay);
                      }
                      else
                      {
                    ?>
                      N/A
                    <?php
                      }
                    ?>
                    <!--  -->
                  </li>

                  <li>
                    <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
                    Swap : 
                    <!--  -->
                    <?php 
                      if($result->swap == 1)
                      { 
                    ?>
                      RM
                    <?php 
                        echo htmlentities($result->value);
                      }
                      else
                      {
                    ?>
                      N/A
                    <?php
                      }
                    ?>
                    <!--  -->
                  </li>
                </ul>
              </div>

              <div class="car-title-m">
                <h6>
                  <a href="item-details.php?vhid=<?php echo htmlentities($result->id);?>">
                    <!-- , <?php echo htmlentities($result->VehiclesTitle);?> -->
                    <?php echo htmlentities($result->productName);?>
                  </a>
                </h6>
                
                <span class="price">
                  <?php echo htmlentities($result->usedYear);?> Year Used
                </span> 
              </div>

              <div class="inventory_info_m">
                <p>
                  <?php 
                    echo substr($result->overview,0,70);
                  ?>
                </p>
              </div>
            </div>
          </div>

          <?php
          }}
          ?>
       
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- /Resent Cat --> 
<!-- /Body -->

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
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>