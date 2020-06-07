<!-- Booking Form -->
<?php 
  session_start();
  include('includes/config.php');
  error_reporting(0);

  if(isset($_POST['submit']))
  {
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate']; 
    $message=$_POST['message'];
    $useremail=$_SESSION['login'];
    $status=0;
    $vhid=$_GET['vhid'];
    $sql="INSERT INTO tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status)
     VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
    $query = $dbh->prepare($sql);

    $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
    $query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
    $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
    $query->bindParam(':todate',$todate,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();

    if($lastInsertId)
    {
      echo "<script>alert('Booking successfull.');</script>";
    }
    else 
    {
      echo "<script>alert('Something went wrong. Please try again');</script>";
    }

  }
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Car Rental Port | Vehicle Details</title>
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
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->
  <!-- get data from tblpostitem -->
<?php 
  $vhid=intval($_GET['vhid']);
  /* $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid
   from tblvehicles join tblbrands
   on tblbrands.id=tblvehicles.VehiclesBrand
   where tblvehicles.id=:vhid"; */
  $sql = "SELECT * from tblpostitem where id=:vhid AND delmode=0";
  $query = $dbh -> prepare($sql);
  $query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $cnt=1;
  if($query->rowCount() > 0)
  {
    foreach($results as $result)
    {  
      $_SESSION['brndid']=$result->bid;  
      $providerID = $result->user_id; 
?>
<h1></h1>  
<section id="listing_img_slider">
  <div><?= $providerID ?></div>
  <div><img src="img/itemImages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="img/itemImages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="img/itemImages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="img/itemImages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
  
  <?php
   if($result->Vimage5=="")
    {

    } else {
  ?>

    <div>
      <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560">
    </div>
  
  <?php
   } 
  ?>

</section>
<!--/Listing-Image-Slider-->


<!-- body -->
  <!-- php global variable -->
<?php
  $name = $result->productName;
?>
  <!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <!-- row 1( name, title, price ) -->
    <div class="listing_detail_head row">
      <!-- col 1( name, title ) -->
      <div class="col-md-9">
        <h2>
          <?php echo htmlentities($name);?> , <?php echo htmlentities($result->usedYear);?> Used Years
        </h2>
      </div>
      <!-- col 2( price ) -->
      <div class="col-md-3">
        <div class="price_info">
          <!-- <p>$<?php echo htmlentities($result->PricePerDay);?> </p>Per Day -->
        </div>
      </div>
    </div>

    <!-- row 2( main feature, tabs ) -->
    <div class="row">
      <div class="col-md-9">
        <!-- main feature -->
        <!-- <div class="main_features">
          <ul>
            <li>
              <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->ModelYear);?></h5>
              <p>Reg.Year</p>
            </li>
            <li>
              <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->FuelType);?></h5>
              <p>Fuel Type</p>
            </li>
            <li>
              <i class="fa fa-user-plus" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->SeatingCapacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
        </div> -->
        <div class="main_features">
              <?php echo htmlentities($result->overview);?>
        </div>

        <!-- tabs( overview, accessories) -->
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
          <!-- 1) -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <!--  -->
              <!--  -->
              <!--  -->
              <!--  -->
              <!-- <div class="active">
                <li role="presentation" class="col-md-4">
                  <a href="#sell" aria-controls="sell" role="tab" data-toggle="tab">
                    Sell
                  </a>
                </li>
              </div> -->
              <!--  -->
              <!--  -->

              <!-- SELL -->
              <?php 
                if($result->sell == 1){ 
              ?>
                <!-- Sell -->
                <li role="presentation" class="active col-md-4">
                  <a href="#sell" aria-controls="sell" role="tab" data-toggle="tab">
                    Sell
                  </a>
                </li>

                <!-- Rent -->
                <?php 
                  if($result->rent == 1){ 
                ?>
                  <li role="presentation" class="col-md-4">
                    <a href="#rent" aria-controls="rent" role="tab" data-toggle="tab">
                      Rent
                    </a>
                  </li>
                <?php 
                  }
                ?>

                <!-- Swap -->
                <?php 
                  if($result->swap == 1){ 
                ?>
                  <li role="presentation" class="col-md-4">
                    <a href="#swap" aria-controls="swap" role="tab" data-toggle="tab">
                      Swap
                    </a>
                  </li>
                <?php 
                  }
                ?>             

            </ul>
            
          <!-- 2) -->
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- SELL -->
              <?php 
                if($result->sell == 1){ 
              ?>
                <!-- Sell -->
                <div role="tabpanel" class="tab-pane active" id="sell">
                  <p>
                    <!-- Sell
                    <?php echo htmlentities($result->overview);?> -->
                    <!--  -->
                    <!-- payment( PayPal ) -->
                    <div id="payment-box">
                            <!-- <img src="images/camera.jpg" /> -->
                            <h4 class="txt-title">
                              Product Name : 
                              <?php echo htmlentities($name);?>
                            </h4>
                            <div class="txt-price">
                              Total Price : 
                              RM<?php echo htmlentities($result->totalPrice);?>
                            </div>
                            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"
                                method="post" target="_top">
                                <input type='hidden' name='business' value='<?php echo htmlentities($result->payPalBusinessAccount);?>'> 
                                <input type='hidden' name='item_name' value='<?php echo htmlentities($name);?>'>
                                <input type='hidden' name='item_number' value='<?php echo htmlentities($name . '#1');?>'> 
                                <input type='hidden' name='amount' value='<?php echo htmlentities($result->totalPrice);?>'>
                                <input type='hidden' name='no_shipping' value='1'> 
                                <input type='hidden' name='currency_code' value='MYR'> 
                                <input type='hidden' name='notify_url'
                                    value='http://localhost:8888/paypal-payment-gateway-integration-in-php/notify.php'>
                                <input type='hidden' name='cancel_return'
                                    value='http://localhost:8888/paypal-payment-gateway-integration-in-php/cancel.php'>
                                <input type='hidden' name='return'
                                    value='http://localhost:8888/Renting%20System/SellRentSwap_System/return.php'>
                                <input type="hidden" name="cmd" value="_xclick">

                                <input
                                    type="submit" name="pay_now" id="pay_now"
                                    Value="Pay Now"
                                >
                            </form>
                    </div>
                    <!--  -->
                  </p>
                </div>                

              <!-- RENT -->
              <?php 
                } if($result->rent == 1){ 
              ?>
                <div role="tabpanel" class="tab-pane active" id="rent">
                  <p>
                    <!-- <?php echo htmlentities($result->VehiclesOverview);?> -->
                  </p>
                  <!--  -->
                  <!-- payment( PayPal ) -->
                  <div id="payment-box">
                      <!-- <img src="images/camera.jpg" /> -->
                      <h4 class="txt-title">
                        Product Name : 
                        <?php echo htmlentities($name);?>
                      </h4>
                      <div class="txt-price">
                        Price Per Day : 
                        RM<?php echo htmlentities($result->pricePerDay);?>
                      </div>
                      
                      <div>
                        <form name="form" action="" method="get">
                            <!-- <input type="text" name="subject" id="subject" value="Car Loan"> -->
                            <input type='hidden' name='vhid' value='<?= $_GET['vhid']; ?>'> 
                            <input type='number' name='rentDay' value='0'>
                            <button type="submit">Check Price</button>
                        </form>

                        <!-- <?php echo $_GET['rentDay']; ?> -->
                        <input type='number' name='amount' value='<?php echo htmlentities((float)($result->pricePerDay) * (float)($_GET['rentDay']));?>'>
                      </div>
                      
                      <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"
                          method="post" target="_top">
                          <!-- <input type='hidden' name='vhid' value='<?= $_GET['vhid']; ?>'> 
                          <input type='number' name='rentDay' value='0'> -->

                          <input type='hidden' name='business' value='<?php echo htmlentities($result->payPalBusinessAccount);?>'> 
                          <input type='hidden' name='item_name' value='<?php echo htmlentities($name);?>'>
                          <input type='hidden' name='item_number' value='<?php echo htmlentities($name . '#N1');?>'> 
                          <!-- <input type='hidden' name='amount' value='<?php echo htmlentities((float)($result->pricePerDay) * (float)($_GET['rentDay']));?>'> -->
                          <input type='hidden' name='amount' value='<?php echo htmlentities((float)($result->pricePerDay) * (float)($_GET['rentDay']));?>'>
                          <input type='hidden' name='no_shipping' value='1'> 
                          <input type='hidden' name='currency_code' value='MYR'> 
                          <input type='hidden' name='notify_url'
                              value='http://localhost:8888/paypal-payment-gateway-integration-in-php/notify.php'>
                          <input type='hidden' name='cancel_return'
                              value='http://localhost:8888/paypal-payment-gateway-integration-in-php/cancel.php'>
                          <input type='hidden' name='return'
                              value='http://localhost:8888/Renting%20System/SellRentSwap_System/return.php'>
                          <input type="hidden" name="cmd" value="_xclick">

                          <!-- <button
                              type="submit" name="pay_now" id="pay_now"
                              value="Rent"
                          >
                            RENT
                          <button> -->
                          <button>RENT<button>
                      </form>
                  </div>
                  <!-- JQuery( btn trigger another btn ) -->
                  <script>
                    /* $( "button" ).first().click(function() {
                      update( $( "span" ).first() );
                    }); */
                    
                    $( "button" ).last().click(function() {
                      $( "button" ).first().trigger( "click" );
                      // update( $( "span" ).last() );
                    });
                    
                    /* function update( j ) {
                      var n = parseInt( j.text(), 10 );
                      j.text( n + 1 );
                    } */
                  </script>
                  <!--  -->
                </div>
                
              <?php 
                } if($result->swap == 1){ 
              ?>
                <div role="tabpanel" class="tab-pane" id="swap">                
                <p>         
                  <?php
                  $user_sql = "SELECT id FROM tblusers WHERE EmailId=:email";        
                  $user_query = $dbh->prepare($user_sql);
                  $user_query->bindParam(':email', $email, PDO::PARAM_STR);
                  $user_query->execute();
                  $user_results = $user_query->fetch();

                  $user_id = $user_results["id"];

                  $item_status = 1;
                  
                  $self_items_sql = "SELECT item.id as itemID, item.user_id, item.swap, item.productName, user.id
                          FROM tblpostitem as item 
                          JOIN tblusers as user
                          ON item.user_id = user.id
                          WHERE user_id = :user_id AND item.delmode = :item_status";
                    
                    $query = $dbh->prepare($self_items_sql);
                    $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                    $query->bindParam(':item_status', $item_status);
                    
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);                      
                    ?>
                    <h2>Item you have:</h2>
                    <input type="hidden" name="item_id" id="item_id" value="<?php echo $_GET['vhid'] ?>">
                    <input type="hidden" name="receiver_id" id="receiver_id" value="<?php echo htmlentities($user_id);?>">
                    <input type="hidden" name="provider_id" id="provider_id" value="<?php echo htmlentities($providerID);?>">
                    
                    <select name="receiver_item_id" id="receiver_item_id">
                      <?php
                      foreach ($results as $result) {                      
                      ?>
                        <option style="background: #346BE0; color: white; padding: 2em; border-radius: 15px;" value="<?php echo htmlentities($result->itemID) ?>"><?php echo htmlentities($result->productName) ?></option>
                      <?php
                      }
                      ?>
                    </select>                    
                  <button id="swap-with-owner-btn">Swap with owner</button>
                </p>
              </div>
              <?php
                }
              ?>


              <!--  -->
              
              <!-- Accessories -->
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Accessories</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>Air Conditioner</td>
                      <?php
                       if($result->AirConditioner==1)
                       {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else { 
                      ?> 
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>AntiLock Braking System</td>
                      <?php
                       if($result->AntiLockBrakingSystem==1)
                       {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else {
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>Power Steering</td>
                      <?php 
                        if($result->PowerSteering==1)
                        {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                      } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                      }
                      ?>
                    </tr>
                   
                    <tr>
                      <td>Power Windows</td>
                      <?php
                       if($result->PowerWindows==1)
                       {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else {
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>
                   
                    <tr>
                      <td>CD Player</td>
                      <?php
                        if($result->CDPlayer==1)
                        {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                        } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>Leather Seats</td>
                      <?php
                        if($result->LeatherSeats==1)
                        {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                        } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                        } 
                      ?>
                    </tr>

                    <tr>
                      <td>Central Locking</td>
                      <?php
                       if($result->CentralLocking==1)
                       {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>Power Door Locks</td>
                      <?php
                       if($result->PowerDoorLocks==1)
                       {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>Brake Assist</td>
                      <?php
                       if($result->BrakeAssist==1)
                       {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                        } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>Driver Airbag</td>
                      <?php
                       if($result->DriverAirbag==1)
                        {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>
                    
                    <tr>
                      <td>Passenger Airbag</td>
                      <?php
                       if($result->PassengerAirbag==1)
                        {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else {
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                    <tr>
                      <td>Crash Sensor</td>
                      <?php
                       if($result->CrashSensor==1)
                        {
                      ?>
                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php
                       } else { 
                      ?>
                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php
                       } 
                      ?>
                    </tr>

                  </tbody>
                </table>
              </div>

            </div>
          </div>
          
        </div>
      <?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
        <!-- row 1( share ) -->
        <div class="share_vehicle">
          <p>
            Share:
            <a href="#">
              <i class="fa fa-facebook-square" aria-hidden="true"></i>
            </a>
            <a href="#">
              <i class="fa fa-twitter-square" aria-hidden="true"></i>
            </a>
            <a href="#">
              <i class="fa fa-linkedin-square" aria-hidden="true"></i>
            </a>
            <a href="#">
              <i class="fa fa-google-plus-square" aria-hidden="true"></i>
            </a>
          </p>
        </div>

        <!-- row 2 -->
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5>
              <i class="fa fa-envelope" aria-hidden="true"></i>
              Book Now
            </h5>
          </div>
          <form method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" required>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" required>
            </div>

            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
            </div>

              <?php 
                if($_SESSION['login'])
                  {
              ?>

                <div class="form-group">
                  <input type="submit" class="btn"  name="submit" value="Book Now">
                </div>

              <?php
                } else { 
              ?>

                <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">
                  Login For Book
                </a>

              <?php
                } 
              ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 

    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!-- row 3( Similar-Cars )-->
    <div class="similar_cars">
      <h3>Similar Cars</h3>
      <div class="row">
        <?php 
          $bid=$_SESSION['brndid'];
          /* $sql="SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1
                from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand
                where tblvehicles.VehiclesBrand=:bid"; */
      // ????( filter )
          /* $sql="SELECT *
                from tblpostitem
                where tblvehicles.VehiclesBrand=:bid"; */
          $sql="SELECT * from tblpostitem";
          
          $query = $dbh -> prepare($sql);
          $query->bindParam(':bid',$bid, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;

          echo $results . $query->rowCount();

          if($query->rowCount() > 0)
          {
            foreach($results as $result)
            { 
        ?>      
          <div class="col-md-3 grid_listing">
            <div class="product-listing-m gray-bg">
              <!-- row 1( pic. ) -->
              <div class="product-listing-img">
                <a href="item-details.php?vhid=<?php echo htmlentities($result->id);?>">
                  <img src="img/itemImages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" />
                </a>
              </div>

              <!-- row 2( content. ) -->
              <div class="product-listing-content">
                <!-- row 1 -->
                <h5>
                  <a href="item-details.php?vhid=<?php echo htmlentities($result->id);?>">
                    <?php echo htmlentities($name);?>
                     , <?php echo htmlentities($result->usedYear);?> Years Used.
                  </a>
                </h5>

                <!-- row 2( price ) -->
                <p class="list-price">
                  <?php echo htmlentities(substr($result->overview,0,70));?>
                  
                </p>
            
                <!-- row 3( seat, model, fuel ) -->
                <!-- <ul class="features_list">
                  <li>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <?php echo htmlentities($result->SeatingCapacity);?>
                    seats
                  </li>
                  <li>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo htmlentities($result->ModelYear);?>
                    model
                  </li>
                  <li>
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <?php echo htmlentities($result->FuelType);?>
                  </li>
                </ul> -->
                <ul class="features_list">
                  <li>
                    <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
                    <b>Sell : </b>
                    <?php
                      if($result->sell == 1)
                      {
                    ?>
                      RM<?php echo htmlentities($result->totalPrice);?>
                    <?php
                      }
                      else
                      {
                    ?>
                      -
                    <?php
                      }
                    ?>
                  </li>
                  <li>
                    <!-- <i class="fa fa-calendar" aria-hidden="true"></i> -->
                    <b>Rent : </b>  
                    <?php
                      if($result->rent == 1)
                      {
                    ?>
                      RM<?php echo htmlentities($result->pricePerDay);?>
                    <?php
                      }
                      else
                      {
                    ?>
                      -
                    <?php
                      }
                    ?>
                  </li>
                  <li>
                    <!-- <i class="fa fa-car" aria-hidden="true"></i> -->
                    <b>Swap : </b>  
                    <?php
                      if($result->swap == 1)
                      {
                    ?>
                      RM<?php echo htmlentities($result->value);?>
                    <?php
                      }
                      else
                      {
                    ?>
                      -
                    <?php
                      }
                    ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        <?php
         }}
        ?>       
      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
  <!--/Listing-detail--> 
<!-- /body -->

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top">
  <a href="#top">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
  </a>
</div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php'); ?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php'); ?>
<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php'); ?>

<script src="assets/js/jquery.min.js"></script>

<!-- Logics -->
<script src="js/swap/swap.js"></script>

<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>