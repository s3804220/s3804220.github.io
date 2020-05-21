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

// A 'reset the session' submit button
if (isset($_POST['session-reset'])) {
  unset($_SESSION['cart']);
}

// Put your PHP functions and modules here
//Sanitize input
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Loop to add options for select input
function addOptions($seatsType){
  echo "<option value=''";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST['seats'][$seatsType] == ''){
      echo "selected='selected'";
    }
  }
  echo ">Please Select</option>";
  for ($i = 1; $i<=10; $i++){
    echo "<option value=";
    echo "'".$i."'";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      if( $i == $_POST['seats'][$seatsType]){
        echo "selected='selected'";
      }
    }
    echo ">".$i."</option>";
  }
}

$days = [ 'MON' => 'Monday', 'TUE' => 'Tuesday', 'WED' => 'Wednesday', 'THU' => 'Thursday', 'FRI'=>'Friday', 'SAT'=>'Saturday', 'SUN'=>'Sunday'];
$movieID = ['ACT'=>'Avengers: Endgame', 'RMC'=> 'Top End Wedding', 'ANM'=> 'Dumbo', 'AHF'=> 'The Happy Prince'];
$timeConvert = ['T12'=>'12pm', 'T15'=>'3pm', 'T18'=>'6pm', 'T21'=>'9pm'];
$seatFull = ['STA'=> 19.80, 'STP'=> 17.50, 'STC'=> 15.30, 'FCA'=> 30.00, 'FCP'=> 27.00, 'FCC'=> 24.00];
$seatDiscount = ['STA'=> 14.00, 'STP'=> 12.50, 'STC'=> 11.00, 'FCA'=> 24.00, 'FCP'=> 22.50, 'FCC'=> 21.00];
$weekDays = ['MON','TUE', 'WED','THU','FRI'];
$seatTypes = ['STA'=> 'Standard Adult', 'STP'=> 'Standard Concession', 'STC'=> 'Standard Child', 'FCA'=> 'First Class Adult', 'FCP'=> 'First Class Concession', 'FCC'=> 'First Class Child'];

function calcTotalPost(){
  global $seatFull;
  global $seatDiscount;
  global $weekDays;
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $total=0;
    if($_POST['movie']['day']=='MON' or $_POST['movie']['day']=='WED' or (in_array($_POST['movie']['day'], $weekDays) and $_POST['movie']['hour']=='T12')){
      foreach($seatDiscount as $type => $disPrice){
        $total += $_POST['seats'][$type]*$disPrice;
      }
    } else {
        foreach($seatFull as $type => $fullPrice){
          $total += $_POST['seats'][$type]*$fullPrice;
        }
      }
    return $total;
  }
}
function calcTotalSession(){
  global $seatFull;
  global $seatDiscount;
  global $weekDays;
  if(!empty($_SESSION['cart']['seats'])){
    $bookingTotal = 0;
    if($_SESSION['cart']['movie']['day']=='MON' or $_SESSION['cart']['movie']['day']=='WED' or (in_array($_SESSION['cart']['movie']['day'], $weekDays) and $_SESSION['cart']['movie']['hour']=='T12')){
      foreach($seatDiscount as $type => $disPrice){
        $bookingTotal += $_SESSION['cart']['seats'][$type]*$disPrice;
      }
    } else {
        foreach($seatFull as $type => $fullPrice){
          $bookingTotal += $_SESSION['cart']['seats'][$type]*$fullPrice;
        }
      }
    return $bookingTotal;
  }
}
function countTickets(){
  $ticketnum = 0;
  if(!empty($_SESSION['cart']['seats'])){
    foreach($_SESSION['cart']['seats'] as $type => $qty){
      if($qty>0){
          $ticketnum++;
      }
    }
    return $ticketnum;
  }
}

?>
