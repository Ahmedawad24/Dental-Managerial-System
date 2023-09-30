<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
</html>
<?php

    require_once 'M_Doctor.php';
    require_once 'V_Doctor.php';

    $View = new DoctorView();
    $View->ShowAllDoctors();

?>