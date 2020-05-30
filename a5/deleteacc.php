<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Management</title>

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


  <!-- Link to web icon-->
  <!-- Creative Commons image sourced from https://www.freelogodesign.org and used for educational purposes only -->
  <link rel="icon" href="media/theme/icon.png">

  <!-- Link to style.css -->
  <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">

  <!-- Link to other php files -->
  <?php include 'database.php';?>
  <?php include 'tools.php';?>
</head>

<body>
  <?php
    if(empty($_SESSION['admin'])){
      header('Location: index.php');
  }
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
            foreach($categoryarray as $num => $cate){
              echo "<a class='dropdown-item' href='".str_replace(' ','-',strtolower($cate['product_type'])).".php'>".$cate['product_type']."</a>";
            }
          ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary" href="cart.php">Cart</a>
        </li>
        <li class='nav-item'><a class='nav-link btn btn-primary' href='controlpanel.php'>Control panel</a></li>
        <li class='nav-item'><a class='nav-link btn btn-primary' href='logout.php'>Logout</a></li>
      </ul>
    </nav>
    <img class="img-fluid" src="media/theme/mask-banner.jpg" alt="Mask banner">
    <div id="wrapper">
      <section class="header_text sub">
        <h4><span>Delete admin account</span></h4>
      </section>

      <form action="" method="POST" id="add-adform">
      <p style="font-size: 14px;">Please type in an admin's ID to delete their account</p>
        <div class="form-group">
          <label for="product-id">Admin ID</label>
          <input type="text" name="delad[id]" value ="<?php echo isset($_POST['delad']['id']) ? $_POST['delad']['id'] : ''; ?>">
          <?php echo $deleteiderr ?>
        </div>
        <div class="form-group">
          <label for="product-name">Current Password</label>
          <input type="password" name="delad[pass]">
          <?php echo $deletepasserr ?>
        </div>
        <div class="form-group">
          <input class="btn btn-primary btn-dark" type="submit" name="deladmin" value="Delete Admin User">
        </div>
      </form>
    </div>
    <footer>
      <a href="#top-bar"><img id="TopBtn" src="media/theme/gotop.png" alt="Back to Top"></a>
      <section id="footer-bar">
        <div class="row">
          <div class="col-md-3">
            <h4>Navigation</h4>
            <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="bandana.php">Bandanas</a></li>
            <li><a href="medical-mask.php">Medical Mask</a></li>
            <li><a href="dust-mask.php">Dust Mask</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4>User</h4>
            <ul>
              <li><a href="#">Login</a></li>
              <li><a href="#">Cart</a></li>
            </ul>
          </div>
          <div class="col-md-5">
            <p><img src="media/theme/logo.png" class="site_logo" alt=""></p>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. the Lorem Ipsum has been the
              industry's standard dummy text ever since the you.</p>
            <br />
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