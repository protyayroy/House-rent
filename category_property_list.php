<?php

if (isset($_GET['category_id'])) {

    session_start();

    include("navbar.php");
?>

    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 100%;
            min-width: 100%;
            margin: auto;
            text-align: center;
            font-family: arial;
            display: inline;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            opacity: 0.8;
        }

        .container {
            padding: 2px 16px;
        }

        .btn {
            width: 100%;
        }

        .image {
            min-width: 100%;
            min-height: 200px;
            max-width: 100%;
            max-height: 200px;
        }
    </style>

    <!-- <div class="bg"></div><br> -->
    <div class="container active-cyan-4 mb-4 inline">
        <form method="POST" action="search-property.php" class="form-group" style="display: flex;">
            <input class="form-control" type="text" placeholder="Enter location to search house." name="search_property" aria-label="Search" style="width: 70%; height:40px; margin-right:25px">
            <button class="btn btn-success" style="width: 25%;">Search Property</button>
        </form>
    </div>
    <br><br>

    <section>
        <div class="row" style="margin:auto;">
            <div class="col-md-12">
                <?php

                $sql = "SELECT * FROM `add_property` WHERE category_id = '{$_GET['category_id']}'";
                $query = mysqli_query($db, $sql);
                if (mysqli_num_rows($query) > 0) {
                    while ($rows = mysqli_fetch_assoc($query)) {
                        $property_id = $rows['property_id'];


                ?>
                        <div class="col-sm-12 col-md-4">
                            <div class="card">
                                <?php


                                $sql2 = "SELECT * FROM property_photo where property_id='$property_id'";
                                $query2 = mysqli_query($db, $sql2);

                                if (mysqli_num_rows($query2) > 0) {
                                    $row = mysqli_fetch_assoc($query2);
                                    $photo = $row['p_photo'];
                                    echo  '<img class="image" src="owner/' . $photo . '">';
                                } ?>

                                <h4><b><?php echo $rows['property_type']; ?></b></h4>
                                <p><?php echo $rows['city'] . ', ' . $rows['district'] ?></p>
                                <p><?php echo '<a href="view-property.php?property_id=' . $rows['property_id'] . '"  class="btn btn-lg btn-primary btn-block" >View Property </a><br>'; ?></p><br>
                            </div>
                        </div>
                <?php }
                } ?>

            </div>
    </section>

<?php

    include("footer.php");
} else {
    echo "<script>window.location('index.php', '_self')</script>";
}
?>