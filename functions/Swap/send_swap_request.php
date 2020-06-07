<?php     
    include('../../includes/config.php');
    session_start();
    error_reporting(0);

    // Get userID
    $user_sql = "SELECT id FROM tblusers WHERE EmailId=:email";        
    $user_query = $dbh->prepare($user_sql);
    $user_query->bindParam(':email', $_SESSION['login'], PDO::PARAM_STR);
    $user_query->execute();
    $user_results = $user_query->fetch();

    $user_id = $user_results["id"];    
    $status = 0;   

    try {
        // Get data from frontend
        $data_array = $_POST["datas"];    
        $data_length = count($data_array);                                   

        // Base sql
        $sql = "INSERT INTO swap_requests (user_id, item_id, receiver_id, receiver_item_id, provider_id, status) VALUES (:user_id, :item_id, :receiver_id, :receiver_item_id, :provider_id, :status);";        

        // Store receiver's items as string.
        $receiver_item_ids = "";

        // Append ids to receiver_item_ids string.
        for($i = 0; $i < $data_length; $i++) { 
                                                
            $receiver_item_ids .= $data_array[$i]["receiver_item_id"];
            
            if($i != $data_length - 1)
                $receiver_item_ids .= ", ";
                        
        }        

        // Parsed String to Int
        $receiver_id_int = intval($data_array[0]["receiver_id"]);
        $provider_id_int = intval($data_array[0]["provider_id"]);
        $item_id_int = intval($data_array[0]["item_id"]);

        // Prepare sql statements
        $query = $dbh->prepare($sql);
        $query->bindParam(':receiver_item_id', $receiver_item_ids, PDO::PARAM_STR);
        $query->bindParam(':receiver_id', $receiver_id_int, PDO::PARAM_INT);
        $query->bindParam(':provider_id', $provider_id_int, PDO::PARAM_INT);
        $query->bindParam(':item_id', $item_id_int, PDO::PARAM_INT);
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':status', $status, PDO::PARAM_INT); // 0 pending, 1 accept, -1 reject   
        $query->execute();
        
        echo json_encode(['code' => 200, 'msg' => "Success"]);
    } catch(exception $e) {
        echo json_encode(['code' => 400, 'msg' => "Error"]);
    }    
?>