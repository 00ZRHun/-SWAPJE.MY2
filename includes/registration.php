<?php
//error_reporting(0);
if (isset($_POST['signup'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO users(firstName,lastName,email,password) VALUES(:firstName,:lastName,:email,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $query->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Registration successfull. Now you can login');</script>" . $sql . $firstName . $lastName . $email;
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }
}
?>

<script>
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
    url: "check_availability.php",
    data:'email='+$("#email").val(),
    type: "POST",
    success:function(data){
    $("#user-availability-status").html(data);
    $("#loaderIcon").hide();
    },
    error:function (){}
    });
    }
</script>
<!-- <script type="text/javascript">
    function valid()
    {
    if(document.signup.password.value!= document.signup.confirmpassword.value)
    {
    alert("Password and Confirm Password Field do not match  !!");
    document.signup.confirmpassword.focus();
    return false;
    }
    return true;
  }
</script>
 -->
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Create An Account</h3>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form  method="post" name="signup">
                <div class="form-group">
                  <input type="text" class="form-control" name="firstName" placeholder="First Name" required="required">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="lastName" placeholder="Last Name" required="required">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" onBlur="checkAvailability()" placeholder="Email" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>

                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>

                <div class="form-group">
                  <label for="terms_agree">By signing up, you agree with the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></label>
                </div>

                <div class="form-group text-center" id="whiteBtn">
                  <a href="#loginform" data-toggle="modal" data-dismiss="modal">
                    <input value="Already have an account?" class="btn btn-block">
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="form-group modal-footer text-center" style="width:100%; "> -->
      <!-- <div class="modal-footer text-center">
        <a href="#loginform" data-toggle="modal" data-dismiss="modal">
          <input value="Already have an account?" class="btn btn-block">
        </a>
      </div> -->
    </div>
  </div>
</div>
