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
    <h2>Categories</h2>
    <?php
    $username = $userdata['username'];
    $sql = "SELECT * FROM hotels WHERE manager = '$username' AND active = 'no'";
    $result = mysqli_query($con, $sql);
    $ssql = "SELECT * FROM hotels WHERE manager = '$username' AND active = 'yes'";
    $rresult = mysqli_query($con, $ssql);
    if ($result && mysqli_num_rows($result) > 0) {
    ?>
      <h2 class="text-center">Request Send</h2>
    <?php } elseif ($rresult && mysqli_num_rows($rresult) > 0) { ?>
      <br>
      <?php
      $manager = $userdata['username'];
      $ssql = "SELECT * FROM hotels WHERE manager = '$manager'";
      $rrresult = mysqli_query($con, $ssql);
      $hotel = mysqli_fetch_array($rrresult);
      $hotel_name = $hotel['hotel_name'];
      $hid = $hotel['hid'];

      if (isset($_POST['add'])) {

        $cname = $_POST['cname'];
        $cprice = $_POST['cprice'];
        $cdesc = $_POST['cdesc'];

        //store img file
        if (isset($_FILES['cimg']['name'])) {

          $cimg = $_FILES['cimg']['name'];

          // auto rename our cimg
          // get the extension of our cimg (jpg,png)
          $tmp = explode('.', $cimg);
          $fileExtension = end($tmp);

          // rename the cimg
          $cimg = "categories" . rand(0, 9999999) . '.' . $fileExtension;

          $sourcepath = $_FILES['cimg']['tmp_name'];
          $destination = "upload/categories/" . $cimg;

          // Upload cimg
          $upload = move_uploaded_file($sourcepath, $destination);
          if ($upload == false) {
            $_SESSION['add'] = "Failed to upload image!";
          }
        }
        if ($upload == true) {
          //save to database
          $query = "INSERT INTO `categories` (`cname`, `cimg`,`cprice`, `hid`, `cdesc`) 
                  VALUES ('$cname', '$cimg','$cprice', '$hid', '$cdesc')";
          $result = mysqli_query($con, $query);
          if ($result) {
            $_SESSION['add'] = "Save Successfully!";
          }
        }
      }
      ?>
      <h3>Add Categories</h3>
      <form action="" method="post" enctype="multipart/form-data">
        <br>
        <?php
        if (isset($_SESSION['add'])) {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
          echo "<br><br>";
        }
        ?>
        <label for="cname">Name</label>
        <input type="text" name="cname" id="cname" required>
        <input type="file" name="cimg" id="cimg" required>
        <br><br>
        <label for="cdesc">Description</label>
        <textarea name="cdesc" id="cdesc" cols="30" rows="2"></textarea>
        <label for="cprice">Price</label>
        <input type="number" name="cprice" min="0" required>
        <button class="btn" name="add">Add</button>
      </form>
      <br>
      <table class="ctable">
        <tr>
          <th>SNo.</th>
          <th>Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Desc</th>
          <th></th>
        </tr>
        <?php
        $sn = 1;
        $sql = "SELECT * FROM categories WHERE hid = '$hid'";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $row['cname']; ?></td>
            <td><img src="upload/categories/<?php echo $row['cimg']; ?>" alt="image" width="100px"></td>
            <td><?php echo $row['cprice']; ?></td>
            <td>
              <pre><?php echo $row['cdesc']; ?></pre>
            </td>
            <td>
              <!-- <a href="edit.php?cid=<?php echo $row['cid'] ?>">Edit</a> -->
              <a href="../components/delete.php?cid=<?php echo $row['cid'] ?>&location=../hmanager/hcategories.php&cimg=<?php echo $row['cimg'] ?>" onclick="return confirm('Are you sure want to delete?')">Delete</a>
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