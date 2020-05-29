<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our shop</title>

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
            foreach($categoryarray as $num => $cate){
              echo "<a class='dropdown-item' href='".str_replace(' ','-',strtolower($cate['product_type'])).".php'>".$cate['product_type']."</a>";
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

    <div id="wrapper">
      <section id="about-us">
        <h3 id="about-heading">About us</h3>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut diam turpis. Nunc sodales metus vitae elit
        sollicitudin convallis sed eu metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu congue
        felis, non consequat ipsum. Donec eget gravida odio. Etiam malesuada scelerisque interdum. Vivamus aliquet ac
        risus sit amet congue. Fusce id lectus sed eros maximus ornare id at velit. Aenean laoreet mauris ex, eu
        pretium
        ipsum ultricies eget.

        Cras rhoncus, est eget ultricies efficitur, magna lorem ullamcorper lectus, quis maximus justo ante at tortor.
        Praesent sed nunc ac odio congue commodo. Vivamus dignissim libero ut luctus dignissim. Mauris scelerisque
        odio
        non augue pulvinar feugiat. Morbi blandit magna vitae tincidunt fermentum. Nam in volutpat nisi. Phasellus
        vitae
        justo neque. Curabitur ut mollis metus. Morbi aliquam iaculis felis id dictum.
      </section>
      <br>
      <div class="row feature_box">
        <div class="col-md-4">
          <div class="service">
            <div class="responsive">
              <img src="media/theme/feature_img_2.png" alt="Feature image" />
              <h5>MODERN <strong>DESIGN</strong></h5>
              <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="customize">
              <img src="media/theme/feature_img_1.png" alt="Feature image" />
              <h5>FREE <strong>SHIPPING</strong></h5>
              <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service">
            <div class="support">
              <img src="media/theme/feature_img_3.png" alt="Feature image" />
              <h5>24/7 LIVE <strong>SUPPORT</strong></h5>
              <p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container my-4">

        <div id="feature-carousel" class="carousel slide carousel-multi-item" data-ride="carousel">
          <div class="d-flex section-heading">
            <h4 class="title">
              <span class="text"><span class="line"><b>Feature</b> <strong>Products</strong></span></span>
            </h4>
            <div class="ml-auto">
              <a class="arrow button" href="#feature-carousel" data-slide="prev"><img src="media/theme/arrow-pleft.png"
                  alt="Left arrow"></a>
              <a class="arrow button" href="#feature-carousel" data-slide="next"><img src="media/theme/arrow-p.png"
                  alt="Right arrow"></a>
            </div>

          </div>
          <ol class="carousel-indicators">
            <li data-target="#feature-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#feature-carousel" data-slide-to="1"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <div class="row">
              <?php
                  $productselect = "SELECT id, productname, price, product_type, main_image FROM Products WHERE id ='PD003' OR id ='PD007' OR id='PD006'";
                  $result = mysqli_query($conn, $productselect) or die(mysqli_error());
                  $productarray = array();
                  while($row = mysqli_fetch_assoc($result)) {
                    $productarray[] = $row;
                  }
                  foreach ($productarray as $num => $info){
                    echo "<div class='col-md-4'><div class='card product-box mb-2'><a href='product-detail.php?id={$info['id']}'><img class='card-img-top' src=";
                    echo "'media/product/".$info['main_image']."' alt='Product image'></a>";
                    echo "<div class='card-body'><a href='product-detail.php?id={$info['id']}' class='title'>".$info['productname']."</a><br>";
                    echo "<a href='".str_replace(' ','-',strtolower($info['product_type'])).".php' class='category'>".$info['product_type']."</a>";
                    echo "<p class='price'>$".$info['price']."</p></div></div></div>";
                  }
                ?>
                <!-- <div class="col-md-4">
                  <div class="card product-box mb-2">
                    <a href="product_detail.html"><img class="card-img-top" src="media/product/1.jpg"
                        alt="Product image"></a>
                    <div class="card-body">
                      <a href="product_detail.html" class="title">Ut wisi enim ad</a><br />
                      <a href="products.html" class="category">Commodo consequat</a>
                      <p class="price">$17.25</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card product-box mb-2">
                    <a href="product_detail.html"><img class="card-img-top" src="media/product/1.jpg"
                        alt="Product image"></a>
                    <div class="card-body">
                      <a href="product_detail.html" class="title">Ut wisi enim ad</a><br />
                      <a href="products.html" class="category">Commodo consequat</a>
                      <p class="price">$17.25</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card product-box mb-2">
                    <a href="product_detail.html"><img class="card-img-top" src="media/product/1.jpg"
                        alt="Product image"></a>
                    <div class="card-body">
                      <a href="product_detail.html" class="title">Ut wisi enim ad</a><br />
                      <a href="products.html" class="category">Commodo consequat</a>
                      <p class="price">$17.25</p>
                    </div>
                  </div>
                </div> -->

              </div>

            </div>

            <div class="carousel-item">
            <div class="row">
            <?php
            $productselect = "SELECT id, productname, price, product_type, main_image FROM Products WHERE id ='PD005' OR id ='PD001' OR id='PD008'";
            $result = mysqli_query($conn, $productselect) or die(mysqli_error());
            $productarray = array();
            while($row = mysqli_fetch_assoc($result)) {
              $productarray[] = $row;
            }
            foreach ($productarray as $num => $info){
              echo "<div class='col-md-4'><div class='card product-box mb-2'><a href='product-detail.php?id={$info['id']}'><img class='card-img-top' src=";
              echo "'media/product/".$info['main_image']."' alt='Product image'></a>";
              echo "<div class='card-body'><a href='product-detail.php?id={$info['id']}' class='title'>".$info['productname']."</a><br>";
              echo "<a href='".str_replace(' ','-',strtolower($info['product_type'])).".php' class='category'>".$info['product_type']."</a>";
              echo "<p class='price'>$".$info['price']."</p></div></div></div>";
            }
            ?>
          </div>
        </div>
      </div>

      <div class="container my-4">
        <h4 class="title">
          <span class="text"><span class="line"><b>All</b> <strong>Products</strong></span></span>
        </h4>
        <div class="row">
          <?php
            $productselect = "SELECT id, productname, price, product_type, main_image FROM Products";
            $result = mysqli_query($conn, $productselect) or die(mysqli_error());
            $productarray = array();
            while($row = mysqli_fetch_assoc($result)) {
              $productarray[] = $row;
            }
          foreach ($productarray as $num => $info){
            echo "<div class='col-md-4'><div class='card product-box mb-2'><a href='product-detail.php?id={$info['id']}'><img class='card-img-top' src=";
            echo "'media/product/".$info['main_image']."' alt='Product image'></a>";
            echo "<div class='card-body'><a href='product-detail.php?id={$info['id']}' class='title'>".$info['productname']."</a><br>";
            echo "<a href='".str_replace(' ','-',strtolower($info['product_type'])).".php' class='category'>".$info['product_type']."</a>";
            echo "<p class='price'>$".$info['price']."</p></div></div></div>";
          }
          ?>
        </div>
      </div>

      <section class="our_client">
        <h4 class="title"><span class="text"><b>Manufacturers</b></span></h4>
        <div class="row">
          <div class="col-md-2">
            <a href="#"><img alt="" src="media/theme/manu5.png"></a>
          </div>
          <div class="col-md-2">
            <a href="#"><img alt="" src="media/theme/manu6.png"></a>
          </div>
          <div class="col-md-2">
            <a href="#"><img alt="" src="media/theme/manu1.png"></a>
          </div>
          <div class="col-md-2">
            <a href="#"><img alt="" src="media/theme/manu2.png"></a>
          </div>
          <div class="col-md-2">
            <a href="#"><img alt="" src="media/theme/manu3.png"></a>
          </div>
          <div class="col-md-2">
            <a href="#"><img alt="" src="media/theme/manu4.png"></a>
          </div>
        </div>
      </section>
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
              <li><a href="login.php">Login</a></li>
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