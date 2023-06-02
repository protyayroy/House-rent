<?php
session_start();
isset($_SESSION["email"]);

?>

<!DOCTYPE html>
<html>

<head>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
  <style>
    #mapid {
      height: 180px;
    }

    .close:focus,
    .close:hover {
      filter: alpha(opacity=50);
      opacity: .8 !important;
    }

    .review_ul {
      list-style-type: none;
      border-bottom: 1px solid #d8d8d8;
    }

    .review_ul .r_body {
      border: 1px solid #999;
      background: #d8d8d8;
      width: 500px;
      margin-top: 10px;
      color: green;
      border-radius: 8px;
      padding: 10px;
      margin-bottom: 15px;
    }
  </style>
</head>

<body>




  <?php
  include('config/config.php');
  include('navbar.php');
  include('review-engine.php');
  include('booking-engine.php');
  ?>



  <?php


  $property_id = $_GET['property_id'];
  $sql = "SELECT * from add_property where property_id='$property_id'";
  $query = mysqli_query($db, $sql);

  if (mysqli_num_rows($query) > 0) {
    while ($rows = mysqli_fetch_assoc($query)) {



      $sql2 = "SELECT * FROM property_photo where property_id='$property_id'";
      $query2 = mysqli_query($db, $sql2);

      $rowcount = mysqli_num_rows($query2);
  ?>



      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">


            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" role="listbox">
                <?php
                for ($i = 1; $i <= $rowcount; $i++) {
                  $row = mysqli_fetch_array($query2);
                  $photo = $row['p_photo'];
                ?>

                  <?php
                  if ($i == 1) {
                  ?>
                    <div class="item active">
                      <img class="d-block img-fluid" src="owner/<?php echo $photo ?>" alt="First slide" width="100%" style="max-height: 600px; min-height: 600px;">
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="item">
                      <img class="d-block img-fluid" src="owner/<?php echo $photo ?>" alt="First slide" width="100%" style="max-height: 600px; min-height: 600px;">
                    </div>

                <?php
                  }
                }
                ?>

              </div>

              <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>

          </div>
          <div class="col-sm-6">
            <center>
              <h2><?php echo $rows['property_type'] ?></h2>
            </center>
            <div class="row">
              <div class="col-sm-6">

                <div class="row">
                  <div class="col-sm-6">
                    <table>
                      <tr>
                        <td>
                          <h3>Country:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['country']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>Province:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['province']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>Zone:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['zone']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>District:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['district']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>City:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['city']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>VDC/Municipality:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['vdc_municipality']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>Ward No.:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['ward_no']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>Tole:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['tole']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>Contact No.:</h3>
                        </td>
                        <td>
                          <h4><?php echo $rows['contact_no']; ?></h4>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <h3>Estimated Price:</h3>
                        </td>
                        <td>
                          <h4>Rs.<?php echo $rows['estimated_price']; ?></h4>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <table>
                  <tr>
                    <td>
                      <h3>Total Rooms:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['total_rooms']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3>Bedrooms:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['bedroom']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3>Living Room:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['living_room']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3>Kitchen:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['kitchen']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3>Bathroom:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['bathroom']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3>Booked:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['booked']; ?></h4>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h3>Description:</h3>
                    </td>
                    <td>
                      <h4><?php echo $rows['description']; ?></h4>
                    </td>
                  </tr>
                </table>
              </div>
            </div>

          </div>

        </div>
        <br>

        <?php

        if (isset($_SESSION["email"]) && !empty($_SESSION['email'])) {

        ?>
          <form method="POST">
            <div class="row">
              <?php
              $tenentQuery = $db->query("SELECT * FROM tenant WHERE email = '{$_SESSION['email']}'");
              if (mysqli_num_rows($tenentQuery) > 0) {
                $tenantRow = mysqli_fetch_assoc($tenentQuery);
                $tenantId = $tenantRow['tenant_id'];

              ?>
                <div class="col-sm-6">
                  <?php

                  $booked = $rows['booked'];

                  if ($booked == 'No') { ?>

                    <input type="hidden" name="property_id" value="<?php echo $rows['property_id']; ?>">
                    <!-- <input type="submit" class="btn btn-lg btn-primary" name="book_property" style="width: 100%" value="Book Property"> -->

                    <a class="btn btn-lg btn-primary" data-toggle="modal" data-target="#menu1" style="width: 100%;">Add Property</a>

                    <?php } elseif ($booked == 'Pending') {

                    $bookingQuery = $db->query("SELECT * FROM booking WHERE (property_id = '$property_id') AND (tenant_id = '$tenantId')");
                    if (mysqli_num_rows($bookingQuery) > 0) { ?>
                      <form action="" method="post">
                        <input type="hidden" name="property_id" value="<?php echo $rows['property_id']; ?>">
                        <input type="submit" class="btn btn-lg btn-warning" style="width: 49%" value="Pending for booking property" disabled>
                        <input type="submit" class="btn btn-lg btn-danger" style="width: 49%;margin-left:8px" value="Cancel Booking" name="cancel_booking" onclick="return confirm('Do you really want to Cancel Booking!')">
                      </form>

                    <?php } else { ?>

                      <input type="submit" class="btn btn-lg btn-warning" style="width: 100%" value="Processing for booking property" disabled>

                    <?php }
                  } elseif ($booked == 'Yes') { ?>

                    <input type="submit" class="btn btn-lg btn-danger" style="width: 100%" value="Poperty Booked" disabled>

                  <?php } ?>


                </div>

          </form>
          <form method="POST" action="chat/message.php">
            <div class="col-sm-6">
              <input type="hidden" name="owner_id" value="<?php echo $rows['owner_id']; ?>">
              <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
              <input type="submit" class="btn btn-lg btn-success" name="send_message" style="width: 100%" value="Send Message">

            </div>
          </form>

        <?php } else { ?>
          <div class="col-sm-12">
            <input type="submit" class="btn btn-lg btn-danger" style="width: 100%" value="You should  login as Tenant" disabled>

          </div>
        <?php } ?>
      </div>
      <div class="modal fade" id="menu1" role="dialog">
        <div class="modal-dialog" style="width: 80%;">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" style="color: red; font-size: 30px; opacity: .5;">&times;</button>
              <h4 class="modal-title">Pay for booking poperty</h4>
            </div>
            <div class="modal-body">

              <form method="POST">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="full_name">Full Name:</label>
                      <input class="form-control" type="text" id="full_name" value="<?= $tenantRow['full_name'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="full_name">Address:</label>
                      <input class="form-control" type="text" id="full_name" value="<?= $tenantRow['address'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="full_name">Phone No.:</label>
                      <input class="form-control" type="text" id="full_name" value="<?= $tenantRow['phone_no'] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bank_name">Bank Name:</label>
                      <input class="form-control" type="text" id="bank_name" name="bank_name" required>
                    </div>

                    <div class="form-group">
                      <label for="account_number">Account Number:</label>
                      <input class="form-control" type="text" id="account_number" name="account_number" required>
                    </div>

                    <div class="form-group">
                      <label for="amount">Full Name:</label>
                      <input class="form-control" type="text" id="amount" name="amount" value="<?= $rows['estimated_price'] ?>" readonly>
                    </div>
                  </div>
                </div>
                <hr>
                <center><button id="submit" name="book_property" class="btn btn-primary btn-block" style="padding: 10px;"><b>Pay for Booking</b></button></center><br>

              </form>


            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div> -->
          </div>

        </div>
      </div>

    <?php } else {
          echo "<center><h3>You should login to book property.</h3></center>";
        }


    ?>

    <br>
    <div id="map" style="width: 100%; height: 300px;">
      <div id="lat"><?php echo  $rows['latitude']; ?></div>
      <div id="lon"><?php echo  $rows['longitude']; ?></div>
    </div>
    <br>


<?php }
  } ?>
