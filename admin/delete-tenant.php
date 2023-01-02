<?php
include("../config/config.php");


// DELETE OWNER 
if (isset($_GET['id'])) {

    $tenant = $db->query("SELECT * FROM tenant WHERE tenant_id = '{$_GET['id']}'");
    $tenantR = mysqli_fetch_assoc($tenant);
    $tenantRand = $tenantR["tenant_rand_id"];

    $deleteMessage = $db->query("DELETE FROM message WHERE (`send_id` = '$tenantRand') || (`receive_id` = '$tenantRand')");

    $deleteBooking = $db->query("DELETE FROM booking WHERE `tenant_id` = '{$_GET['id']}'");

    $deleteReview = $db->query("DELETE FROM review WHERE `review_sender_id` = '{$_GET['id']}'");

    $query = $db->query("DELETE FROM tenant WHERE `tenant_id` = '{$_GET['id']}'");
    if ($query) {
        header("location:admin-index.php");
    }
}
