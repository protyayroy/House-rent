<?php
include("../config/config.php");
session_start();

if (!isset($_SESSION["email"])) {
    echo "<script>window.open('login.php', '_self')</script>";
} else {
    if (isset($_POST["owner_id"])) {
        $userEmail = $_SESSION["email"];
        $owner_id = $_POST["owner_id"];

        if (isset($_POST["property_id"])) {
            $property_id = $_POST["property_id"];
        } else {
            $property_id = "";
        }

        $sql = "SELECT * FROM owner WHERE owner_id = '$owner_id'";
        if ($query = $db->query($sql)) {
            $userRow = mysqli_fetch_assoc($query);
            $receiverId = $userRow['owner_rand_id'];
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- css link file -->
        <link rel="stylesheet" href="chat-css-js/bootstrap.min.css">
        <link rel="stylesheet" href="chat-css-js/style.css">

        <title>Chat Box</title>
    </head>

    <body>

        <section>
            <div class="container">
                <div class="row">
                    <!-- <form action="#" method="POST"> -->
                    <div class="col-md-8 m-auto main-page">
                        <div class="user-account">
                            <div class="logout">
                                <?php
                                if ($property_id != "") {
                                ?>
                                    <a href="../view-property.php?property_id=<?= $property_id ?>" class="btn btn-warning" style="color: #fff; width:15%"> back</a>
                                <?php } ?>
                            </div>
                        </div>

                        <form action="" method="POST" id="chat">
                            <div class="chat-body">

                            </div>
                        </form>

                        <div class="sent-body">
                            <form action="" method="post" class=" d-flex justify-content-space-between" id="sent-body">
                                <input type="text" id="sender_email" value="<?= $userEmail; ?>" hidden>
                                <input type="text" id="receiver_id" value="<?= $receiverId; ?>" hidden>
                                <input type="text" class="form-control" id="msg" style="margin-left:12px;width: 80%;height:40px">
                                <button type="btton" class="btn btn-success ms-3" id="sent" style="width: 15%;">sent</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    <?php } ?>

    <script src="chat-css-js/jquery-1.12.4.min.js"></script>
    <script src="chat-css-js/popper.min.js"></script>
    <script src="chat-css-js/bootstrap.min.js"></script>

    <script src="js/script.js"></script>

    <script>
        $(document).ready(function() {

            setInterval(function() {
                loadMsg()
            }, 500);

            function scrollToBottom() {
                var scroll = document.getElementById('chat');
                scroll.scrollTop = scroll.scrollHeight;
            };

            $("#chat").on("mouseenter", function() {
                $(".chat-body").addClass("active");
            });

            $(window).on("click", function() {
                $(".chat-body").removeClass("active");
            });
            const form = document.querySelector(".typing-area"),
                chatBox = document.querySelector(".chat-body");

            function loadMsg() {

                var active = $(".active");
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        action: "action",
                        senderEmail: $("#sender_email").val(),
                        receiverId: $("#receiver_id").val()
                    },
                    success: function(data) {
                        $(".chat-body").html(data);

                        if (!chatBox.classList.contains("active")) {
                            scrollToBottom();
                        }
                    }
                })
            };

            $("#sent").on("click", function(e) {

                e.preventDefault();
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: {
                        action: "action",
                        senderEmail: $("#sender_email").val(),
                        receiverId: $("#receiver_id").val(),
                        message: $("#msg").val()
                    },
                    success: function(data) {
                        if (data == true) {
                            $("#sent-body").trigger("reset");
                            loadMsg();

                        } else {
                            alert("White something")
                        }
                    }
                })
            })
        });
    </script>
    </body>

    </html>