<?php
include("../config/config.php");

// PAYMENT CONFIRM
if (isset($_GET["payment_confirm_id"])) {
    $payment_confirm = $db->query("UPDATE `add_property` SET `booked`='Yes' WHERE `property_id` = '{$_GET["payment_confirm_id"]}'");

    if ($payment_confirm) {
        echo "<script>window.alart('Payment Accept')</script>";
        echo "<script>window.open('owner-index.php', '_self')</script>";
    }
}

// PAYMENT CANCEL
if (isset($_GET["payment_cancel_id"])) {
    $payment_cancel = $db->query("UPDATE `add_property` SET `booked`='No' WHERE `property_id` = '{$_GET["payment_cancel_id"]}'");

    if ($payment_cancel) {
        
        $booking_cancel = $db->query("DELETE FROM `booking` WHERE  `property_id` = '{$_GET["payment_cancel_id"]}'");

        if($booking_cancel) {
            echo "<script>window.alart('Payment Cancel')</script>";
            echo "<script>window.open('owner-index.php', '_self')</script>";
        }

    }
}
// PAYMENT BACK CONFIRM
// if (isset($_GET["payment_back_confirm_id"])) {
//     $payment_back_confirm = $db->query("UPDATE `add_property` SET `booked`='No' WHERE `property_id` = '{$_GET["payment_back_confirm_id"]}'");

//     if ($paymenpayment_back_confirmt_confirm) {

//         $booking_cancel = $db->query("DELETE FROM `booking` WHERE  `property_id` = '{$_GET["payment_back_confirm_id"]}'");

//         if($booking_cancel) {
//             echo "<script>window.alart('Payment Back Successful')</script>";
//             echo "<script>window.open('owner-index.php', '_self')</script>";
//         }
//     }
// }
// PAYMENT BACK CANCEL
// if (isset($_GET["payment_back_cancel_id"])) {
//     $payment_confirm = $db->query("UPDATE `add_property` SET `booked`='Yes' WHERE `property_id` = '{$_GET["payment_back_cancel_id"]}'");

//     if ($payment_confirm) {
//         echo "<script>window.alart('Payment Back Request Cancel')</script>";
//         echo "<script>window.open('owner-index.php', '_self')</script>";
//     }
// }
