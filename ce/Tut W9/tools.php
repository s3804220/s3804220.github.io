<?php 
session_start();

$pricesObject = [
   'full' => [
       'STA' => 19.8,
       'STP' => 17.5,
       'ACT' => 15.5,
   ],
   'discount' => [
       'STA' => 15,
       'STP' => 13.5,
       'ACT' => 11,
   ]
];

function preShow( $arr, $returnAsString=false ) {
    $ret  = '<pre>' . print_r($arr, true) . '</pre>';
    if ($returnAsString)
         return $ret;
    else 
        echo $ret; 
}

function printMyCode() {
    $lines = file($_SERVER['SCRIPT_FILENAME']);
    echo "<pre class='mycode'><ol>";
    foreach ($lines as $line)
           echo '<li>'.rtrim(htmlentities($line)).'</li>';
    echo '</ol></pre>';
}

function php2js( $arr, $arrName ) {
    $lineEnd="";
    echo "<script>\n";
    echo "/* Generated with A4's php2js() function */";
    echo "  var $arrName = ".json_encode($arr, JSON_PRETTY_PRINT);
    echo "</script>\n\n";
}
?>