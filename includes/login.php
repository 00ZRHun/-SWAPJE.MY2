<?php

require ("envinronment.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT email,password,firstName,lastName FROM users WHERE email=:email and password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['login'] = $_POST['email'];
        // full name
        $_SESSION['firstname'] = $results->FullName;
        $currentpage = $_SERVER['REQUEST_URI'];
        echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=3023285394418002&autoLogAppEvents=1"></script>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">
            &times;
          </span>
        </button>
        <h3 class="modal-title">Sign In with Email</h3>        
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
<!-- ???? -->
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Sign In" class="btn btn-block">
                </div>
                <br><br>
                <div class="form-group text-center" id="whiteBtn" style="color: black; background-color: white;">
                  <a href="#signupform" data-toggle="modal" data-dismiss="modal">
                    <input value="Need an account?" class="btn btn-block">
                  </a>
                </div>

                <div class="form-group text-center" id="whiteBtn" style="color: black; background-color: white;">                                                                      
                  <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>
                </div>
                <div class="form-group text-center" id="whiteBtn" style="color: black; background-color: white;">
                  <a href="#" data-toggle="modal" data-dismiss="modal">
                  <input value="T     Continue with Twitter" class="btn btn-block">
                  </a>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- <div class="modal-footer text-center">
        <p>Don't have an account? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Signup Here</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Forgot Password ?</a></p>
      </div> -->
    </div>
  </div>
</div>


<script>

  // console.log("<?php htmlentities($_ENV["FB_APP_ID_TEST"]) ?>")

  function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });
  }

  function statusChangeCallback(res) {
    console.log(res)
  }
  
  window.fbAsyncInit = function() {
    FB.init({
      appId      : "<?php echo htmlentities($_ENV["FB_APP_ID_TEST"]) ?>",
      cookie     : true,
      xfbml      : true,
      version    : 'v7.0'
    });
      
    FB.AppEvents.logPageView(); 

    FB.Event.subscribe('auth.authResponseChange', function(response) 
    {
     if (response.status === 'connected') 
    {
        console.log("<br>Connected to Facebook");
        //SUCCESS
        FB.api('/me', { locale: 'en_US', fields: 'name, email,birthday, hometown,education,gender,website,work' },
          function(response) {            
            console.log(response.email);
            console.log(response.name); 

            if(response.name === null || response.email === null)
              return alert("Sign in with fb failed. Please try again.");
            
            const firstName = response.name.slice(0, 1);
            const lastName = response.name.slice(1, response.name.length);            
                     
            $.ajax({
                method: "POST",
                url: "functions/User/login_with_third_party.php",
                dataType: "json",
                data: {
                    firstName, 
                    lastName,
                    email: response.email
                },
                success: (data) => {
                  
                    if (data.code == "200")                                                                  
                       document.location = "<?php echo htmlentities($_SERVER['REQUEST_URI']) ?>";
                                          
                },
                error: (err) => {
                    console.log(err.msg)
                    alert("Something went wrong. Please try again.");
                }
            });     
          }
        );

    }    
    else if (response.status === 'not_authorized') 
    {
        console.log("Failed to Connect");

        //FAILED
    } else 
    {
        console.log("Logged Out");

        //UNKNOWN ERROR
    }})
    
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
        
  };
  

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
</script>

