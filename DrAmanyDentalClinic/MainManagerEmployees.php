<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
</html>
<?php

    require_once 'M_Employee.php';
    require_once 'V_Employee.php';

    $View = new EmployeeView();
    $View->ShowAllEmployees();

?>