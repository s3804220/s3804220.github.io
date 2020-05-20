<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link id='stylecss' type="text/css" rel="stylesheet" href="receipt-style.css">
    <?php include 'tools.php';?>
</head>
<body>
    <?php
    if(empty($_SESSION)){
        header("Location: index.php");
    }
    echo "<h1>Welcome to the receipt page......</h1>";
    preShow($_SESSION);
    $fp = fopen("bookings.txt", "a");
    foreach($_SESSION['cart'] as $record){
        fputcsv($fp, $record, "\t");
    }
    fclose($fp);
    ?>

    <h1 style="text-align: center;">Tax Invoice </h1>

    <div class="page">
        <h1 style="text-align: center;">CINEMAX Entertainment Inc. </h1>
        <h1 style="text-align: center;">ABN number: 00 123 456 789  </h1>
        <br><br>
        <h2>Customer Information</h2>
        <p>Name: <?php echo $_SESSION['cart']['cust']['name']?></p>
        <p>Email <?php echo $_SESSION['cart']['cust']['email']?></p>
        <p>Mobile: <?php echo $_SESSION['cart']['cust']['mobile']?></p>
        <br>
        <h2>Movie Information</h2>
        <p>Movie date: <?php echo $_SESSION['cart']['movie']['day']?></p>
        <p>Movie hour code: <?php echo $_SESSION['cart']['movie']['hour']?></p>
        <p>Movie ID: <?php echo $_SESSION['cart']['movie']['id']?></p>
    </div>
</body>
</html>