</div>


<div class="container-fluid">
  <h2>Review Property:</h2>
  <div class="well well-sm">
    <div class="text-right">
      <?php

      if (isset($_SESSION["email"]) && !empty($_SESSION['email'])) {
      ?>
        <a class="btn btn-success btn-info" href="#reviews-anchor" style="width: 100%" id="open-review-box">Leave a Review</a>
    </div>

    <div class="row" id="post-review-box" style="display:none;">
      <div class="col-md-12">
        <form accept-charset="UTF-8" method="POST">
          <input name="property_id" type="hidden" value="<?php echo $property_id; ?>">
          <input id="ratings-hidden" name="rating" type="hidden">
          <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

          <div class="text-right">
            <div class="stars starrr" data-rating="0"></div>
            <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
              <span class="glyphicon glyphicon-remove"></span>Cancel</a>
            <button class="btn btn-success btn-lg" type="submit" name="review">Save</button>
          </div>
        </form>
      </div>
    </div>
  <?php } else {
        echo "<center>You should login to review property.</center>";
      }
  ?>


  </div>

</div>


<?php

$sql1 = "SELECT * from review where property_id='$property_id'";
$query = mysqli_query($db, $sql1);

echo '<div class="container-fluid">';
echo '<h3>Reviews:</h3>';
echo '<hr style="border: 1px solid #999">';
echo '</div>';
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $tenantQ = $db->query("SELECT * FROM tenant WHERE tenant_id = '{$row['review_sender_id']}'");
    while ($tenantR = mysqli_fetch_assoc($tenantQ)) {
      // echo $tenantR['full_name'];


?>

      <div class="container-fluid">
        <ul class="review_ul">
          <li>
            <div class="r_header">
              <img src="<?php echo $tenantR['image'] ?>" alt="<?php echo $tenantR['image'] ?>" style="height: 50px; width: 50px; border-radius: 50%;margin-right:10px">
              <strong><?php echo $tenantR['full_name']; ?></strong>
              (<span class="glyphicon glyphicon-star-empty" style="size: 50px;">
                <?php echo $row['rating']; ?>
              </span>)
            </div>
            <div class="r_body" style="margin-left: 50px">
              <?php echo $row['comment']; ?>
            </div>
          </li>
        </ul>
      </div>


<?php
    }
  }
}
?>
<br><br>

