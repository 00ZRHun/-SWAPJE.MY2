<?php

function get_requests_as_provider($provider_id)
{

    include('includes/config.php');

    // Provider's item data
    $sql = "SELECT sr.*, item.productName as itemName, item.id as itemID
            FROM swap_requests as sr 
            JOIN tblpostitem as item
            ON item.id = sr.item_id
            WHERE sr.status = 0 AND sr.provider_id = :provider_id";

    $query = $dbh->prepare($sql);
    $query->bindParam(':provider_id', $provider_id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    return $results;
}

function get_requests_as_receiver($receiver_id)
{

    include('includes/config.php');

    $sql = "SELECT sr.*, item.productName as itemName, item.id as itemID, sr.receiver_item_id
            FROM swap_requests as sr 
            JOIN tblpostitem as item
            ON item.id = sr.item_id
            WHERE sr.receiver_id = :receiver_id";

    $query = $dbh->prepare($sql);
    $query->bindParam(':receiver_id', $receiver_id, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    return $results;
}

?>
