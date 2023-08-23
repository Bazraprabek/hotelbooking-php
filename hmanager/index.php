<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nepa Hotel Booking</title>
  <link rel="stylesheet" href="hstyles.css" />
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include("hheader.php"); ?>
  <div class="home container px">
    <?php
    $manager = $userdata['username'];
    $sql = "SELECT * FROM hotels WHERE manager = '$manager' AND active = 'no'";
    $result = mysqli_query($con, $sql);
    $ssql = "SELECT * FROM hotels WHERE manager = '$manager' AND active = 'yes'";
    $rresult = mysqli_query($con, $ssql);
    if ($result && mysqli_num_rows($result) > 0) {
    ?>
      <h2 class="text-center">Request Send</h2>
    <?php } elseif ($rresult && mysqli_num_rows($rresult) > 0) { ?>
      <?php
      $manager = $userdata['username'];
      $sql = "SELECT * FROM hotels WHERE manager = '$manager'";
      $result = mysqli_query($con, $sql);
      $hotel = mysqli_fetch_array($result);
      $hid = $hotel['hid'];
      $name = $hotel['hotel_name'];

      $sql = "SELECT * FROM rooms WHERE status = 'no' AND hid = '$hid'";
      $result = mysqli_query($con, $sql);
      $hotel = mysqli_num_rows($result);

      $sql = "SELECT * FROM rooms WHERE hid = '$hid'";
      $result = mysqli_query($con, $sql);
      $room = mysqli_num_rows($result);
      ?>
      <h1 class="text-center px"><?php echo $name; ?></h1>
      <div class="row">
        <div class="box">
          <h2>Number of Rooms: <?php echo $room; ?></h2>
        </div>
        <div class="box">
          <h2>Number of Booked Rooms: <?php echo $hotel; ?></h2>
        </div>
      </div>
    <?php } else { ?>
      <h1 class="text-center px">Hotel Dashboard</h1>
      <h2 class="text-center">Please send Request <a href="hprofile.php">Click here</a></h2>
    <?php } ?>
  </div>
</body>

</html>