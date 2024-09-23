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
  <div class="container px">
    <h2>Booking</h2>
    <?php
    $username = $userdata['username'];
    $sql = "SELECT * FROM hotels WHERE manager = '$username' AND active = 'no'";
    $result = mysqli_query($con, $sql);
    $ssql = "SELECT * FROM hotels WHERE manager = '$username' AND active = 'yes'";
    $rresult = mysqli_query($con, $ssql);

    if ($result && mysqli_num_rows($result) > 0) {
    ?>
      <h2 class="text-center">Request Send</h2>
    <?php } elseif ($rresult && mysqli_num_rows($rresult) > 0) {

      $sssql = "SELECT * FROM hotels WHERE manager = '$username'";
      $rrresult = mysqli_query($con, $sssql);
      $hotel = mysqli_fetch_array($rrresult);
      $hid = $hotel['hid'];

    ?>

      <!-- Checked in -->
      <h3 class="px">Checked In</h3>
      <table class="ctable">
        <tr>
          <th>SNo.</th>
          <th>Username</th>
          <th>Fullname</th>
          <th>Room no</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Checked In</th>
          <th>Checked Out</th>
          <th>Days Stay</th>
          <th>Total Amount</th>
          <th></th>
          <th></th>
        </tr>
        <?php
        $sn = 1;
        $sql = "SELECT * FROM booking WHERE hid = '$hid' AND checked_out = '0'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['room_no']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['checked_in']; ?></td>
            <td><?php echo $row['checked_out']; ?></td>
            <td><?php echo $row['days']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td>
              <a href="done.php?bid=<?php echo $row['bid'] ?>" onclick="return confirm('Are you sure want to checked out?')">Checked Out</a>
            </td>
            <td>
              <a href="done.php?did=<?php echo $row['bid'] ?>" onclick="return confirm('Are you sure want to cancel?')">Cancel</a>
            </td>
          </tr>
        <?php } ?>
      </table>

      <!-- Checked out -->

      <h3 class="px">Checked Out</h3>
      <table class="ctable">
        <tr>
          <th>SNo.</th>
          <th>Username</th>
          <th>Fullname</th>
          <th>Room no</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Checked In</th>
          <th>Checked Out</th>
          <th>Days Stay</th>
          <th>Total Amount</th>
        </tr>
        <?php
        $sn = 1;
        $sql = "SELECT * FROM booking WHERE hid = '$hid' AND checked_out != '0' LIMIT 15";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['room_no']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['checked_in']; ?></td>
            <td><?php echo $row['checked_out']; ?></td>
            <td><?php echo $row['days']; ?></td>
            <td><?php echo $row['amount']; ?></td>
          </tr>
        <?php } ?>
      </table>
    <?php } else { ?>
      <h2 class="text-center">Please send Request <a href="hprofile.php">Click here</a></h2>
    <?php } ?>
  </div>
</body>

</html>