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
        <h1>Accounts</h1>
            <table>
                <?php
                        if (isset($_SESSION['delete'])) {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                ?>
                <tr>
                    <th>SNo.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>role</th>
                    <th>Password</th>
                </tr>
                <?php 
                    $sn = 1;
                    $sql = "SELECT * FROM account ORDER BY role";
                    $result = mysqli_query($con,$sql);
                    while($row = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id'] ?>">Edit</a>
                        <a href="../components/delete.php?id=<?php echo $row['id'] ?>&location=../admin/account.php" onclick="return confirm('Are you sure want to delete?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
    </div>
</body>
</html>