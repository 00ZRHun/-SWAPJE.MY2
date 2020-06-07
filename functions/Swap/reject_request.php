<?php     

    include('../../includes/config.php');
    session_start();
    error_reporting(0);    

    try {

        $swap_request_id = $_POST["swap_request_id"];  
    
        $user_sql = "SELECT id FROM tblusers WHERE EmailId=:email";        
        $user_query = $dbh->prepare($user_sql);
        $user_query->bindParam(':email', $_SESSION['login'], PDO::PARAM_STR);
        $user_query->execute();
        $user_results = $user_query->fetch();

        $user_id = $user_results["id"];
        $status = -1;

        $sql = "UPDATE swap_requests 
                SET status=:status
                WHERE provider_id=:provider_id AND id=:swap_request_id";    

        $request_sql = "SELECT * FROM swap_requests WHERE id=:swap_request_id";    
        $insert_record_sql = "INSERT INTO swap_records(user_id, item_id, receiver_id, provider_id, receiver_item_id, status) 
                            VALUES (:user_id, :item_id, :receiver_id, :provider_id, :receiver_item_id, :status)";

        // Update swap_request table
        $query = $dbh->prepare($sql);        
        $query->bindParam(':provider_id', intval($user_id), PDO::PARAM_INT);        
        $query->bindParam(':swap_request_id', intval($swap_request_id), PDO::PARAM_INT);        
        $query->bindParam(':status', $status, PDO::PARAM_INT); // 0 pending, 1 accept, -1 reject
        $query->execute();

        // Copy data from swap_request first
        $copy_query = $dbh->prepare($request_sql);             
        $copy_query->bindParam(':swap_request_id', $swap_request_id, PDO::PARAM_INT);                
        $copy_query->execute();
        $row_result = $copy_query->fetch();        

        // Added to swap_records table
        $newquery = $dbh->prepare($insert_record_sql);
        $newquery->bindParam(':receiver_item_id', $row_result["receiver_item_id"]);
        $newquery->bindParam(':user_id', $user_id);
        $newquery->bindParam(':receiver_id', intval($row_result["receiver_id"]), PDO::PARAM_INT);
        $newquery->bindParam(':provider_id', intval($row_result["provider_id"]), PDO::PARAM_INT);
        $newquery->bindParam(':item_id', intval($row_result["item_id"]), PDO::PARAM_INT);
        $newquery->bindParam(':status', intval($row_result["status"]), PDO::PARAM_INT); // 0 pending, 1 accept, -1 reject
        $newquery->execute();        

        echo json_encode(['code' => 200, 'msg' => "Success"]);
    } catch(exception $e) {
        echo json_encode(['code' => 400, 'msg' => "Error"]);
    }
