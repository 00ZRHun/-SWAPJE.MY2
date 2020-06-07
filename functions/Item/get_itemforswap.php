<?php        
    session_start();
    include('includes/config.php');
    error_reporting(0);

    if(isset($_POST['data'])) {
        echo "<script>alert(" . $_POST['data'] . ")</script>";
    }    

    $email = $_SESSION['login']; 
    $conn = new mysqli($dbh);    

    // Get user id    
    $user_sql = "SELECT id FROM tblusers WHERE EmailId=:email";        
    $user_query = $dbh->prepare($user_sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    echo $results;
    $user_id = $conn->query($user_sql);

    echo $user_id;

    $sql = "SELECT item.id, item.user_id, item.swap, user.id
            FROM tblpostitem as item 
            JOIN tblusers as user
            ON item.user_id = user.id
            WHERE user_id = $user_id"
?>