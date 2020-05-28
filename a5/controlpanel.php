<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control Panel</title>

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

  <!-- Link to other php files -->
  <?php include 'database.php';?>
  <?php include 'tools.php';?>
</head>

<body>
  <div class="container">
    <nav id="top-bar" class="navbar navbar-expand-sm shadow">
      <a class="navbar-brand" href="index.php"><img src="media/theme/logo.png" alt="Shop logo"></a>
      <ul class="nav nav-pills ml-auto user-menu">
        <li class="nav-item">
          <a class="nav-link btn btn-primary" href="#about-us">About us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Products
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="bandana.html">Bandana</a>
            <a class="dropdown-item" href="medical-mask.html">Medical mask</a>
            <a class="dropdown-item" href="dust-mask.html">Dust mask</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary" href="#">Cart</a>
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
      <section class="header_text sub">
        <h4><span>Control panel</span></h4>
      </section>

      <form action="" method="POST" id="add-form" enctype="multipart/form-data">
        <div class="form-group">
          <label for="product-id">Product ID</label>
          <input type="text" name="product[id]" id="product-id">
        </div>
        <div class="form-group">
          <label for="product-name">Name</label>
          <input type="text" name="product[name]" id="product-name">
        </div>
        <div class="form-group">
          <label for="product-des">Description</label>
          <textarea rows="5" cols="50" name="product[des]" form="add-form" id="product-des"></textarea>
        </div>
        <div class="form-group">
          <label for="product-type">Product Type</label>
          <select name="product[type]" id="product-type">
            <option value='Bandana'>Bandana</option>
            <option value='Medical mask'>Medical Mask</option>
            <option value='Dust mask'>Dust Mask</option>
          </select>
        </div>
        <div class="form-group">
          <label for="product-name">Price</label>
          <input type="text" name="product[price]" id="product-price">
        </div>
        <div class="form-group">
          <label for="product-img">Upload images</label>
          <input type="file" name="image1" id="product-img" accept="image/*">
        </div>
        <div class="form-group">
          <input class="btn btn-primary btn-dark" type="submit" name="addproduct" value="Add Product" id="addproduct">
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
              <li><a href="index.php">Homepage</a></li>
              <li><a href="#about-us">About Us</a></li>
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