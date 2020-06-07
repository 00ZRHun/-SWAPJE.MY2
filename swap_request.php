<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang='en'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
    <meta name='keywords' content=''>
    <meta name='description' content=''>
    <title>Car Rental Port | Vehicle Details</title>
    <!--Bootstrap -->
    <link rel='stylesheet' href='assets/css/bootstrap.min.css' type='text/css'>
    <!--Custome Style -->
    <link rel='stylesheet' href='assets/css/style.css' type='text/css'>
    <!--OWL Carousel slider-->
    <link rel='stylesheet' href='assets/css/owl.carousel.css' type='text/css'>
    <link rel='stylesheet' href='assets/css/owl.transitions.css' type='text/css'>
    <!--slick-slider -->
    <link href='assets/css/slick.css' rel='stylesheet'>
    <!--bootstrap-slider -->
    <link href='assets/css/bootstrap-slider.min.css' rel='stylesheet'>
    <!--FontAwesome Font Style -->
    <link href='assets/css/font-awesome.min.css' rel='stylesheet'>

    <!-- SWITCHER -->
    <link rel='stylesheet' id='switcher-css' type='text/css' href='assets/switcher/css/switcher.css' media='all' />
    <link rel='alternate stylesheet' type='text/css' href='assets/switcher/css/red.css' title='red' media='all' data-default-color='true' />
    <link rel='alternate stylesheet' type='text/css' href='assets/switcher/css/orange.css' title='orange' media='all' />
    <link rel='alternate stylesheet' type='text/css' href='assets/switcher/css/blue.css' title='blue' media='all' />
    <link rel='alternate stylesheet' type='text/css' href='assets/switcher/css/pink.css' title='pink' media='all' />
    <link rel='alternate stylesheet' type='text/css' href='assets/switcher/css/green.css' title='green' media='all' />
    <link rel='alternate stylesheet' type='text/css' href='assets/switcher/css/purple.css' title='purple' media='all' />
    <link rel='apple-touch-icon-precomposed' sizes='144x144' href='assets/images/favicon-icon/apple-touch-icon-144-precomposed.png'>
    <link rel='apple-touch-icon-precomposed' sizes='114x114' href='assets/images/favicon-icon/apple-touch-icon-114-precomposed.html'>
    <link rel='apple-touch-icon-precomposed' sizes='72x72' href='assets/images/favicon-icon/apple-touch-icon-72-precomposed.png'>
    <link rel='apple-touch-icon-precomposed' href='assets/images/favicon-icon/apple-touch-icon-57-precomposed.png'>
    <link rel='shortcut icon' href='assets/images/favicon-icon/favicon.png'>
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet'>
</head>

<body>

    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php');
    ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include('includes/header.php');
    ?>
    <!-- /Header -->

    <!-- Content -->
    <section style='min-height: 100vh;' class='container'>

        <?php
        $user_sql = 'SELECT id FROM tblusers WHERE EmailId=:email';
        $user_query = $dbh->prepare($user_sql);
        $user_query->bindParam(':email', $_SESSION['login'], PDO::PARAM_STR);
        $user_query->execute();
        $user_results = $user_query->fetch();

        $user_id = $user_results['id'];

        $sql = "SELECT provider_id FROM swap_requests WHERE provider_id=:user_id";
        $receiver_sql = "SELECT receiver_id FROM swap_requests WHERE receiver_id=:user_id";

        $query = $dbh->prepare($sql);
        $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $query->execute();

        $query2 = $dbh->prepare($receiver_sql);
        $query2->bindParam(":user_id", $user_id);
        $query2->execute();

        if ($query->rowCount() > 0) {
            // As Provider

            require("./functions/Swap/get_swap_requests.php");
            require("./functions/User/user.php");
            require("./functions/Item/item.php");

            $results = get_requests_as_provider($user_id);

            foreach ($results as $result) {

                $receiver_item_ids = explode(", ", $result->receiver_item_id);
                $receiver_item_names = "";

                foreach ($receiver_item_ids as $id) {
                    $item = get_item_detail($id, $result->receiver_id);
                    $receiver_item_names .= $item["productName"] . " ";
                }

                $current_receiver = get_user_detail($result->receiver_id);
                $current_receiver_name = $current_receiver["FullName"];
                     
        ?>
                <p style="margin-bottom: 0; margin-top: 1em"><?php echo htmlentities($current_receiver_name); ?> wants to swap your <?php echo htmlentities($result->itemName); ?> with <?php echo htmlentities($receiver_item_names); ?></p>
                <a style='color: #000' href='item-details.php?vhid=<?php echo htmlentities($rResult->itemID) ?>'>View</a>
                <a id="accept-request-btn" data-requestID="<?php echo $result->id ?>" style='color: #000'>Accept</a>
                <a id="reject-request-btn" data-requestID="<?php echo $result->id ?>" style='color: #000'>Reject</a>
                <?php
            }
        }
        if ($query2->rowCount() > 0) {
            // As Receiver

            require("./functions/Swap/get_swap_requests.php");
            require("./functions/User/user.php");
            require("./functions/Item/item.php");

            $results = get_requests_as_receiver($user_id);            

            foreach ($results as $result) {                

                $receiver_item_ids = explode(", ", $result->receiver_item_id);
                $receiver_item_names = "";

                $provider_item = get_item_detail($result->item_id, $result->provider_id);
                $provider_item_name = $provider_item["productName"];

                foreach ($receiver_item_ids as $id) {
                    $item = get_item_detail($id, $result->receiver_id);
                    $receiver_item_names .= $item["productName"] . " ";
                }

                $current_provider = get_user_detail($result->provider_id);                
                $current_provider_name = $current_provider["FullName"];
                
                ?>
                    <p style="margin-bottom: 0; margin-top: 1em;">You want to swap <?php echo htmlentities($receiver_item_names) ?> with <?php echo htmlentities($current_provider_name) ?>'s <?php echo htmlentities($provider_item_name) ?></p>
                    <strong>
                        <?php if ($result->status == -1) {
                            echo "REJECTED";
                        } ?>
                        <?php if ($result->status == 1) {
                            echo "ACCEPTED";
                        } ?>
                        <?php if ($result->status == 0) {
                            echo "PENDING";
                        } ?>
                    </strong>
        <?php                
            }
        }
        ?>
    </section>
    <!-- /Content -->

    <!--Footer -->
    <?php include('includes/footer.php');
    ?>
    <!-- /Footer-->

    <!--Back to top-->
    <div id='back-top' class='back-top'>
        <a href='#top'>
            <i class='fa fa-angle-up' aria-hidden='true'></i>
        </a>
    </div>
    <!--/Back to top-->

    <!--Login-Form -->
    <?php include('includes/login.php');
    ?>
    <!--/Login-Form -->

    <!--Register-Form -->
    <?php include('includes/registration.php');
    ?>
    <!--/Register-Form -->

    <!--Forgot-password-Form -->
    <?php include('includes/forgotpassword.php');
    ?>

    <script src='assets/js/jquery.min.js'></script>

    <!-- Logics -->
    <script src='js/swap/swap.js'></script>

    <script src='assets/js/bootstrap.min.js'></script>
    <script src='assets/js/interface.js'></script>
    <script src='assets/switcher/js/switcher.js'></script>
    <script src='assets/js/bootstrap-slider.min.js'></script>
    <script src='assets/js/slick.min.js'></script>
    <script src='assets/js/owl.carousel.min.js'></script>

</body>

</html>