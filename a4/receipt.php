<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
</head>
<body>
    <?php
    echo "<h1>Welcome to the receipt page......</h1>";
        $custname = $_POST['cust']['name'];
        $custemail = $_POST['cust']['email'];
        $custmobile = $_POST['cust']['mobile'];
        $custcard = $_POST['cust']['card'];
        $custexpiry = $_POST['cust']['name'];
    ?>
    <p>Hello <?php echo $custname?></p>
</body>
</html>