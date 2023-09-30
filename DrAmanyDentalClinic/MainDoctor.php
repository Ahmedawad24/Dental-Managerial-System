<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
</html>
<?php

    require_once 'M_Patient.php';
    require_once 'V_Patient.php';

    $View = new PatientView();
    $View->ShowAllPatients();

?>