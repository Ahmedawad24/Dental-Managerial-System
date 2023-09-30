<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
</html>
<?php

    require_once 'M_Reservation.php';
    require_once 'V_Reservation.php';

    $View = new ReservationView();
    $View->ShowAllReservations();

?>