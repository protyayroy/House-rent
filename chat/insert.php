<?php

include("../config/config.php");

if (isset($_POST["message"])) {

    $message = $_POST["message"];
    if (!empty($message)) {

        $receiverId = $_POST["receiverId"];
        $senderEmail = $_POST["senderEmail"];

        $senderQ = $db->query("SELECT * FROM tenant WHERE email = '$senderEmail'");
        if ($senderQ) {
            $senderR = $senderQ->fetch_assoc();
            $senderId = $senderR["tenant_rand_id"];
        }

        $s = "INSERT INTO `message`(`send_id`, `receive_id`, `send_text`) VALUES ('$senderId','$receiverId','$message')";
        if ($db->query($s)) {
            echo true;
        }
    } else {
        echo false;
    }
}
