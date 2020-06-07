<?php

function get_item_detail($id, $user_id) {

    include('includes/config.php');
    
    $sql = "SELECT * FROM tblpostitem WHERE id = :id AND user_id = :user_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch();

    return $result;
}

?>