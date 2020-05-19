<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to web icon-->
    <!-- Creative Commons image sourced from https://www.freelogodesign.org/preview?lang=en&name=&logo=3cb08b7e-706d-4539-a663-82c8ea221204 and used for educational purposes only -->
    <link rel="icon" href="media/icon.png">
    <title>Cinemax - Receipt</title>
</head>
<body>
    <h1>Thank you for your money :3</h1>
    <?php
        $custname = $_POST['cust']['name'];
        $custemail = $_POST['cust']['email'];
        $custmobile = $_POST['cust']['mobile'];
        $custcard = $_POST['cust']['card'];
        $custexpiry = $_POST['cust']['name'];
    ?>
    <p>Hello <?php echo $custname?></p>
</body>
</html>