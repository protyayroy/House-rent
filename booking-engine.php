<?php


include("config/config.php");

if (isset($_POST['cancel_booking'])) {
  if (isset($_SESSION["email"])) {
    // global $db, $property_id;
    $property_id = $_POST['property_id'];
    // echo  $property_id;
    $u_email = $_SESSION["email"];
    // var_dump("SELECT * FROM tenant where email='$u_email'"); die();
    $tenantQ = $db->query("SELECT * FROM tenant where email='$u_email'");
    if($tenantQ){
      $tenantR = mysqli_fetch_assoc($tenantQ);
      $tenant_id = $tenantR['tenant_id'];
    }

    $cancelBookingQuery = $db->query("DELETE FROM `booking` WHERE tenant_id='$tenant_id' AND property_id = '$property_id'");
    if($cancelBookingQuery){
      $updatePropertyQ = $db->query("UPDATE `add_property` SET `booked`='No' WHERE `property_id` = '$property_id'");
      if($updatePropertyQ){

        echo "<script>window.alert('Booking Cancel Successful')</script>";
        echo "<script>window.open('view-property.php?property_id=$property_id', '_self')</script>";

      }
    }
  }
}

if (isset($_POST['book_property'])) {
  $bank_name = $_POST['bank_name'];
  $account_number = $_POST['account_number'];
  $amount = $_POST['amount'];

  if (isset($_SESSION["email"])) {
    global $db, $property_id;
    $u_email = $_SESSION["email"];

    $property_id = $_GET['property_id'];

    $sql = "SELECT * FROM tenant where email='$u_email'";
    $query = mysqli_query($db, $sql);

    if (mysqli_num_rows($query) > 0) {
      while ($rows = mysqli_fetch_assoc($query)) {
        $tenant_id = $rows['tenant_id'];


        $sql1 = "UPDATE add_property SET booked='Pending' WHERE property_id='$property_id'";
        $query1 = mysqli_query($db, $sql1);

        $sql2 = "INSERT INTO booking(property_id,tenant_id,bank_name,account_number,amount) VALUES ('$property_id','$tenant_id','$bank_name','$account_number','$amount')";
        $query2 = mysqli_query($db, $sql2);

        if ($query2) {

          // $email = $rows['email'];
          // $msg = "Thankyou Mr/Ms " . $rows['full_name'] . " for booking Property. Please visit the property location to view it personally.";
          // $recipient = $email;
          // $subject = "Property Booked";
          // $mailheaders = "From: RentHouse\n";

          // //mail send
          // mail($recipient, $subject, $msg, $mailheaders);

?>


          <style>
            .alert {
              padding: 20px;
              background-color: #DC143C;
              color: white;
            }

            .closebtn {
              margin-left: 15px;
              color: white;
              font-weight: bold;
              float: right;
              font-size: 22px;
              line-height: 20px;
              cursor: pointer;
              transition: 0.3s;
            }

            .closebtn:hover {
              color: black;
            }
          </style>
          <script>
            window.setTimeout(function() {
              $(".alert").fadeTo(1000, 0).slideUp(500, function() {
                $(this).remove();
              });
            }, 2000);
          </script>
          <div class="container">
            <div class="alert" role='alert'>
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              <center><strong>Thankyou for booking this property. Wait for approve</strong></center>
            </div>
          </div>



<?php





        }
      }
    }
  }
}

?>