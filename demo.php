<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rating.css">
    <title>Document</title>
    <style>
        *{
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
            overflow: hidden;
        }
    </style>
</head>
<body>
        <div class="star-wrapper">
            <a href="rating.php?rate=5" class="fas fa-star s1" onclick="return confirm('Are you sure want to rate?')" title="5"></a>
            <a href="rating.php?rate=4" class="fas fa-star s2" onclick="return confirm('Are you sure want to rate?')" title="4"></a>
            <a href="rating.php?rate=3" class="fas fa-star s3" onclick="return confirm('Are you sure want to rate?')" title="3"></a>
            <a href="rating.php?rate=2" class="fas fa-star s4" onclick="return confirm('Are you sure want to rate?')" title="2"></a>
            <a href="rating.php?rate=1" class="fas fa-star s5" onclick="return confirm('Are you sure want to rate?')" title="1"></a>
        </div>


        <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
</body>
</html>