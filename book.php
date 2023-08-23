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
  <?php
  if (isset($_GET['rid']) && isset($_GET['cid'])) {
    // store rid from link
    $rid = $_GET["rid"];
    $cid = $_GET["cid"];

    $result = mysqli_query($con, "SELECT * FROM rooms WHERE rid =$rid AND cid = $cid");
    if (mysqli_num_rows($result) < 1) {
      header('Location: hotel.php');
      die;
    }

    $result = mysqli_query($con, "SELECT * FROM rooms WHERE rid =$rid");
    $room = mysqli_fetch_array($result);

    $rresult = mysqli_query($con, "SELECT * FROM categories WHERE cid =$cid");
    $category = mysqli_fetch_array($rresult);
    $hid = $category['hid'];

    $rresult = mysqli_query($con, "SELECT * FROM hotels WHERE hid =$hid");
    $hotel = mysqli_fetch_array($rresult);
    $hotel_name = $hotel['hotel_name'];

    if (isset($_POST['book'])) {

      if (isset($_POST['fname']) && isset($_POST['contact']) && isset($_POST['email']) && isset($_POST['checked_in']) && isset($_POST['days'])) {

        $username = $userdata['username'];
        $fname = $_POST['fname'];
        $contact = $_POST['contact'];
        $checked_in = $_POST['checked_in'];
        $email = $_POST['email'];
        $room_no = $room['room'];
        $days = $_POST['days'];
        $amount = $days * $category['cprice'];
        $hid = $hotel['hid'];


        $sql = "INSERT INTO `booking` (`username`, `fname`, `rid`, `room_no`,`hid`, `contact`, `email`, `checked_in`, `checked_out`, `days`, `amount`, `adate`) 
              VALUES ('$username', '$fname', '$rid', '$room_no','$hid', '$contact', '$email', '$checked_in', '0', '$days', '$amount', CURRENT_TIMESTAMP);";
        if (mysqli_query($con, $sql)) {
          $_SESSION['finished'] = "Booked Successful!";

          //save to database
          $query = "UPDATE `rooms` SET
              status = 'no'
              WHERE room='$room_no'
              ";
          mysqli_query($con, $query);

          header("Location: index.php");
          die;
        }
      } else {
        $_SESSION['msg'] = "Please enter all input!";
      }
    }
  } else {
    header('Location: hotel.php');
  }
  ?>

  <div class="container px">
    <h1>Booking</h1>
    <div class="description">
      <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      ?>
      <form action="" method="post">
        <h2><u>Information</u></h2>
        <script>
          setInterval(() => {
            let a = document.getElementById("days").value;
            let text = a * <?php echo $category['cprice']; ?>;
            document.getElementById("myP").innerHTML = text;
          }, 100);
        </script>
        <table>
          <tr>
            <th class="py"><label for="fname">Full Name</label></th>
            <td><input class="sinput" type="text" name="fname" id="fname"></td>
          </tr>
          <tr>
            <th class="py"><label for="email">Email</label></th>
            <td><input class="sinput" type="email" name="email" id="email" required></td>
          </tr>
          <tr>
            <th class="py"><label for="contact">Contact</label></th>
            <td><input class="sinput" type="text" name="contact" id="contact" required></td>
          </tr>
          <tr>
            <th class="py">
              <label for="datemin"><strong>Date</strong></label><br>
            </th>
            <td>
              <input type="date" id="checked_in" name="checked_in" max="<?php echo date("Y-m-d", strtotime("+3 day")); ?>" min="<?php echo date("Y-m-d", strtotime("+1 day")); ?>" required>
            </td>
          </tr>
          <tr>
            <th class="py"><label for="days">Days Stay</label></th>
            <td><input class="sinput" type="number" name="days" id="days" min="1" max="7" required></td>
          </tr>
        </table>
        <Button class="btn" type="submit" name="book">Book</Button>
      </form>

      <div class="voucher">
        <h2><u>Voucher</u></h2>
        <pre class="px">
                    Hotel : <span><?php echo $hotel['hotel_name']; ?></span>
                    Room Categories : <span><?php echo $category['cname']; ?></span>
                    Room no : <span><?php echo $room['room'] ?></span>
                    Total Amount : <span id="myP"></span>
                </pre>
      </div>
    </div>
  </div>

  <script src="js/index.js"></script>
</body>

</html>