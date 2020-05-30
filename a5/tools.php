<?php
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
// Loop to add options for select input
function addOptions($id){
  echo "<option value=''";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST[$id] == ''){
      echo "selected='selected'";
    }
  }
  echo ">Please Select</option>";
  for ($i = 1; $i<=10; $i++){
    echo "<option value=";
    echo "'".$i."'";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if( $i == $_POST[$id]){
        echo "selected='selected'";
      }
    }
    echo ">".$i."</option>";
  }
}

// A 'reset the session' submit button
if (isset($_POST['session-reset'])) {
  unset($_SESSION['cart']);
}

$total = 0;
function calcTotal($price, $qty){
  $total = $total + ($price * $qty);
  return $total;
}
function showTotal(){
  return $total;
}
function calcTotalSession(){
  if(!empty($_SESSION['cart']['products'])){
    $bookingTotal = 0;
    foreach($_SESSION['cart']['products'] as $products => $product){
      $bookingTotal = $bookingTotal + $product['price'] * $product['quantity'];
    }
    return $bookingTotal;
  }
}
?>
