<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
  	<?php include("aheader.php"); 
      
      $sql = "SELECT * FROM account";
      $result = mysqli_query($con,$sql);
      $account = mysqli_num_rows($result);

      $sql = "SELECT * FROM hotels";
      $result = mysqli_query($con,$sql);
      $hotel = mysqli_num_rows($result);
      
    ?>
    <div class="container px">
        <h1 class="text-center px">Admin Dashboard</h1>
        <div class="row">
            <div class="a px">
                <h2>Number of Accounts: <?php echo $account; ?></h2>
            </div>
            <div class="a px">
                <h2>Number of Hotels: <?php echo $hotel; ?></h2>
            </div>
        </div>
    </div>
</body>
</html>