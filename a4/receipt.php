<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <?php include 'tools.php';?>
</head>
<body>
    <?php
    if(empty($_SESSION)){
        header("Location: index.php");
    }
    echo "<h1>Welcome to the receipt page......</h1>";
    preShow($_SESSION);
    ?>
</body>
</html>