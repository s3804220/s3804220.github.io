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
        <h2>Seat Information</h2>
        <br><br>
        <?php
        echo "<table style='width:100%;'>";
        echo "<tr>";
        echo "<th> Seat code: </th>";
        echo "<th> Quantiy: </th>";
        echo "<th> Price: </th>";
            if ($_SESSION['cart']['seats']['STA'] > 0){
                echo "<tr>";
                echo "<td style='text-align: center;'>STA</td>";
                echo "<td style='text-align: center;'>".$_SESSION['cart']['seats']['STA']."</td>";
                echo "</tr>";
            }
            if ($_SESSION['cart']['seats']['STP'] > 0){
                echo "<tr>";
                echo "<td style='text-align: center;'>STP</td>";
                echo "<td style='text-align: center;'>".$_SESSION['cart']['seats']['STP']."</td>";
                echo "</tr>";
            }
            if ($_SESSION['cart']['seats']['STC'] > 0){
                echo "<tr>";
                echo "<td style='text-align: center;'>STC</td>";
                echo "<td style='text-align: center;'>".$_SESSION['cart']['seats']['STC']."</td>";
                echo "</tr>";
            }
            if ($_SESSION['cart']['seats']['FCA'] > 0){
                echo "<tr>";
                echo "<td style='text-align: center;'>FCA</td>";
                echo "<td style='text-align: center;'>".$_SESSION['cart']['seats']['FCA']."</td>";
                echo "</tr>";
            }
            if ($_SESSION['cart']['seats']['FCP'] > 0){
                echo "<tr>";
                echo "<td style='text-align: center;'>FCP</td>";
                echo "<td style='text-align: center;'>".$_SESSION['cart']['seats']['FCP']."</td>";
                echo "</tr>";
            }
            if ($_SESSION['cart']['seats']['FCC'] > 0){
                echo "<tr>";
                echo "<td style='text-align: center;'>STA</td>";
                echo "<td style='text-align: center;'>".$_SESSION['cart']['seats']['FCC']."</td>";
                echo "</tr>";
            }
        echo "</table>";
        ?>
    </div>
</body>
</html>