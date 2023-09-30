<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
</html>
<?php

    require_once 'M_Receptionist.php';
    require_once 'V_Receptionist.php';

    $View = new ReceptionistView();
    $View->ShowAllReceptionists();

?>