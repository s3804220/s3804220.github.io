<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Detail</title>

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
      session_start();
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
    <div class="container my-4">
        <h4 class="title">
          <span class="text"><span class="line"><b>Product </b> <strong>Details</strong></span></span>
        </h4>
        <div class="row" id="product-details">
          <?php
            mysqli_real_escape_string($_GET['id']);
            $id = $_GET['id'];
            $productselect = "SELECT id, productname, price, descript, product_type, main_image FROM Products WHERE id = '$id'";
            $result = mysqli_query($conn, $productselect) or die($productselect);
            
            if($result){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){     
                      if (isset($_POST['add'])){
      
                        $_SESSION['cart']['products'][$row['id']]['id'] = test_input($_POST['id']);
                        $_SESSION['cart']['products'][$row['id']]['price'] = test_input($_POST['price']);
                        $_SESSION['cart']['products'][$row['id']]['quantity'] = test_input($_POST['quantity']);
      
                        header("Location: cart.php");
                      }          

                    echo "<div class='col-md-4'>";
                    $imgarray = explode("|",$row['main_image']);
                    for($index = 0; $index <count($imgarray); $index++){
                      if ($index == 0){
                        echo "<div class='col-md-4'><a role='button' data-toggle='modal' data-target='#del-img-".$index."'><img  style ='height: 250px; width: 300px;' class='del-img' src='media/product/".$imgarray[$index]."'></a></div>";
                        echo "<div id='del-img-".$index."' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>";
                        echo "<div class='modal-dialog modal-dialog-centered modal-lg' role='document'><div class='modal-content'><div class='modal-body' style='position: relative; height: 400px;'>";
                        echo "<img src='media/product/".$imgarray[$index]."' alt='Product Image' class='img-fluid' style='width:400px; height: 400px; position:absolute; left:50%; top:50%; margin-top:-200px; margin-left:-200px;'>";
                        echo "</div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button></div></div></div></div>";
                        echo "<div class='row'>";
                      }
                      else{
                        echo "<div class='col-md-4'><a role='button' data-toggle='modal' data-target='#del-img-".$index."'><img  style ='height: 70px; width: 100px;' class='del-img' src='media/product/".$imgarray[$index]."'></a></div>";
                        echo "<div id='del-img-".$index."' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>";
                        echo "<div class='modal-dialog modal-dialog-centered modal-lg' role='document'><div class='modal-content'><div class='modal-body' style='position: relative; height: 400px;'>";
                        echo "<img src='media/product/".$imgarray[$index]."' alt='Product Image' class='img-fluid' style='width:400px; height: 400px; position:absolute; left:50%; top:50%; margin-top:-200px; margin-left:-200px;'>";
                        echo "</div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button></div></div></div></div>";
                      }
                    }
                    echo "</div></div>";
                    echo "<div class='col-md-8'><i>Click on image for a better view.<i><h2><b>".$row['productname']."</b></h2>";
                    echo "<p style='font-size: 18px;'><a href='category.php?cg=".str_replace(' ','-',strtolower($row['product_type']))."' class='category'>".$row['product_type']."</a></p>";
                    echo "<p style='font-size: 18px;'><b>Description: </b>".$row['descript']."</p>";
                    echo "<p style='font-size: 18px;'><b>Price: </b>$".$row['price']."</p>";
                
                    echo "<form action='' method='post'>";
                    echo "<input type='hidden' name='id' value='".$row['id']."'>";
                    echo "<input type='hidden' name='price' value='".$row['price']."'>";
                    echo "<button type=button onclick='minus()'>-</button>";
                    echo "<input style='text-align: center;' type=text id='quantity' value='0' name='quantity' onblur='updateQuantity()'>";
                    echo "<button type=button onclick='plus()'>+</button><br><br>";
                    echo "<input type='submit' name='session-reset' value='Reset the session' id='session-reset'>";
                    echo "<input type='submit' name='add' value='Add to Cart' id='Add to Cart'></form>";        
                }
                    // Free result set
                    // mysqli_free_result($result);
                } else{
                    echo "No records matching your query were found.";
                }
             } 
            else{
                echo "ERROR: Could not able to execute $result. " . mysqli_error($conn);
            }
          ?>
        </div>
      </div>
    </div>
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