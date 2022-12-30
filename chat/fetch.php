<?php
include("../config/config.php");

if (isset($_POST["action"])) {

    $receiverId = $_POST["receiverId"];
    $senderEmail = $_POST["senderEmail"];

    $senderQ = $db->query("SELECT * FROM tenant WHERE email = '$senderEmail'");
    if ($senderQ) {
        $senderR = $senderQ->fetch_assoc();
        $senderId = $senderR["tenant_rand_id"];
    }

    $s = "SELECT * FROM message WHERE (send_id = '$senderId' && receive_id = '$receiverId') OR(send_id = '$receiverId' && receive_id = '$senderId') order by id";

    $q = $db->query($s);

    $output = "";

    while ($r = $q->fetch_assoc()) {

        if ($r["send_id"] === $senderId) {
            $output .= "<div class='outgoing-msg text-end'> <p>" . $r["send_text"] . "</p> </div>";
        } else {
            $output .= "<div class='imcomming-msg'> <p> " . $r["send_text"] . " </p> </div>";
        }
    }

    echo $output;
} else {
    echo 'ajax no';
}
