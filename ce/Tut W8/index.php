<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 8 Tutorial</title>
</head>
<body>
    <?php include 'tool.php'; ?>
    <?php  $a = 5;  $b = 5.0;?>
    <p>  
    <?php echo ($a ==  $b ? 'correct' : 'incorrect'); ?><br>  
    <?php echo ($a === $b ? 'correct' : 'incorrect'); ?><br>  
    <?php echo ($a   = $b ? 'correct' : 'incorrect'); ?>
    </p>
    <table style="border:thick black solid;">
    <?php  for ( $i=1; $i<=12; $i++ )  
        {    
        echo "<tr>";    
        for ( $j=1; $j<=12; $j++ )    
        {      
            echo "<td>" . $i*$j . "</td>";    
            }    echo "</tr>";
        }?>
        </table>
        <select name='...'>
        <?php  $seasons = [    'Autumn' => ['March', 'April', 'May'],    
                        'Winter' => ['June', 'July', 'August'],    
                        'Spring' => ['September', 'October', 'November'],    
                        'Summer' => ['December', 'January', 'February']  ];  
            foreach ( $seasons as $season => $months ) {    
                echo "<optgroup label='$season'>";      
                foreach ( $months as $month ) {      
                    echo "<option value='$month'>$month</option>";    }    
                    echo "</optgroup>";  }?>
        </select>
                    <br>
    <!-- Assume that movies are only every 3 hours from 4pm to 12pm. 
        Valid time shoud be T12, T15, T18, T21, T00. Mon-Fri all title discount except for T18, T12. Sat & Sun discount only for T00 -->
    <?php
    function isFullOrDiscount($day, $hour){
        switch($day){
            case 'MON';
            case 'TUE';
            case 'WED';
            case 'THU';
            case 'FRI';
                switch($hour){
                    case 'T12';
                    case 'T15';
                    case 'T00';
                        return 'discount';
                    case 'T18';
                    case 'T21';
                        return 'full';
                    default:
                        return "ERROR - HOUR NOT FOUND";
                        
                }
            case 'SAT';
            case 'SUN';
                if ($hour == 'T00'){
                    return 'discount';
                }
                else if ($hour == 'T12' || $hour == 'T15' || $hour == 'T18' || $hour == 'T21'){
                    return 'full';
                }     
            default:
                return 'ERROR - DAY NOT FOUND';
    }
}
    $days = ['MON','TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN', 'FUN'];
    $hours = [ 'T12', 'T15', 'T18', 'T21', 'T00' ]; 

    foreach ( $days as $day ) {  
        foreach ( $hours as $hour ) {    
            echo '<p>'.$day.' '.$hour.': '.isFullOrDiscount( $day, $hour ).'</p>';    
        }
    }
    ?>
</body>
</html>