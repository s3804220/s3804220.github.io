<?php
  include 'database.php';
  session_start();

// "preShow()" function prints data and shape/structure of data:
function preShow( $arr, $returnAsString=false ) {
  $ret  = '<pre>' . print_r($arr, true) . '</pre>';
  if ($returnAsString)
       return $ret;
 else 
      echo $ret; 
}

// Output your current file's source code
function printMyCode() {
  $lines = file($_SERVER['SCRIPT_FILENAME']);
  echo "<pre class='mycode'><ol>";
  foreach ($lines as $line)
      echo '<li>'.rtrim(htmlentities($line)).'</li>';
  echo '</ol></pre>';

}

// A "php multiple dimensional array to javascript object" function
function php2js( $arr, $arrName ) {
  $lineEnd="";
  echo "<script>\n";
  echo "/* Generated with A4's php2js() function */";
  echo "  var $arrName = ".json_encode($arr, JSON_PRETTY_PRINT);
  echo "</script>\n\n";
}

if (isset($_POST['logout'])) {
  unset($_SESSION['admin']);
  header('Location: index.php');
}
if (isset($_POST['home-return'])) {
  header('Location: index.php');
}

//Sanitize input
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
