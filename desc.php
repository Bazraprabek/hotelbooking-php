<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nepa Hotel Booking</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/search.css" />
  <link rel="stylesheet" href="css/desc.css" />
  <link rel="stylesheet" href="css/rating.css" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <!-- Fontawesome css -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->
  <!-- Fontawesome js -->
  <!-- <script src="https://kit.fontawesome.com/caa7c84843.js" crossorigin="anonymous"></script> -->
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
</head>

<body>
  <?php include("components/header.php"); ?>
  <?php
  if (isset($_GET['id'])) {
    // store id from link
    $id = $_GET["id"];

    // selecting row match to id
    $result = mysqli_query($con, "SELECT * FROM hotels WHERE hid =$id");

    // storing all the value in array into $row
    $item = mysqli_fetch_array($result);
    $hotel_name = $item['hotel_name'];
  } else {
    header('Location: hotel.php');
  }
  ?>

  <div class="descs">
    <div class="image">
      <img src="hmanager/upload/<?php echo $item['hotel_img']; ?>" alt="hotel_img" />
    </div>
    <div class="desc">
      <h1><?php echo $item['hotel_name']; ?></h1>
      <h3 style="color: grey;"><?php echo $item['hotel_address']; ?></h3>
      <p><?php echo $item['hotel_desc']; ?></p>
    </div>
  </div>

  <div class="container">

    <div class="rating px">
      <h2 class="text-center px"><u>Rating</u></h2>
      <div class="description">
        <!-- Rating -->

        <div class="rated">
          <h2 style="color : red">User Rating</h2>
          <p class="b text-center px">
            <?php
            $rate = 0;
            $sql = "SELECT * FROM rating WHERE hid = '$id'";
            $result = mysqli_query($con, $sql);
            $reviews = mysqli_num_rows($result);
            if ($reviews > 0) {
              while ($row = mysqli_fetch_array($result)) {
                $rate += $row['rate'];
              }
              $rate = $rate / $reviews;
              $rate =  number_format($rate, 1);
              echo $rate;
            } else {
              echo 0;
            }
            ?>
          </p>
          <p>based on <?php echo $reviews; ?> reviews.</p>
        </div>
        <?php
        $uid = $userdata['id'];
        $sql = "SELECT * FROM rating WHERE id = '$uid' AND hid = '$id'";
        $result = mysqli_query($con, $sql);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
          $rating = mysqli_fetch_array($result);
          $rid = $rating['rid'];
          $rate = $rating['rate'];
        ?>
          <div class="star-wrapper">
            <p class="px">Your Review</p>
            <a href="rating.php?re=5&rid=<?php echo $rid; ?>" class="fas fa-star s1" onclick="return confirm('Are you sure want to update rate?')" title="5"></a>
            <a href="rating.php?re=4&rid=<?php echo $rid; ?>" class="fas fa-star s2" onclick="return confirm('Are you sure want to update rate?')" title="4"></a>
            <a href="rating.php?re=3&rid=<?php echo $rid; ?>" class="fas fa-star s3" onclick="return confirm('Are you sure want to update rate?')" title="3"></a>
            <a href="rating.php?re=2&rid=<?php echo $rid; ?>" class="fas fa-star s4" onclick="return confirm('Are you sure want to update rate?')" title="2"></a>
            <a href="rating.php?re=1&rid=<?php echo $rid; ?>" class="fas fa-star s5" onclick="return confirm('Are you sure want to update rate?')" title="1"></a>
          </div>
          <script>
            <?php

            while ($rate >= 1) {
            ?>
              document.getElementsByClassName('s<?php echo 6 - $rate; ?>')[0].style.color = "red";
            <?php
              $rate--;
            }
            ?>
          </script>
        <?php } else {
        ?>
          <div class="star-wrapper">
            <p class="px">Please Give Your Review</p>
            <a href="rating.php?rate=5&hid=<?php echo $id; ?>" class="fas fa-star s1" onclick="return confirm('Are you sure want to rate?')" title="5"></a>
            <a href="rating.php?rate=4&hid=<?php echo $id; ?>" class="fas fa-star s2" onclick="return confirm('Are you sure want to rate?')" title="4"></a>
            <a href="rating.php?rate=3&hid=<?php echo $id; ?>" class="fas fa-star s3" onclick="return confirm('Are you sure want to rate?')" title="3"></a>
            <a href="rating.php?rate=2&hid=<?php echo $id; ?>" class="fas fa-star s4" onclick="return confirm('Are you sure want to rate?')" title="2"></a>
            <a href="rating.php?rate=1&hid=<?php echo $id; ?>" class="fas fa-star s5" onclick="return confirm('Are you sure want to rate?')" title="1"></a>
          </div>
        <?php } ?>
      </div>

      <!-- End of Rating -->

    </div>
  </div>
  <div class="cat">
    <h2 class="text-center"><u>Room Categories</u></h2>
    <div class="description">
      <?php
      $sql = "SELECT * FROM categories WHERE hid = '$id'";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
      ?>
          <table width="350px">
            <tr>
              <td colspan="2"><img src="hmanager/upload/categories/<?php echo $row['cimg']; ?>" width="100%" height="300px" alt="image"></td>
            </tr>
            <tr>
              <th><?php echo $row['cname']; ?></th>
            </tr>
            <tr>
              <th>Rs. <?php echo $row['cprice']; ?>/day</th>
            </tr>
            <tr>
              <th><?php echo $row['cdesc']; ?></th>
            </tr>
            <?php
            $cid = $row['cid'];
            $ssql = "SELECT * FROM rooms WHERE cid = '$cid' AND status = 'yes'";
            $rresult = mysqli_query($con, $ssql);
            while ($rrow = mysqli_fetch_array($rresult)) {
            ?>
              <tr>
                <td><?php echo $rrow['room']; ?></td>
                <td><a href="book.php?rid=<?php echo $rrow['rid']; ?>&cid=<?php echo $cid; ?>">Book</a></td>
              </tr>
            <?php } ?>
          </table>
        <?php }
      } else {
        ?>
        <h1>NoT Found!</h1>
      <?php
      } ?>
    </div>
  </div>

  <div class="featured">
    <h1 class="text-center">Featured Hotels</h1>
    <div class="items">
      <?php
      $sql = "SELECT * FROM hotels WHERE active = 'yes' AND hotel_name != '$hotel_name' LIMIT 3";
      $result = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <a href="desc.php?id=<?php echo $row['hid']; ?>" class="item">
          <img src="hmanager/upload/<?php echo $row['hotel_img']; ?>" alt="hotels_img">
          <h3><?php echo $row['hotel_name']; ?></h3>
        </a>
      <?php } ?>

    </div>
  </div>

  <?php include("components/footer.php"); ?>

  <script src="js/index.js"></script>
  <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
</body>

</html>