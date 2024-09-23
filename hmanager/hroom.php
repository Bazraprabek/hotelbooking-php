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
    <h2>Rooms</h2>
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
      $ssql = "SELECT * FROM hotels WHERE manager = '$manager'";
      $rresult = mysqli_query($con, $ssql);
      $hotel = mysqli_fetch_array($rresult);
      $hid = $hotel['hid'];

      if (isset($_POST['add'])) {

        $room = $_POST['room'];
        $cid = $_POST['cid'];
        $query = "SELECT * FROM categories WHERE cid = '$cid'";
        $result = mysqli_query($con, $query);
        $category = mysqli_fetch_array($result);
        $cname = $category['cname'];

        //save to database
        $query = "INSERT INTO `rooms` (`room`,`cid`,`cname`,`hid`,`status`) 
                  VALUES ('$room','$cid','$cname','$hid','yes')";
        $result = mysqli_query($con, $query);
        if ($result) {
          $_SESSION['add'] = "Add Successfully!";
        }
      }

      if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
        echo "<br><br>";
      }
      ?>
      <form action="" method="post">
        <br>
        <label for="room">Room</label>
        <input type="text" name="room" id="room">
        <label for="categories">Categories</label>
        <select name="cid" id="cid">
          <?php
          $sql = "SELECT * FROM categories WHERE hid = '$hid'";
          $result = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_array($result)) {
          ?>
            <option value="<?php echo $row['cid']; ?>"><?php echo $row['cname']; ?></option>
          <?php } ?>
        </select>
        <button class="btn" name="add">Add</button>
      </form>
      <table class="ctable px">
        <tr>
          <th>SNo.</th>
          <th>Room</th>
          <th>Categories</th>
          <th>Status</th>
          <th></th>
        </tr>
        <?php
        $sn = 1;
        $sql = "SELECT * FROM rooms WHERE hid = '$hid'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $row['room']; ?></td>
            <td><?php echo $row['cname']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
              <a href="../components/delete.php?rid=<?php echo $row['rid'] ?>&location=../hmanager/hroom.php" onclick="return confirm('Are you sure want to delete?')">Delete</a>
            </td>
          </tr>
        <?php } ?>
      </table>
    <?php } else { ?>
      <h2 class="text-center">Please send Request <a href="hprofile.php">Click here</a></h2>
    <?php } ?>
  </div>
</body>

</html>