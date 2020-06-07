<header>
  <!-- header -->
  <div class="default-header">
    <div class="container">
      <div class="row">
        <!-- logo -->
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img src="assets/images/logo.png" alt="logo"/></a> </div>
        </div>

        <!-- info -->
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
              <p class="uppercase_text">For Support Mail us :</p>
              <a href="mailto:00ZRHun@gmail.com">00ZRHun@gmail.com</a>
            </div>

            <div class="header_widgets">
              <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
              <p class="uppercase_text">Service Helpline Call Us:</p>
              <a href="tel:601110604061">+6011-1060 4061</a>
            </div>

            <div class="social-follow">
            </div>

            <!-- status( login/register ) -->
            <?php   
                if(strlen($_SESSION['login'])==0){	
              ?>
                <div class="login_btn">
                  <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">
                    Login / Register
                    <?php
                      $email=$_SESSION['login'];
                      // echo "</br>".$email;
                    ?>
                  </a>
                </div>
              <?php
                }else{ 
                  echo "Welcome To Car rental portal";
                  /* $email=$_SESSION['login'];
                  echo "</br>".$email."abc"; */
              } 
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
          <span class="sr-only">
            Toggle navigation
          </span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="header_wrap">
        <div class="user_login">
          <?php if($_SESSION['login']){?>
            <ul>
              <li class="dropdown">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle" aria-hidden="true"></i> 
                  <?php 
                    $email=$_SESSION['login'];
                    $sql ="SELECT id, FullName FROM tblusers WHERE EmailId=:email ";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':email', $email, PDO::PARAM_STR);
                    $query-> execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    // $id = $results->id;
                    // echo $results->id;
                    $id = 100;
                    // echo $results->id;
                    // echo "ancad";
                    // echo $email;

                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                        {
                          echo htmlentities($result->FullName);

                          // GLOBAL VARIABLE( id )
                          $id = $result->id;
                        }
                    }

                    // echo $id;
                  ?>
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>

                <!-- dropdown menu( login/- ) -->
                <ul class="dropdown-menu">
                  <?php if($_SESSION['login']){?>
                    <li><a href="profile.php">Profile Settings</a></li>
                    <li><a href="update-password.php">Update Password</a></li>
                    <li><a href="my-booking.php">My Booking</a></li>
                    <li><a href="post-testimonial.php">Post a Testimonial</a></li>
                    <li><a href="my-testimonials.php">My Testimonial</a></li>
                    <li><a href="swap_request.php">Requests</a></li>
                    <li><a href="swap_records-listing.php">Records</a></li>                  
                    <li><a href="logout.php">Sign Out</a></li>                  
                  <?php } else { ?>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Login</a></li>
                    <!-- <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Booking</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Post a Testimonial</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Testimonial</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li> -->
                  <?php } ?>
                </ul>
              </li>
            </ul>
          <?php }else{ ?>
            <ul>
              <li class="dropdown">
                  <a href="#loginform" data-toggle="modal" data-dismiss="modal" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle" aria-hidden="true"></i> 
                  </a>
              </li>
            </ul>
          <?php } ?>
        </div>

        <!-- search( icon & textbox ) -->
        <div class="header_search">
          <!-- icon -->
          <div id="search_toggle">
            <i class="fa fa-search" aria-hidden="true"></i>
          </div>
          <!-- textbox -->
          <form action="#" method="get" id="header-search-form">
            <input type="text" placeholder="Search..." class="form-control">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
      </div>

      <!-- navbat -->
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="page.php?type=aboutus">About Us</a></li>
          <li><a href="car-listing.php">Car Listing</a>
          <!-- <li><a href="post-item.php">Post Item</a> -->
          <li><a href="page.php?type=faqs">FAQs</a></li>
          <li><a href="contact-us.php">Contact Us</a></li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Post
            </a>

            <!-- dropdown menu( login/- ) -->
            <ul class="dropdown-menu">
              <?php if($_SESSION['login']){?>
                <li><a href="post-item.php">Post Item Settings</a></li>
                <li><a href="manage-item.php">Manage Item</a></li>              
              <?php } else { ?>
                <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Login</a></li>
                <!-- <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
                <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
                <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Booking</a></li>
                <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Post a Testimonial</a></li>
                <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Testimonial</a></li>
                <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li> -->
              <?php } ?>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end --> 
  
</header>