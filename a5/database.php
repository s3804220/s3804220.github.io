<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
    <?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "shopDatabase";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS shopDatabase";
    mysqli_query($conn, $sql);
    /*if ($conn->query($sql) === TRUE) {
        echo "<p>Database created successfully</p>";
    } else {
        echo "Error creating database: " . $conn->error;
    }*/

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS Products (
        id VARCHAR(10) PRIMARY KEY,
        productname VARCHAR(100) NOT NULL,
        price FLOAT NOT NULL,
        descript TEXT NOT NULL,
        product_type VARCHAR(100) NOT NULL,
        main_image VARCHAR(255) NOT NULL
        )";
    mysqli_query($conn, $sql);
    /*if (mysqli_query($conn, $sql)) {
      echo "<p>Table Products created successfully</p>";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }*/

    $sql = "CREATE TABLE IF NOT EXISTS AdminUsers (
        id VARCHAR(10) PRIMARY KEY,
        pass VARCHAR(30) NOT NULL
        )";
    mysqli_query($conn, $sql);

    //insert products into database
    $sql = "INSERT INTO Products
    VALUES ('PD001', 'Bandana Black', 17.25, 'Placeholder text for Bandana Black', 'Bandana', 'bandana-black.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD002', 'Bandana Blue', 17.25, 'Placeholder text for Bandana Blue', 'Bandana', 'bandana-blue.png');";
    $sql .= "INSERT INTO Products
    VALUES ('PD003', 'Bandana Skull', 25.60, 'Placeholder text for Bandana Skull', 'Bandana', 'bandana-skull.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD004', 'Medical Mask White', 27, 'Placeholder text for Medical Mask White', 'Medical Mask', 'medical-mask-white.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD005', 'Medical Mask Blue', 20, 'Placeholder text for Medical Mask Blue', 'Medical Mask', 'medical-mask-blue.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD006', 'Medical Mask Black', 17.55, 'Placeholder text for Medical Mask Black', 'Medical Mask', 'medical-mask-black.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD007', 'Dust Mask Black With Filter', 25.30, 'Placeholder text for Dust Mask Black With Filter', 'Dust Mask', 'dusk-mask-black-filter.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD008', 'Dust Mask M3', 31.45, 'Placeholder text for Dust Mask M3', 'Dust Mask', 'dust-mask.jpg');";

    mysqli_multi_query($conn, $sql);
    /*if (mysqli_multi_query($conn, $sql)) {
        echo "<p>New records created successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }*/

    //insert admin accounts into database
    $sql = "INSERT INTO AdminUsers
    VALUES ('ADM001','PasS001');";
    $sql .= "INSERT INTO AdminUsers
    VALUES ('ADM002','PasS002');";
    mysqli_multi_query($conn, $sql);

    //Sanitize input
    function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    //When admin uploads, add product into database
    if(isset($_POST['addproduct'])) {
        $target = "media/product/".basename($_FILES['image1']['name']);
        $image = $_FILES['image1']['name'];
        $id = $_POST['product']['id'];
        $name = $_POST['product']['name'];
        $description = $_POST['product']['des'];
        $type = $_POST['product']['type'];
        $price = $_POST['product']['price'];

        $sql = "INSERT INTO Products
        VALUES ('$id', '$name', $price, '$description', '$type', '$image')";
        mysqli_query($conn, $sql);
        /*if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }*/
        move_uploaded_file($_FILES['image1']['tmp_name'], $target);
    }

    //When admin logins, validates account in database
    if(isset($_POST['login'])) {
        $loginmsg = '';
        $userid = $_POST['userid'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM AdminUsers WHERE id='$userid' AND pass='$pass'";
        $match = mysqli_query($conn, $sql);
        if (mysqli_num_rows($match)==0){
            $loginmsg = "<p style='color: red; text-align: center;'>Login failed. Incorrect user ID or password.</p>";
        }
        else {
            $_SESSION['admin']=[$_POST['userid'], $_POST['password']];
            $loginmsg = "<p style='color: green; text-align: center;'>Login successfully!</p>";
        }
    }

    $allCategory = "SELECT distinct product_type FROM Products";
    $getCategory = mysqli_query($conn, $allCategory) or die(mysqli_error());
    $categoryarray = array();
    while($row = mysqli_fetch_assoc($getCategory)) {
        $categoryarray[] = $row;
    }

    $allAdmins = "SELECT distinct id FROM AdminUsers";
    $getAdmins = mysqli_query($conn, $allAdmins) or die(mysqli_error());
    $adminarray = array();
    while($row = mysqli_fetch_assoc($getAdmins)) {
        $adminarray[] = $row['id'];
    }

    //When admin add another admin user, add account into database
    if(isset($_POST['addadmin'])) {
        $adminiderr = '';
        $adminpasserr = '';
        $adminpass2err = '';

        $adminerrnum = 0;
        if(empty($_POST['newad']['id'])){
            $adminiderr = "<p class='error'>ID field cannot be empty</p>";
            $adminerrnum++;
        }
        else {
            $adminid = test_input($_POST['newad']['id']);
            if (!preg_match("/^(ADM)\d+$/", $adminid)){
                $adminiderr = "<p class='error'>ID must be 'ADM' followed by at least 1 number</p>";
                $adminerrnum++;
            }
            else if (in_array($adminid, $adminarray)){
                $adminiderr = "<p class='error'>Admin ID already exists!</p>";
                $adminerrnum++;
            }
        }
        if(empty($_POST['newad']['pass'])){
            $adminpasserr = "<p class='error'>Password cannot be empty</p>";
            $adminerrnum++;
        }
        else {
            $adminpass = test_input($_POST['newad']['pass']);
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/", $adminpass)){
                $adminpasserr = "<p class='error'>Password must be at least 6 characters,<br>contains 1 upper case, 1 lower case and 1 number</p>";
                $adminerrnum++;
            }
        }
        if(empty($_POST['newad']['pass2'])){
            $adminpass2err = "<p class='error'>Password cannot be empty</p>";
            $adminerrnum++;
        }
        else {
            $adminpass2 = test_input($_POST['newad']['pass2']);
            if ($adminpass!==$adminpass2){
                $adminpass2err = "<p class='error'>Two passwords do not match!</p>";
                $adminerrnum++;
            }
        }
        if ($adminerrnum == 0){
            $insertadmin = "INSERT INTO AdminUsers
            VALUES ('$adminid','$adminpass')";
            mysqli_query($conn, $insertadmin);
            $adminpass2err = "<p class='success'>Create new admin successfully!</p>";
            unset($_POST['newad']['id']);
        }
    }

    mysqli_close($conn);
?> 
</body>
</html>