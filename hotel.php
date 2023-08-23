<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nepa Hotel Booking</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="css/hotel.css" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <!-- Fontawesome css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- Fontawesome js -->
  <script src="https://kit.fontawesome.com/caa7c84843.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="fontawesome/css/all.min.css">
  <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
</head>

<body>

  <?php include("components/header.php"); ?>

  <div class="search text-center px">
    <form class="px" action="" method="get">
      <input type="text" name="search" placeholder="Search Hotels....." />
      <button><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
  </div>
  <div class="cont">
    <?php
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
      $sql = "SELECT * FROM hotels WHERE active = 'yes' AND hotel_name LIKE '%$search%' LIMIT 5 ";
      $result = mysqli_query($con, $sql);
    } else {
      $sql = "SELECT * FROM hotels WHERE active = 'yes'";
      $result = mysqli_query($con, $sql);
    }
    if ($result) {
      while ($row = mysqli_fetch_array($result)) {
    ?>
        <a href="desc.php?id=<?php echo $row['hid']; ?>" class="item">
          <img class="image" src="hmanager/upload/<?php echo $row['hotel_img']; ?>" alt="image" />
          <div class="desc">
            <h3><?php echo $row['hotel_name']; ?></h3>
            <h4 style="padding: 5px 0px; color:gray;"><?php echo $row['hotel_address']; ?></h4>
            <p class="hide">
              <?php echo $row['hotel_desc']; ?>
            </p>
          </div>
        </a>
      <?php }
    }
    if (mysqli_num_rows($result) < 1) { ?>
      <h2 class="text-center result">Result not found!</h2>
    <?php } ?>
  </div>

  <?php include("components/footer.php"); ?>

  <script src="js/index.js"></script>
</body>

</html>