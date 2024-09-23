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
  <?php include("hheader.php"); 

      $username = $userdata['username'];
    
    if(isset($_POST['save'])){

      $hotel_name = $_POST['hotel_name'];
      $hotel_address = $_POST['hotel_address'];
      $hotel_desc = $_POST['hotel_desc'];

      $qquery = "SELECT * FROM hotels WHERE hotel_name = '$hotel_name'";
      $rrresult = mysqli_query($con,$qquery);
      if($rrresult && mysqli_num_rows($rrresult) == 0){

      //store img file
      if (isset($_FILES['hotel_img']['name'])) {

        $hotel_img = $_FILES['hotel_img']['name'];

        // auto rename our hotel_img
        // get the extension of our hotel_img (jpg,png)
        $tmp = explode('.', $hotel_img);
        $fileExtension = end($tmp);

        // rename the hotel_img
        $hotel_img = "hotel" . rand(0, 9999999) . '.' . $fileExtension;

        $sourcepath = $_FILES['hotel_img']['tmp_name'];
        $destination = "upload/" . $hotel_img;

        // Upload hotel_img
        $upload = move_uploaded_file($sourcepath, $destination);
        if ($upload == false) {
            $_SESSION['s'] = "Failed to upload hotel_img!";
        }
      }
      if ($upload == true) {
        //save to database
        $query = "INSERT INTO `hotels` (`hotel_name`, `hotel_img`, `hotel_desc`,`hotel_address`, `manager`, `active`) 
        VALUES ('$hotel_name', '$hotel_img', '$hotel_desc','$hotel_address', '$username' , 'no')";
        $result = mysqli_query($con, $query);
        if($result){
          $_SESSION['save'] = "Save Successfully!";
        }
      }
    }else{
      $_SESSION['msg'] = "Hotel name is already taken!";
    }
  }

  ?>
    <div class="container px">
      <h2>Profile</h2>
      <?php
        if (isset($_SESSION['save'])) {
            echo $_SESSION['save'];
            unset($_SESSION['save']);
        }
        if (isset($_SESSION['s'])) {
            echo $_SESSION['s'];
            unset($_SESSION['s']);
        }
      ?>
      <?php 
        $sql = "SELECT * FROM hotels WHERE manager = '$username' AND active = 'no'";
        $result = mysqli_query($con,$sql);
        $ssql = "SELECT * FROM hotels WHERE manager = '$username' AND active = 'yes'";
        $rresult = mysqli_query($con,$ssql);
        if($result && mysqli_num_rows($result) > 0){
      ?>

      <!-- If user send hotel request -->

      <h2 class="text-center">Request Send</h2>
      <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
      ?>

      <!-- If hotel is approve -->

      <?php 
        }elseif($rresult && mysqli_num_rows($rresult) > 0){
         $sql = "SELECT * FROM hotels WHERE active = 'yes' AND manager = '$username'";
         $result = mysqli_query($con,$sql);
         while($row = mysqli_fetch_array($result)){
        ?>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

      <form action="update.php" method="post" enctype="multipart/form-data">
        <div class="hinfo px">
          <div class="img py">
            <img src="upload/<?php echo $row['hotel_img']; ?>" alt="Image" /><br />
            <input type="file" name="hotel_img" value="<?php echo $row['hotel_img']; ?>" accept="image/*"/>
            <input type="hidden" name="current_img" value="<?php echo $row['hotel_img']; ?>" accept="image/*" />
            <input type="hidden" name="hid" value="<?php echo $row['hid']; ?>" />
          </div>
          <div class="desc">
            <table>
              <tr>
                <th>Name:</th>
                <td><input type="text" name="hotel_name" value="<?php echo $row['hotel_name']; ?>" /></td>
              </tr>
              <tr>
                <th>Description:</th>
                <td><textarea name="hotel_desc" id="hotel_desc" cols="30" rows="10" ><?php echo $row['hotel_desc']; ?></textarea></td>
              </tr>
              <tr>
                <th>Address:</th>
                <td><input type="text" name="hotel_address" value="<?php echo $row['hotel_address']; ?>" /></td>
              </tr>
            </table>
          </div>
        </div>
        <button type="submit" name="update">Update</button>
      </form>

      <?php }}else{ ?>

        <!-- If is not approve -->

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="hinfo px">
          <div class="img py">
            <img src="../upload/hotel2.jpg" alt="hotel_img" /><br />
            <input type="file" name="hotel_img" accept="hotel_img/*" required/>
          </div>
          <div class="desc">
            <table>
              <tr>
                <th>Name:</th>
                <td><input type="text" name="hotel_name" required/></td>
              </tr>
              <tr>
                <th>Description:</th>
                <td><textarea name="hotel_desc" id="hotel_desc" cols="30" rows="10" required></textarea></td>
              </tr>
              <tr>
                <th>Address:</th>
                <td><input type="text" name="hotel_address" required/></td>
              </tr>
            </table>
          </div>
        </div>
        <button type="submit" name="save" onclick="return confirm('Are you sure want to save?')">Save</button>
      </form>

      <?php } ?>
    </div>
  </body>
</html>