<?php
include("footer.php")
?>


</body>

</html>
<script type="text/javascript">
  function initialize() {
    var x = document.getElementById("lat").innerText;
    var y = document.getElementById("lon").innerText;
    var latlng = new google.maps.LatLng(x, y);
    var map = new google.maps.Map(document.getElementById('map'), {
      center: latlng,
      zoom: 13
    });
    var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      draggable: false,
      anchorPoint: new google.maps.Point(0, -29)
    });
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
      var iwContent = '<div id="iw_container">' +
        '<div class="iw_title"><b>Location</b> : Noida</div></div>';
      // including content to the infowindow
      infowindow.setContent(iwContent);
      // opening the infowindow in the current map and at the current marker location
      infowindow.open(map, marker);
    });
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<style>
  h3 {
    font-size: 20px;
  }

  h4 {
    font-size: 20px;
  }

  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  td,
  th {
    text-align: left;
    padding: 1px;
  }
</style>

<style>
  .animated {
    -webkit-transition: height 0.2s;
    -moz-transition: height 0.2s;
    transition: height 0.2s;
  }

  .stars {
    margin: 20px 0;
    font-size: 24px;
    color: #d17581;
  }
</style>

<script>
  (function(e) {
    var t, o = {
        className: "autosizejs",
        append: "",
        callback: !1,
        resizeDelay: 10
      },
      i = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',
      n = ["fontFamily", "fontSize", "fontWeight", "fontStyle", "letterSpacing", "textTransform", "wordSpacing", "textIndent"],
      s = e(i).data("autosize", !0)[0];
    s.style.lineHeight = "99px", "99px" === e(s).css("lineHeight") && n.push("lineHeight"), s.style.lineHeight = "", e.fn.autosize = function(i) {
      return this.length ? (i = e.extend({}, o, i || {}), s.parentNode !== document.body && e(document.body).append(s), this.each(function() {
        function o() {
          var t, o;
          "getComputedStyle" in window ? (t = window.getComputedStyle(u, null), o = u.getBoundingClientRect().width, e.each(["paddingLeft", "paddingRight", "borderLeftWidth", "borderRightWidth"], function(e, i) {
            o -= parseInt(t[i], 10)
          }), s.style.width = o + "px") : s.style.width = Math.max(p.width(), 0) + "px"
        }

        function a() {
          var a = {};
          if (t = u, s.className = i.className, d = parseInt(p.css("maxHeight"), 10), e.each(n, function(e, t) {
              a[t] = p.css(t)
            }), e(s).css(a), o(), window.chrome) {
            var r = u.style.width;
            u.style.width = "0px", u.offsetWidth, u.style.width = r
          }
        }

        function r() {
          var e, n;
          t !== u ? a() : o(), s.value = u.value + i.append, s.style.overflowY = u.style.overflowY, n = parseInt(u.style.height, 10), s.scrollTop = 0, s.scrollTop = 9e4, e = s.scrollTop, d && e > d ? (u.style.overflowY = "scroll", e = d) : (u.style.overflowY = "hidden", c > e && (e = c)), e += w, n !== e && (u.style.height = e + "px", f && i.callback.call(u, u))
        }

        function l() {
          clearTimeout(h), h = setTimeout(function() {
            var e = p.width();
            e !== g && (g = e, r())
          }, parseInt(i.resizeDelay, 10))
        }
        var d, c, h, u = this,
          p = e(u),
          w = 0,
          f = e.isFunction(i.callback),
          z = {
            height: u.style.height,
            overflow: u.style.overflow,
            overflowY: u.style.overflowY,
            wordWrap: u.style.wordWrap,
            resize: u.style.resize
          },
          g = p.width();
        p.data("autosize") || (p.data("autosize", !0), ("border-box" === p.css("box-sizing") || "border-box" === p.css("-moz-box-sizing") || "border-box" === p.css("-webkit-box-sizing")) && (w = p.outerHeight() - p.height()), c = Math.max(parseInt(p.css("minHeight"), 10) - w || 0, p.height()), p.css({
          overflow: "hidden",
          overflowY: "hidden",
          wordWrap: "break-word",
          resize: "none" === p.css("resize") || "vertical" === p.css("resize") ? "none" : "horizontal"
        }), "onpropertychange" in u ? "oninput" in u ? p.on("input.autosize keyup.autosize", r) : p.on("propertychange.autosize", function() {
          "value" === event.propertyName && r()
        }) : p.on("input.autosize", r), i.resizeDelay !== !1 && e(window).on("resize.autosize", l), p.on("autosize.resize", r), p.on("autosize.resizeIncludeStyle", function() {
          t = null, r()
        }), p.on("autosize.destroy", function() {
          t = null, clearTimeout(h), e(window).off("resize", l), p.off("autosize").off(".autosize").css(z).removeData("autosize")
        }), r())
      })) : this
    }
  })(window.jQuery || window.$);

  var __slice = [].slice;
  (function(e, t) {
    var n;
    n = function() {
      function t(t, n) {
        var r, i, s, o = this;
        this.options = e.extend({}, this.defaults, n);
        this.$el = t;
        s = this.defaults;
        for (r in s) {
          i = s[r];
          if (this.$el.data(r) != null) {
            this.options[r] = this.$el.data(r)
          }
        }
        this.createStars();
        this.syncRating();
        this.$el.on("mouseover.starrr", "span", function(e) {
          return o.syncRating(o.$el.find("span").index(e.currentTarget) + 1)
        });
        this.$el.on("mouseout.starrr", function() {
          return o.syncRating()
        });
        this.$el.on("click.starrr", "span", function(e) {
          return o.setRating(o.$el.find("span").index(e.currentTarget) + 1)
        });
        this.$el.on("starrr:change", this.options.change)
      }
      t.prototype.defaults = {
        rating: void 0,
        numStars: 5,
        change: function(e, t) {}
      };
      t.prototype.createStars = function() {
        var e, t, n;
        n = [];
        for (e = 1, t = this.options.numStars; 1 <= t ? e <= t : e >= t; 1 <= t ? e++ : e--) {
          n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))
        }
        return n
      };
      t.prototype.setRating = function(e) {
        if (this.options.rating === e) {
          e = void 0
        }
        this.options.rating = e;
        this.syncRating();
        return this.$el.trigger("starrr:change", e)
      };
      t.prototype.syncRating = function(e) {
        var t, n, r, i;
        e || (e = this.options.rating);
        if (e) {
          for (t = n = 0, i = e - 1; 0 <= i ? n <= i : n >= i; t = 0 <= i ? ++n : --n) {
            this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")
          }
        }
        if (e && e < 5) {
          for (t = r = e; e <= 4 ? r <= 4 : r >= 4; t = e <= 4 ? ++r : --r) {
            this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")
          }
        }
        if (!e) {
          return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")
        }
      };
      return t
    }();
    return e.fn.extend({
      starrr: function() {
        var t, r;
        r = arguments[0], t = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
        return this.each(function() {
          var i;
          i = e(this).data("star-rating");
          if (!i) {
            e(this).data("star-rating", i = new n(e(this), r))
          }
          if (typeof r === "string") {
            return i[r].apply(i, t)
          }
        })
      }
    })
  })(window.jQuery, window);
  $(function() {
    return $(".starrr").starrr()
  })

  $(function() {

    $('#new-review').autosize({
      append: "\n"
    });

    var reviewBox = $('#post-review-box');
    var newReview = $('#new-review');
    var openReviewBtn = $('#open-review-box');
    var closeReviewBtn = $('#close-review-box');
    var ratingsField = $('#ratings-hidden');

    openReviewBtn.click(function(e) {
      reviewBox.slideDown(400, function() {
        $('#new-review').trigger('autosize.resize');
        newReview.focus();
      });
      openReviewBtn.fadeOut(100);
      closeReviewBtn.show();
    });

    closeReviewBtn.click(function(e) {
      e.preventDefault();
      reviewBox.slideUp(300, function() {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
      closeReviewBtn.hide();

    });

    $('.starrr').on('starrr:change', function(e, value) {
      ratingsField.val(value);
    });
  });
</script>