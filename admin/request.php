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
    <?php include("aheader.php"); ?>
    <div class="account container">
        <h1>Request</h1>
        <?php
                    if (isset($_SESSION['approve'])) {
                        echo $_SESSION['approve'];
                        unset($_SESSION['approve']);
                    }
                    if (isset($_SESSION['delete'])) {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
            ?>
        <table>
            <tr>
                <th>SNo.</th>
                <th>Image</th>
                <th>Hotel Name</th>
                <th>Description</th>
                <th>Address</th>
                <th>Manager</th>
            </tr>
            <?php 
                $sn = 1;
                $sql = "SELECT * FROM hotels WHERE active = 'no'";
                $result = mysqli_query($con,$sql);
                while($row = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><img src="../hmanager/upload/<?php echo $row['hotel_img']; ?>" alt="image" width="100px"></td>
                <td><?php echo $row['hotel_name']; ?></td>
                <td><?php echo $row['hotel_desc']; ?></td>
                <td><?php echo $row['hotel_address']; ?></td>
                <td><?php echo $row['manager']; ?></td>
                <td>
                    <a href="approve.php?hid=<?php echo $row['hid'] ?>&location=request.php" onclick="return confirm('Are you sure want to approve?')">Approve</a>
                    <a href="../components/delete.php?hid=<?php echo $row['hid'] ?>&location=../admin/request.php" onclick="return confirm('Are you sure want to delete?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>