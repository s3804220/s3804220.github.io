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
    VALUES ('PD001', 'Bandana Black', 17.25, 'Placeholder text for Bandana Black', 'Bandana', 'bandana-black.jpg|bandana-black2.jpg|bandana-black3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD002', 'Bandana Blue', 17.25, 'Placeholder text for Bandana Blue', 'Bandana', 'bandana-blue.jpg|bandana-blue2.jpg|bandana-blue3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD003', 'Bandana Skull', 25.60, 'Placeholder text for Bandana Skull', 'Bandana', 'bandana-skull.jpg|bandana-skull2.jpg|bandana-skull3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD004', 'Medical Mask White', 27, 'Placeholder text for Medical Mask White', 'Medical Mask', 'medical-mask-white.jpg|medical-mask-white2.jpg|medical-mask-white3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD005', 'Medical Mask Blue', 20, 'Placeholder text for Medical Mask Blue', 'Medical Mask', 'medical-mask-blue.jpg|medical-mask-blue2.jpg|medical-mask-blue3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD006', 'Medical Mask Black', 17.55, 'Placeholder text for Medical Mask Black', 'Medical Mask', 'medical-mask-black.jpg|medical-mask-black2.jpg|medical-mask-black3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD007', 'Dust Mask Black With Filter', 25.30, 'Placeholder text for Dust Mask Black With Filter', 'Dust Mask', 'dust-mask-black-filter.jpg|dust-mask-black-filter2.jpg|dust-mask-black-filter3.jpg');";
    $sql .= "INSERT INTO Products
    VALUES ('PD008', 'Dust Mask M3', 31.45, 'Placeholder text for Dust Mask M3', 'Dust Mask', 'dust-mask.jpg|dust-mask2.jpg|dust-mask3.jpg');";

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

    $allCategory = "SELECT distinct product_type FROM Products";
    $getCategory = mysqli_query($conn, $allCategory) or die(mysqli_error());
    $categoryarray = array();
    while($row = mysqli_fetch_assoc($getCategory)) {
        $categoryarray[] = $row['product_type'];
    }

    $allProduct = "SELECT id FROM Products";
    $getProduct = mysqli_query($conn, $allProduct) or die(mysqli_error());
    $productarray = array();
    while($row = mysqli_fetch_assoc($getProduct)) {
        $productarray[] = $row['id'];
    }

    $allAdmins = "SELECT id FROM AdminUsers";
    $getAdmins = mysqli_query($conn, $allAdmins) or die(mysqli_error());
    $adminarray = array();
    while($row = mysqli_fetch_assoc($getAdmins)) {
        $adminarray[] = $row['id'];
    }

    //When admin uploads, add product into database
    if(isset($_POST['addproduct'])) {
        $addpiderr = '';
        $addpnameerr = '';
        $addpdeserr = '';
        $addpriceerr = '';
        $addimgerr = '';
        $targetdir = "media/product/";
        $allowTypes = array('jpg','png','jpeg','gif');
        $type = test_input($_POST['product']['type']);
        $addproderr = 0;

        if(empty($_POST['product']['id'])){
            $addpiderr = "<p class='error'>Product ID is required</p>";
            $addproderr++;
        }
        else {
            $prodid = test_input($_POST['product']['id']);
            if(!preg_match("/^(PD)\d+$/", $prodid)){
                $addpiderr = "<p class='error'>ID must be 'PD' followed by at least 1 number</p>";
                $addproderr++;
            }
            else if(in_array($prodid, $productarray)){
                $addpiderr = "<p class='error'>Product ID already exists!</p>";
                $addproderr++;
            }
        }
        if(empty($_POST['product']['name'])){
            $addpnameerr = "<p class='error'>Product name is required</p>";
            $addproderr++;
        }
        else {
            $prodname = test_input($_POST['product']['name']);
            if(!preg_match("/^[\w\-]+[\s]?([\w\-]+[\s]?)+$/", $prodname)){
                $addpnameerr = "<p class='error'>Name can only contain alphabetical characters, numbers, - _ and white space</p>";
                $addproderr++;
            }
        }
        if(empty($_POST['product']['des'])) {
            $addpdeserr = "<p class='error'>Please provide a description for your product!</p>";
            $addproderr++;
        }
        else {
            $proddes = test_input($_POST['product']['des']);
        }
        if(empty($_POST['product']['price'])){
            $addpriceerr = "<p class='error'>Please enter a price for the product!</p>";
            $addproderr++;
        }
        else {
            $addprice = test_input($_POST['product']['price']);
            if(!preg_match("/^(?:\d+|\d+\.\d+)$/", $addprice)){
                $addpriceerr = "<p class='error'>Price can only be a positive float number!</p>";
                $addproderr++;
            }
        }
        print_r($_FILES['productimg']);
        if(empty($_FILES['productimg']['name'])){
            $addimgerr = "<p class='error'>Please upload at least 1 image</p>";
            $addproderr++;
        }
        else {
            foreach($_FILES['productimg']['name'] as $key=>$val){
                echo filesize($_FILES['productimg']['tmp_name'][$key]);
                $imgType = pathinfo($val, PATHINFO_EXTENSION);
                if($_FILES['productimg']['error'][$key]==4){
                    $addimgerr = "<p class='error'>Please upload at least 1 image</p>";
                    $addproderr++;
                }
                else if(!in_array($imgType, $allowTypes)){
                    $addimgerr = "<p class='error'>Only .jpg .jpeg .png or .gif images allowed!</p>";
                    $addproderr++;
                    break;
                }
                else if($_FILES['productimg']['size'][$key] > 5242880) {
                    $addimgerr = "<p class='error'>Max file size is 5MB!</p>";
                    $addproderr++;
                    break;
                }
                else if($_FILES['productimg']['error'][$key] ==1) {
                    $addimgerr = "<p class='error'>Max file size is 5MB!</p>";
                    $addproderr++;
                    break;
                }
            }
        }
        if($addproderr==0){
            $imgarray = implode("|",$_FILES['productimg']['name']);
            $insertproduct = "INSERT INTO Products
            VALUES ('$prodid','$prodname',$addprice,'$proddes','$type','$imgarray')";
            mysqli_query($conn, $insertproduct);
            foreach($_FILES['productimg']['name'] as $key=>$val){
                $imgName = basename($_FILES['productimg']['name'][$key]);
                $targetFilePath = $targetdir . $imgName;
                move_uploaded_file($_FILES['productimg']['tmp_name'][$key], $targetFilePath);
            }
            $addimgerr = "<p class='success'>Product added successfully!</p>";
            unset($_POST['product']);
        }
    }

    //When admin logins, validates account in database
    if(isset($_POST['login'])) {
        $loginmsg = '';
        $userid = $_POST['userid'];
        $pass = $_POST['password'];

        $login = "SELECT * FROM AdminUsers WHERE id='$userid' AND pass='$pass'";
        $match = mysqli_query($conn, $login);
        if (mysqli_num_rows($match)==0){
            $loginmsg = "<p style='color: red; text-align: center;'>Login failed. Incorrect user ID or password.</p>";
        }
        else {
            $_SESSION['admin']=[$_POST['userid'], $_POST['password']];
            $loginmsg = "<p style='color: green; text-align: center;'>Login successfully!</p>";
        }
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
    //Update admin's account in database
    if(isset($_POST['updateadmin'])) {
        $oldiderr = '';
        $oldpasserr = '';
        $newpasserr = '';
        $newpass2err = '';
        $adid = $_POST['oldad']['id'];
        $pass = $_POST['oldad']['pass'];
        $updateadnum = 0;
        $selectad = "SELECT * FROM AdminUsers WHERE id='$adid' AND pass='$pass'";
        $match = mysqli_query($conn, $selectad);

        if(empty($_POST['oldad']['id'])){
            $oldiderr = "<p class='error'>Please enter an ID</p>";
            $updateadnum++;
        }
        if(empty($_POST['oldad']['pass'])){
            $oldpasserr = "<p class='error'>Please enter the password</p>";
            $updateadnum++;
        }
        else if(mysqli_num_rows($match)==0){
            $oldpasserr = "<p class='error'>Invalid user ID or password.</p>";
            $updateadnum++;
        }
        else {
            if(empty($_POST['oldad']['newpass'])){
                $newpasserr  = "<p class='error'>Password cannot be empty</p>";
                $updateadnum++;
            }
            else {
                $newpass = test_input($_POST['oldad']['newpass']);
                if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/", $newpass)){
                    $newpasserr = "<p class='error'>Password must be at least 6 characters,<br>contains 1 upper case, 1 lower case and 1 number</p>";
                    $updateadnum++;
                }
            }
            if(empty($_POST['oldad']['newpass2'])){
                $newpass2err = "<p class='error'>Password cannot be empty</p>";
                $updateadnum++;
            }
            else {
                $newpass2 = test_input($_POST['oldad']['newpass2']);
                if ($newpass!==$newpass2){
                    $newpass2err = "<p class='error'>Two passwords do not match!</p>";
                    $updateadnum++;
                }
            }
        }
        if ($updateadnum == 0){
            $updateadmin = "UPDATE AdminUsers
            SET pass='$newpass' WHERE id='$adid'";
            mysqli_query($conn, $updateadmin);
            $newpass2err = "<p class='success'>Update admin password successfully!</p>";
            unset($_POST['oldad']['id']);
        }
    }
    //Delete admin's account from database
    if(isset($_POST['deladmin'])) {
        $deleteiderr = '';
        $deletepasserr = '';
        $delid = test_input($_POST['delad']['id']);
        $delpass = test_input($_POST['delad']['pass']);
        $selectad = "SELECT * FROM AdminUsers WHERE id='$delid' AND pass='$delpass'";
        $match = mysqli_query($conn, $selectad);
        $deleteadnum = 0;
        if(empty($_POST['delad']['id'])){
            $deleteiderr = "<p class='error'>Please enter an ID</p>";
            $deleteadnum++;
        }
        if(empty($_POST['delad']['pass'])){
            $deletepasserr = "<p class='error'>Please enter the password</p>";
            $deleteadnum++;
        }
        else if(mysqli_num_rows($match)==0){
            $deletepasserr = "<p class='error'>Invalid user ID or password.</p>";
            $deleteadnum++;
        }
        if($deleteadnum==0){
            $delad = "DELETE FROM AdminUsers WHERE id='$delid' AND pass='$delpass'";
            mysqli_query($conn, $delad);
            $deletepasserr = "<p class='success'>Delete admin user successfully!<br>Bye bye ".$delid." :(</p>";
            unset($_POST['delad']['id']);
        }
    }

    $searchid ='';
    $searchname ='';
    $searchdes = '';
    $searchtype='';
    $searchprice ='';
    $formstyle ='';
    if(isset($_POST['findproduct'])){
        $searcherr = '';
        if(empty($_POST['searchprod'])){
          $searcherr = "<p class='error'>Please enter a product ID</p>";
        }
        else {
            $searchp = test_input($_POST['searchprod']);
            if(!in_array($searchp, $productarray)){
                $searcherr = "<p class='error'>Product ID doesn't exist!</p>";
            }
            else {
                $searcherr = "<style>#update-pform{display:block;}</style>";
                $findproduct = "SELECT * FROM Products WHERE id='$searchp'";
                $searchresult = mysqli_query($conn, $findproduct) or die(mysqli_error());
                $infoarray = array();
                while($row = mysqli_fetch_assoc($searchresult)) {
                    $infoarray[] = $row;
                }
                foreach($infoarray as $num => $info){
                    $searchid = $info['id'];
                    $searchname = $info['productname'];
                    $searchdes = $info['descript'];
                    $searchtype = $info['product_type'];
                    $searchprice = $info['price'];
                }
            }
        }
    }
    if(isset($_POST['updateproduct'])){
        $formstyle = "<style>#update-pform{display:block;}</style>";
        $updatepnameerr = '';
        $updatepdeserr = '';
        $updatepriceerr = '';
        $updateimgerr = '';
        $updatedir = "media/product/";
        $allowTypes = array('jpg','png','jpeg','gif');
        $updateid = $_POST['updatep']['id'];
        $updatetype = test_input($_POST['updatep']['type']);
        $updateproderr = 0;

        if(empty($_POST['updatep']['name'])){
            $updatepnameerr = "<p class='error'>Product name is required</p>";
            $updateproderr++;
        }
        else {
            $newpname = test_input($_POST['updatep']['name']);
            if(!preg_match("/^[\w\-]+[\s]?([\w\-]+[\s]?)+$/", $newpname)){
                $updatepnameerr = "<p class='error'>Name can only contain alphabetical characters, numbers, - _ and white space</p>";
                $updateproderr++;
            }
        }
        if(empty($_POST['updatep']['des'])) {
            $updatepdeserr = "<p class='error'>Please provide a description for your product!</p>";
            $updateproderr++;
        }
        else {
            $newpdes = test_input($_POST['updatep']['des']);
        }
        if(empty($_POST['updatep']['price'])){
            $updatepriceerr = "<p class='error'>Please enter a price for the product!</p>";
            $updateproderr++;
        }
        else {
            $newprice = test_input($_POST['updatep']['price']);
            if(!preg_match("/^(?:\d+|\d+\.\d+)$/", $newprice)){
                $updatepriceerr = "<p class='error'>Price can only be a positive float number!</p>";
                $updateproderr++;
            }
        }
        print_r($_FILES['updateimg']);
        if(empty($_FILES['updateimg']['name'])){
            $updateimgerr = "<p class='error'>Please upload at least 1 image</p>";
            $updateproderr++;
        }
        else {
            foreach($_FILES['updateimg']['name'] as $key=>$val){
                echo filesize($_FILES['updateimg']['tmp_name'][$key]);
                $imgType = pathinfo($val, PATHINFO_EXTENSION);
                if($_FILES['updateimg']['error'][$key]==4){
                    $updateimgerr = "<p class='error'>Please upload at least 1 image</p>";
                    $updateproderr++;
                }
                else if(!in_array($imgType, $allowTypes)){
                    $updateimgerr = "<p class='error'>Only .jpg .jpeg .png or .gif images allowed!</p>";
                    $updateproderr++;
                    break;
                }
                else if($_FILES['updateimg']['size'][$key] > 5242880) {
                    $updateimgerr = "<p class='error'>Max file size is 5MB!</p>";
                    $updateproderr++;
                    break;
                }
                else if($_FILES['updateimg']['error'][$key] ==1) {
                    $updateimgerr = "<p class='error'>Max file size is 5MB!</p>";
                    $updateproderr++;
                    break;
                }
            }
        }
        if($updateproderr==0){
            $newimgarray = implode("|",$_FILES['updateimg']['name']);
            $updproduct = "UPDATE Products
            SET productname = '$newpname', price=$newprice, descript = '$newpdes', product_type = '$updatetype', main_image='$newimgarray'
            WHERE id='$updateid'";
            mysqli_query($conn, $updproduct);
            foreach($_FILES['updateimg']['name'] as $key=>$val){
                $imgName = basename($_FILES['updateimg']['name'][$key]);
                $targetFilePath = $updatedir . $imgName;
                move_uploaded_file($_FILES['updateimg']['tmp_name'][$key], $targetFilePath);
            }
            $updateimgerr = "<p class='success'>Product updated successfully!</p>";
            unset($_POST['updatep']);
        }
    }

    $delpid = '';
    $delpname ='';
    $delpdes = '';
    $delptype ='';
    $delprice ='';
    $delimg = array();
    if(isset($_POST['searchdelp'])){
        $deleteperr ='';
        if(empty($_POST['delp']['id'])){
            $deleteperr = "<p class='error'>Please enter a product ID</p>";
        }
        else {
            $delp = test_input($_POST['delp']['id']);
            if(!in_array($delp, $productarray)){
                $deleteperr = "<p class='error'>Product ID doesn't exist!</p>";
            }
            else {
                $deleteperr = "<style>#delete-pform{display:block;}</style>";
                $showproduct = "SELECT * FROM Products WHERE id='$delp'";
                $delresult = mysqli_query($conn, $showproduct) or die(mysqli_error());
                $delarray = array();
                while($row = mysqli_fetch_assoc($delresult)) {
                    $delarray[] = $row;
                }
                foreach($delarray as $num => $info){
                    $delpid = $info['id'];
                    $delpname = $info['productname'];
                    $delpdes = $info['descript'];
                    $delptype = $info['product_type'];
                    $delprice = $info['price'];
                    $delimg = explode("|",$info['main_image']);
                }
            }
        }
    }
    if(isset($_POST['deleteproduct'])){
        $successmsg ='';
        $delid= $_POST['delhid'];
        $deleteproduct = "DELETE FROM Products WHERE id='$delid'";
        mysqli_query($conn, $deleteproduct);
        $successmsg = "<p class='success'>Product deleted successfully!</p>";
    }

    mysqli_close($conn);
?> 
</body>
</html>