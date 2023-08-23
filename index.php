<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nepa Hotel Booking</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Fontawesome js -->
    <script src="https://kit.fontawesome.com/caa7c84843.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include("components/header.php"); ?>
    <!-- Order finished message -->
    <?php
    if (isset($_SESSION['finished'])) {
        echo "<script type='text/javascript'>alert('{$_SESSION['finished']}');</script>";
        unset($_SESSION['finished']);
    }
    ?>

    <form class="slide" action="hotel.php" method="get">
        <input class="border" type="text" name="search">
        <button class="border">Search</button>
    </form>
    <div class="featured">
        <?php
        $id = $userdata['id'];
        $sql = "SELECT * FROM rating WHERE id = '$id'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
        ?>

            <h1 class="text-center">Recommend For You</h1>
            <div class="items">

                <?php
                include("recommend_test.php");

                foreach ($recommend_list as $key => $value) {

                    $sql = "SELECT * FROM hotels WHERE hotel_name = '$key' AND active = 'yes'";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                        <a href="desc.php?id=<?php echo $row['hid']; ?>" class="item">
                            <img src="hmanager/upload/<?php echo $row['hotel_img']; ?>" alt="hotels_img">
                            <h3><?php echo $row['hotel_name']; ?></h3>
                        </a>
                <?php }
                }
                ?>
            </div>
        <?php
        }
        ?>
        <h1 class="text-center">Popular Hotels</h1>
        <div class="items">
            <?php
            $sql = "SELECT * FROM rating WHERE rate >= '4' LIMIT 3";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $hid = $row['hid'];
                $ssql = "SELECT * FROM hotels WHERE hid = '$hid' AND active = 'yes'";
                $rresult = mysqli_query($con, $ssql);
                while ($rrow = mysqli_fetch_array($rresult)) {
            ?>
                    <a href="desc.php?id=<?php echo $rrow['hid']; ?>" class="item">
                        <img src="hmanager/upload/<?php echo $rrow['hotel_img']; ?>" alt="hotels_img">
                        <h3><?php echo $rrow['hotel_name']; ?></h3>
                    </a>
            <?php }
            }
            ?>
        </div>
    </div>

    <?php include("components/footer.php"); ?>

    <script src="js/index.js"></script>

</body>

</html>