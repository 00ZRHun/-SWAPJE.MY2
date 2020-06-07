<?php
    session_start();
    include('includes/config.php');
    error_reporting(0);
?>
<?php
        $user_sql = 'SELECT id, FullName FROM tblusers WHERE EmailId=:email';
        $user_query = $dbh->prepare($user_sql);
        $user_query->bindParam(':email', $_SESSION['login'], PDO::PARAM_STR);
        $user_query->execute();
        $user_results = $user_query->fetch();

		// $user_id = $user_results['id'];
?>
    <h1>
        <?= $user_results['id']; ?>
        <?= $user_results['FullName']; ?>
    </h1>

<?php
	$item_sql = "SELECT * FROM tblpostitem WHERE id=:id";        
	$item_query = $dbh->prepare($user_sql);
	$item_query->bindParam(':id', $editId, PDO::PARAM_STR);
	$item_query->execute();
	$item_results = $item_query->fetch();

echo 	

	// security
	// $id = $item_results["user_id"];
	$productName = $item_results["productName"];
	$usedYear = $item_results["usedYear"];
	$overview = $item_results["overview"];
	$sell = $item_results["sell"];
	$rent = $item_results["rent"];
	$swap = $item_results["swap"];
	$totalPrice = $item_results["totalPrice"];
	$pricePerDay = $item_results["pricePerDay"];
	$value = $item_results["value"];
	$payPalBusinessAccount = $item_results["payPalBusinessAccount"];
	$contactNo = $item_results["contactNo"];
	$Vimage1 = $item_results["Vimage1"];
	$Vimage2 = $item_results["Vimage2"];
	$Vimage3 = $item_results["Vimage3"];
	$Vimage4 = $item_results["Vimage4"];
	$Vimage5 = $item_results["Vimage5"];
?>	

	<h1>
	
	</h1>