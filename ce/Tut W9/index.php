<!DOCTYPE html>
<html>
<head>
<?php include 'tools.php'?>
</head>
<body>
<?php 
   php2js($pricesObject, 'pricesArrayJS');
?>
<script>
   for (let key in pricesArrayJS)
   {
      value = pricesArrayJS[key];
      document.write(key + '<br>');
      for (let key1 in value)
      {
        value1 = value[key1];
        document.write(key1 + ": " + value1 + '<br>');
      }
   }
</script>
</body>
<footer style="position:fixed; bottom:0px;">
<?php
    preShow($_GET);
    preShow($_POST);    
    preShow($_SESSION);
?>
</footer>
</html>