<?php
include("../config/config.php");

if (isset($_GET["delete_id"])) {
  $propertyQuery = $db->query("DELETE FROM `add_property` WHERE `property_id` = '{$_GET["delete_id"]}'");
  if ($propertyQuery) {
    header("location:owner-index.php");
  }
}

if (isset($_GET["update_id"])) {
  $propertyQuery = $db->query("SELECT * FROM add_property WHERE property_id = '{$_GET["update_id"]}'");
  $propertyR = mysqli_fetch_assoc($propertyQuery);
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link file -->
    <link rel="stylesheet" href="chat/chat-css-js/bootstrap.min.css">
    <link rel="stylesheet" href="chat/chat-css-js/style.css">

    <title>Update Property</title>
    <style>
      body {
        background: #fff;
        padding-top: 20px;
      }

      label {
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
      }

      input {
        color: #333;
      }
    </style>

  </head>

  <body>
    <div class="container">
      <div class="row">
        <center>
          <h3>Edit Your Property</h3>
        </center>
        <hr>
        <form method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group mb-3">
                <label for="country">Country:</label>
                <input value="<?= $propertyR['country'] ?>" type="text" name="country" id="country" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="province">Province/State:</label>
                <input value="<?= $propertyR['province'] ?>" type="text" name="province" id="province" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="zone">Zone:</label>
                <input value="<?= $propertyR['zone'] ?>" type="text" name="zone" id="zone" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="district">District:</label>
                <input value="<?= $propertyR['district'] ?>" type="text" name="district" id="district" class="form-control">
              </div>
              <div class="form-group mb-3">
                <label for="city">City:</label>
                <input value="<?= $propertyR['city'] ?>" type="text" class="form-control" id="city" name="city">
              </div>
              <div class="form-group mb-3">
                <label for="vdc/municipality">VDC/Municipality:</label>
                <select class="form-select" aria-label="Default select example"  name="vdc_municipality" id="vdc/municipality">
                <option <?php isset($propertyR['vdc_municipality']) ? "selected" : "" ?> value="VDC">VDC</option>
                  <option <?php isset($propertyR['vdc_municipality']) ? "selected" : "" ?> value="Municipality">Municipality</option>
                </select>

              </div>
              <div class="form-group mb-3">
                <label for="ward_no">Ward No.:</label>
                <input value="<?= $propertyR['ward_no'] ?>" type="text" class="form-control" id="ward_no" name="ward_no">
              </div>
              <div class="form-group mb-3">
                <label for="tole">Tole:</label>
                <input value="<?= $propertyR['tole'] ?>" type="text" class="form-control" id="tole" name="tole">
              </div>
              <div class="form-group mb-3">
                <label for="contact_no">Contact No.:</label>
                <input value="<?= $propertyR['contact_no'] ?>" type="text" class="form-control" id="contact_no" name="contact_no">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group mb-3">
                <label for="property_type">Property Type:</label>

                <select class="form-select" aria-label="Default select example"  name="property_type">
                  <option <?php isset($propertyR['property_type']) ? "selected" : "" ?> value="Full House Rent">Full House Rent</option>
                  <option <?php isset($propertyR['property_type']) ? "selected" : "" ?> value="Flat Rent">Flat Rent</option>
                  <option <?php isset($propertyR['property_type']) ? "selected" : "" ?> value="Room Rent">Room Rent</option>
                </select>
                <!-- <select class="form-control" name="property_type">
                </select> -->
              </div>

              <div class="form-group mb-3">
                <label for="estimated_price">Estimated Price:</label>
                <input value="<?= $propertyR['estimated_price'] ?>" type="estimated_price" class="form-control" id="estimated_price" name="estimated_price">
              </div>
              <div class="form-group mb-3">
                <label for="total_rooms">Total No. of Rooms:</label>
                <input value="<?= $propertyR['total_rooms'] ?>" type="number" class="form-control" id="total_rooms" name="total_rooms">
              </div>
              <div class="form-group mb-3">
                <label for="bedroom">No. of Bedroom:</label>
                <input value="<?= $propertyR['bedroom'] ?>" type="number" class="form-control" id="bedroom" name="bedroom">
              </div>
              <div class="form-group mb-3">
                <label for="living_room">No. of Living Room:</label>
                <input value="<?= $propertyR['living_room'] ?>" type="number" class="form-control" id="living_room" name="living_room">
              </div>
              <div class="form-group mb-3">
                <label for="kitchen">No. of Kitchen:</label>
                <input value="<?= $propertyR['kitchen'] ?>" type="number" class="form-control" id="kitchen" name="kitchen">
              </div>
              <div class="form-group mb-3">
                <label for="bathroom">No. of Bathroom/Washroom:</label>
                <input value="<?= $propertyR['bathroom'] ?>" type="number" class="form-control" id="bathroom" name="bathroom">
              </div>
              <div class="form-group mb-3">
                <label for="description">Full Description:</label>
                <textarea type="comment" class="form-control" id="description" name="description"><?= $propertyR['description'] ?></textarea>
              </div>
              <!-- <table class="table table-bordered" border="0">
              <tr>
                <div class="form-group mb-3">
                  <label><b>Latitude/Longitude:</b><span style="color:red; font-size: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; *Click on Button</span></label>
                  <td><input  value="<?= $propertyR['country'] ?>" type="text" name="latitude" placeholder="Latitude" id="latitude" class="form-control name_list" readonly required /></td>
                  <td><input  value="<?= $propertyR['country'] ?>" type="text" name="longitude" placeholder="Longitude" id="longitude" class="form-control name_list" readonly required /></td>
                  <td><input  value="<?= $propertyR['country'] ?>" type="button" value="Get Latitude and Longitude" onclick="getLocation()" class="btn btn-success col-lg-12"></td>
                </div>
              </tr>
            </table> -->
              <!-- <table class="table" id="dynamic_field">
              <tr>
                <div class="form-group mb-3">
                  <label><b>Photos:</b></label>
                  <td><input  value="<?= $propertyR['country'] ?>" type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" required accept="image/*" /></td>
                  <td><button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More</button></td>
                </div>
              </tr>
            </table> -->
              <!-- <input  value="<?= $propertyR['country'] ?>" name="lat" type="text" id="lat" hidden>
            <input  value="<?= $propertyR['country'] ?>" name="lng" type="text" id="lng" hidden> -->

            </div>
            <div class="form-group mb-3">
              <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Update Property" name="update_property">
            </div>
          </div>
        </form>
      </div>
    </div>

    <script src="chat/chat-css-js/jquery-1.12.4.min.js"></script>
    <script src="chat/chat-css-js/popper.min.js"></script>
    <script src="chat/chat-css-js/bootstrap.min.js"></script>

    <script src="chat/chat-css-js/script.js"></script>

  </body>

  </html>
<?php
  if (isset($_POST['update_property'])) {



    $updateQuery = $db->query("UPDATE `add_property` SET `country`='{$_POST['country']}',`province`='{$_POST['province']}',`zone`='{$_POST['zone']}',`district`='{$_POST['district']}',`city`='{$_POST['city']}',`vdc_municipality`='{$_POST['vdc_municipality']}',`ward_no`='{$_POST['ward_no']}',`tole`='{$_POST['tole']}',`contact_no`='{$_POST['contact_no']}',`property_type`='{$_POST['property_type']}',`estimated_price`='{$_POST['estimated_price']}',`total_rooms`='{$_POST['total_rooms']}',`bedroom`='{$_POST['bedroom']}',`living_room`='{$_POST['living_room']}',`kitchen`='{$_POST['kitchen']}',`bathroom`='{$_POST['bathroom']}',`description`='{$_POST['description']}' WHERE `property_id` = '{$_GET["update_id"]}'");

    if ($updateQuery) {
      echo "<script>window.alert('Property Update Successful')</script>";
      echo "<script>window.open('owner-index.php', '_self')</script>";
      // header("location:owner-index.php");
    }
  }
} ?>