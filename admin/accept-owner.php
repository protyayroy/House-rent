<?php
include("../config/config.php");

// AEECPT OWNER REQUEST
if (isset($_GET['id'])) {
    $query = $db->query("UPDATE `owner` SET `status`='1' WHERE `owner_id` = '{$_GET['id']}'");
    if ($query) {
        header("location:admin-index.php");
    }
}

// CANCEL OWNER REQUEST
if (isset($_GET['cancel_id'])) {
    $query = $db->query("DELETE FROM owner WHERE `owner_id` = '{$_GET['cancel_id']}'");
    if ($query) {
        header("location:admin-index.php");
    }
}

// DELETE OWNER 
if (isset($_GET['delete_id'])) {

    $owner = $db->query("SELECT * FROM owner WHERE owner_id = '{$_GET['delete_id']}'");
    $ownerR = mysqli_fetch_assoc($owner);
    $ownerRand = $ownerR["owner_rand_id"];

    $deleteMessage = $db->query("DELETE FROM message WHERE (`send_id` = '$ownerRand') || (`receive_id` = '$ownerRand')");

    $ownerId = $db->query("SELECT * FROM add_property WHERE owner_id = '{$_GET['delete_id']}'");
    while($ownerRow = mysqli_fetch_assoc($ownerId)){

        $deleteBooking = $db->query("DELETE FROM booking WHERE `property_id` = '{$ownerRow['property_id']}'");

        $deleteProductImage = $db->query("DELETE FROM property_photo WHERE `property_id` = '{$ownerRow['property_id']}'");

        $deleteReview = $db->query("DELETE FROM review WHERE `property_id` = '{$ownerRow['property_id']}'");
    }

    $deleteProperty = $db->query("DELETE FROM add_property WHERE `owner_id` = '{$_GET['delete_id']}'");

    $query = $db->query("DELETE FROM owner WHERE `owner_id` = '{$_GET['delete_id']}'");
    if ($query) {
        header("location:admin-index.php");
    }
}
