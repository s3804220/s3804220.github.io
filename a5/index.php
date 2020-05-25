<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mask Heaven</title>

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

    <!-- Link to icon -->
    <link rel="icon" href="media/icon.png">

    <!-- Link to web font-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat"> 

    <!-- Link to style.css -->
    <link id='stylecss' type="text/css" rel="stylesheet" href="style.css">

    <!-- Link to script.js -->
    <script defer src="script.js"></script>

     <!-- Link to tools.php -->
    <?php include 'tools.php';?>
    

</head>
<body>
    <div class='container'>
    <header>
        <div class='jumbotron'>
            <div class='logo'>
                <a href="index.php"><img src="media/logo.png" alt="company-logo" id="logo" width="200px" height="200px"></a>
                <p>All your mask needs in one place.</p>
            </div>
        </div>
    </header>
    <nav id="navigation" class="navbar sticky-top navbar-expand-sm shadow">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link btn btn-primary btn-lg" href="#About-us" role="button">ABOUT US</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary btn-lg" href="#pricing" role="button">SHOP</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary btn-lg" href="#now-showing" role="button">CONTACT</a>
        </li>
      </ul>
    </nav>
    </div>
</body>
</html>