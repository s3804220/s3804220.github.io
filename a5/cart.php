<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cart</title>

  <!-- Keep wireframe.css for debugging, add your css to style.css -->
  <link id='wireframecss' type="text/css" rel="stylesheet" href="../wireframe.css" disabled>

  <!-- Add bootstrap-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>


  <!-- Link to style.css -->
  <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">

  <!-- Link to web font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

    <!-- Link to web icon-->
  <!-- Creative Commons image sourced from https://www.freelogodesign.org and used for educational purposes only -->
  <link rel="icon" href="media/theme/icon.png">
  <script src='../wireframe.js'></script>

  <!-- Link to script.js -->
  <script defer src="script.js"></script>

  <!-- Link to tools.php -->
  <?php include 'tools.php';?>
  <?php include 'database.php';?>

</head>

<body>
<?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "shopDatabase";

      // Create connection
      $conn = mysqli_connect($servername, $username, $password, $dbname);
    ?>
  <div class="container">
  <nav id="top-bar" class="navbar navbar-expand-sm shadow">
      <a class="navbar-brand" href="index.php"><img src="media/theme/logo.png" alt="Shop logo"></a>
      <ul class="nav nav-pills ml-auto user-menu">
        <li class="nav-item">
          <a class="nav-link btn btn-primary" href="index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Products
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            foreach($categoryarray as $cate){
              echo "<a class='dropdown-item' href='category.php?cg=".str_replace(' ','-',strtolower($cate))."'>".$cate."</a>";
            }
          ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary" href="cart.php">Cart</a>
        </li>
        <?php
            if(empty($_SESSION['admin'])){
              echo "<li class='nav-item'><a class='nav-link btn btn-primary' href='login.php'>Login</a></li>";
            }
            else {
              echo "<li class='nav-item'><a class='nav-link btn btn-primary' href='controlpanel.php'>Control panel</a></li>";
              echo "<li class='nav-item'><a class='nav-link btn btn-primary' href='logout.php'>Logout</a></li>"; 
            }
          ?>
      </ul>
    </nav>
    <img class="img-fluid" src="media/theme/mask-banner.jpg" alt="Mask banner">
    <div id="wrapper">
    <h4 class="title">
     <?php
        // preshow($_SESSION);
        // preShow($_POST);
      ?>
      <span class="text"><span class="line"><b>Your</b> <strong>Cart</strong></span></span>
    </h4>
    <?php
      echo "<table style='width: 100%; font-size: 18px;'><tr>";
      echo "<th style='text-align: center;'>Product Image</th>";
      echo "<th style='text-align: center;'>Product Name</th>";
      echo "<th style='text-align: center;'>Product Type</th>";
      echo "<th style='text-align: center;'>Unit Price</th>";
      echo "<th style='text-align: center;'>Quantity</th>";
      echo "</tr>";
    
      foreach ($_SESSION['cart']['products'] as $products => $product){
        if ($product['quantity'] > 0){
          $productID = $product['id'];
          mysqli_real_escape_string($conn, $productID);
          $productCart = "SELECT id, productname, price, descript, product_type, main_image FROM Products WHERE id = '$productID'";
          $resultCart = mysqli_query($conn, $productCart) or die($productCart);
          if($resultCart){
            if(mysqli_num_rows($resultCart) > 0){
                while($row = mysqli_fetch_array($resultCart)){
                  $imgarray = explode("|",$row['main_image']);
                  echo "<tr><td style='text-align: center;'><img style='width:110px; height:90px;' src=";
                  echo "'media/product/".$imgarray[0]."' alt='Product image'></td>";
                  echo "<td style='text-align: center;'>".$row['productname']."</td>";
                  echo "<td style='text-align: center;'>".$row['product_type']."</td>";
                  echo "<td style='text-align: center;'>".$row['price']."</td>";
                  echo "<td style='text-align: center;'>".$product['quantity']."</td>";
                  calcTotal((float)$row['price'], (float)$product['qty']);
                }
            }
            else{
                echo "No records matching your query were found.";
              }
          } 
          else{
              echo "ERROR: Could not able to execute $resultCart. " . mysqli_error($conn);
          }
        }
      }
      echo "<tr><td colspan='4' style='text-align: center;'><b>Grand Total: </b></td>";
      echo "<td style='text-align: center;'><b>$ ".calcTotalSession()."<b></tr>";
      echo "</table>";
      $grandtotal = calcTotalSession();
      if ($grandtotal > 0){
        echo "
        <br><br><br>
        <h4 class='title'>
        <span class='text'><span class='line'><b>Checkout</b> <strong>Information</strong></span></span>
        </h4>
        <p style='font-size: 15px;' class='require'> * Please Enter Your Name, Australian Phone Number and Address</p>
        <div class='form-group'>
          <label for='cust-name' style='text-align: left;'>Name <span class='require'>*</span></label>
          <input type='name' name='cust[name]' id='name' style='width: 100%;' required oninput='checkCustInfo()'>
        </div>
        <div class='form-group'>
          <label for='cust-mobile' style='text-align: left;'>Mobile <span class='require'>*</span></label>
          <input type='tel' name='cust[mobile]' id='mobile' style='width: 100%;' required oninput='checkCustInfo()'>
        </div>
        <div class='form-group'>
          <label for='cust-address' style='text-align: left'>Address <span class='require';*</span></label>
          <input type='text' name='cust[address]' id='address' style='width: 100%;' required oninput='checkCustInfo()'>
        </div>
        <input type='button' name='order' value='Order' id='order' onclick='displayThank()' disabled>
        ";
      }
      ?>
      <!-- <br><br><br>
      <h4 class="title">
      <span class="text"><span class="line"><b>Checkout</b> <strong>Information</strong></span></span>
      </h4>
      <p style="font-size: 15px;" class="require"> * Please Enter Your Name, Australian Phone Number and Address</p>
      <div class="form-group">
        <label for="cust-name" style="text-align: left;">Name <span class="require">*</span></label>
        <input type="name" name="cust[name]" id="name" style="width: 100%;" required oninput="checkCustInfo()">
      </div>
      <div class="form-group">
        <label for="cust-mobile" style="text-align: left;">Mobile <span class="require">*</span></label>
        <input type="tel" name="cust[mobile]" id="mobile" style="width: 100%;" required oninput="checkCustInfo()">
      </div>
      <div class="form-group">
        <label for="cust-address" style="text-align: left;">Address <span class="require">*</span></label>
        <input type="text" name="cust[address]" id="address" style="width: 100%;" required oninput="checkCustInfo()">
      </div>
      <input type="button" name="order" value="Order" id="order" onclick="displayThank()" disabled> -->


    </div>
    <footer>
      <a href="#top-bar"><img id="TopBtn" src="media/theme/gotop.png" alt="Back to Top"></a>
      <section id="footer-bar">
        <div class="row">
          <div class="col-md-3">
            <h4>Navigation</h4>
            <ul>
              <li><a href="index.php">Home</a></li>
              <?php
            foreach($categoryarray as $cate){
              echo "<li><a href='category.php?cg=".str_replace(' ','-',strtolower($cate))."'>".$cate."</a></li>";
            }
          ?>
            </ul>
          </div>
          <div class="col-md-4">
            <h4>User</h4>
            <ul>
            <?php
            if(empty($_SESSION['admin'])){
              echo "<li><a href='login.php'>Login</a></li>";
            }
            else {
              echo "<li><a href='logout.php'>Logout</a></li>"; 
            }
          ?>
              <li><a href="cart.php">Cart</a></li>
            </ul>
          </div>
          <div class="col-md-5">
            <p><img src="media/theme/logo.png" class="site_logo" alt=""></p>
            - Assignment by Group 17: <br>
            Vo An Huy (s3804220 - <a href="https://github.com/s3804220/s3804220.github.io" class="git-link"
              target="_blank">GithubRepo</a>),
            <br>Doan Nguyen My Hanh (s3639869 - <a href="https://github.com/s3639869/wp" class="git-link" target="
              _blank">Github Repo</a>)
          </div>
        </div>
      </section>
      <section id="copyright">
        <span>Copyright 2013 bootstrappage template All right reserved.</span>
      </section>
    </footer>
  </div>
</body>

</html>