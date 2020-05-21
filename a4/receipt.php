<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link id='stylecss' type="text/css" rel="stylesheet" href="receipt-style.css">
    <?php include 'tools.php';?>
</head>
<body>
    <?php
    if(empty($_SESSION)){
        header("Location: index.php");
    }

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $now = date('d/m/Y H:i');
    $bookingCells = array_merge(
        [$now],
        $_SESSION['cart']['cust'],
        $_SESSION['cart']['movie'],
        $_SESSION['cart']['seats'],
        [calcTotalSession()]
    );

    $bookingSheet = fopen("bookings.txt", "a");
    flock($bookingSheet, LOCK_EX);
    fputcsv($bookingSheet, $bookingCells, "\t");
    flock($bookingSheet, LOCK_UN);
    fclose($bookingSheet);
    ?>

    <div class="page">
        <div id="invoice-header">
        <div class="head-strip"></div>
        <img src="media/cinemax_logo.png" alt="Cinemax logo" id="invoice-logo">
        <p id="anb-num"><b>ABN number:</b> 00 123 456 789</p>
        <div id="company-info">
            <table id="header-table">
                <tr>
                    <td class="header-info">
                        <img src="media/map.svg" alt="Map icon" class="header-icon">
                        <br>
                        <b>Address:</b><br>221B Baker Street Faraway City
                    </td>
                    <td class="header-info">
                        <img src="media/envelope.svg" alt="Phone icon" class="header-icon">
                        <br>
                        <b>Email:</b><br>contact_support@cinemax.com
                    </td>
                    <td class="header-info">
                        <img src="media/phone.svg" alt="Phone icon" class="header-icon">
                        <br>
                        <b>Phone number:</b><br>+84 900779977
                    </td>
                </tr>
            </table>
        </div>
        <div class="head-strip"></div>
        </div>
        <br>
        <h2 id="invoice-heading">INVOICE <span id="invoice-date">Date: <?php echo $now?></span></h2>
        <table style='width:100%;' class="info-table">
        <tr>
            <th class="info-table cust-info">Customer Information</th>
            <th class="info-table movie-info">Movie Information</th>
        </tr>
        <tr>
            <td class="info-table cust-info">
                <p><span class="info-title">Name:</span> <?php echo $_SESSION['cart']['cust']['name']?></p>
                <p><span class="info-title">Email:</span> <?php echo $_SESSION['cart']['cust']['email']?></p>
                <p><span class="info-title">Mobile:</span> <?php echo $_SESSION['cart']['cust']['mobile']?></p>
            </td>
            <td class="info-table movie-info">
                <p><span class="info-title">Movie title:</span> <?php echo $movieID[$_SESSION['cart']['movie']['id']]?></p>
                <p><span class="info-title">Movie day:</span> <?php echo $days[$_SESSION['cart']['movie']['day']]?></p>
                <p><span class="info-title">Movie time:</span> <?php echo $timeConvert[$_SESSION['cart']['movie']['hour']]?></p>
            </td>
        </tr>
        </table>
        <h2 id="seat-heading">Order Information</h2>
        <table style='width:100%;' class="seats-table">
        <tr>
            <th class="seats-table seats-head">Seat Description</th>
            <th class="seats-table seats-head">Seat Code</th>
            <th class="seats-table seats-head">Qty</th>
            <th class="seats-table seats-head">Unit price</th>
            <th class="seats-table seats-head">Subtotal</th>
        </tr>
        <?php
            foreach($_SESSION['cart']['seats'] as $type => $qty){
                if($qty > 0){
                    echo "<tr><td class='seats-table' style='text-align: center;'>".$seatTypes[$type]."</td>";
                    echo "<td class='seats-table' style='text-align: center;'>".$type."</td>";
                    echo "<td class='seats-table' style='text-align: center;'>".$qty."</td>";
                    if($_SESSION['cart']['movie']['day']=='MON' or $_SESSION['cart']['movie']['day']=='WED' or (in_array($_SESSION['cart']['movie']['day'], $weekDays) and $_SESSION['cart']['movie']['hour']=='T12')){
                        echo "<td class='seats-table' style='text-align: center;'>$".number_format((float)$seatDiscount[$type], 2)."</td>";
                        echo "<td class='seats-table' style='text-align: center;'>$".number_format((float)$seatDiscount[$type]*$qty, 2)."</td>";
                    }
                    else{
                        echo "<td class='seats-table' style='text-align: center;'>$".number_format((float)$seatFull[$type], 2)."</td>";
                        echo "<td class='seats-table' style='text-align: center;'>$".number_format((float)$seatFull[$type]*$qty, 2)."</td>";
                    }
                    echo "</tr>";
                }
            }
        ?>
        </table>
        <table id="gst-total">
            <tr>
                <td class="gst-head">
                    <b>Total Price: </b>
                </td>
                <td class="gst-calc">
                    $<?php echo number_format((float)calcTotalSession(), 2); ?>
                </td>
            </tr>
            <tr style="border-bottom: teal 3px solid;">
                <td class="gst-head">
                    <b>GST: </b>
                </td>
                <td class="gst-calc">
                    $<?php echo number_format((float)calcTotalSession()*0.1, 2); ?>
                </td>
            </tr>
            <tr>
                <td class="gst-head">
                    <b>Grand Total: </b>
                </td>
                <td class="gst-calc">
                    $<?php echo number_format((float)calcTotalSession()*1.1, 2); ?>
                </td>
            </tr>
        </table>
        <h2 id="ticket-heading">Print your tickets</h2>
        <hr style="border: teal dashed 2px;">
        <br>
        <?php
        $ticketcnt = 1;
        foreach($_SESSION['cart']['seats'] as $type => $qty){
            if ($qty > 0){
                for ($i = 1; $i <= $qty; $i++){
                    echo "<div class='ticket'>";
                    echo "<img src='media/cinemax_logo.png'alt='Cinemax logo'><p style='font-weight:bold; text-align: right;'> Ticket No. ".$ticketcnt."</p><hr>";
                    echo "<p class='ticket-info'> Movie: ".$movieID[$_SESSION['cart']['movie']['id']]."</p>";
                    echo "<p class='ticket-info'> Movie time: ".$days[$_SESSION['cart']['movie']['day']]." - ".$timeConvert[$_SESSION['cart']['movie']['hour']]."</p>";
                    echo "<p class='ticket-info'>Seat type: ".$seatTypes[$type]." - ".$type." - ".$i."</p>";
                    echo "</div><br>";
                    $ticketcnt++;
                }
            }
        }
        ?>
        <hr style="border: teal solid 2px;">
        <h3 style="color: teal; text-align: right;">Thank you for your business!</h3>
    </div>
</body>
</html>