<!DOCTYPE html>
    <head>
        <title>Dr.AmanyDentalClinic</title>
        <link rel="stylesheet" type="text/css" href="styleEmployee.css">
    </head>
    <body>
        <form action="" method="POST">
            <table class = "EmployeeTable">
            <tr><th>Name</th><td><input type="text" name="name"></td></tr>
            <tr><th>Phone Number</th><td><input type="number" name="number"></td></tr>
            <tr><th>Address</th><td>
                <select name="address" style="width:100%">
                <?php
                    require_once 'Connection.php';
                    $sql = "SELECT * FROM `address`";
                    $result = mysqli_query(Database::GetConnection(), $sql);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value='".$row['AddressID']."'>".$row['Address']."</option>";
                    }
                ?>
                </select>
            </td></tr>
            <tr><th>Birthdate</th><td><input type="date" name="birthdate" style="width:97%"></td></tr>
            <tr><th>Shift Time</th><td><input type="text" name="shifttime"></td></tr>
            <tr><th>Job Type</th><td>
                <select name="jobtype" style="width:100%">
                <?php
                    require_once 'Connection.php';
                    $sql = "SELECT * FROM `jobtype`";
                    $result = mysqli_query(Database::GetConnection(), $sql);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value='".$row['JobtypeID']."'>".$row['jobtypename']."</option>";
                    }
                ?>
                </select>
            </td></tr>
            <tr><th>Salary</th><td><input type="number" name="salary"></td></tr>
            </table>
            <br>
            <button type="submit" name="AddButton" value="Add" id="AddButton">Add</button>
            <button type="submit" name="UpdateButton" value="Update" id="UpdateButton">Update</button>
            <button type="submit" name="DeleteButton" value="Delete" id="DeleteButton">Delete</button>
        </form>
    </body>
</html>

<?php

    require_once 'Connection.php';
    require_once 'M_Employee.php';
    require_once 'V_Employee.php';

    function AddEmployee($EmployeeObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO employees(Empname, Empphone, EmpaddressID, Empbirthdate, Empshifttime, EmpjobtypeID, Empsalary) VALUES ('$EmployeeObject->Name', '$EmployeeObject->PhoneNumber', '$EmployeeObject->AddressID', '$EmployeeObject->Birthdate', '$EmployeeObject->ShiftTime', '$EmployeeObject->JobTypeID', '$EmployeeObject->Salary')";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateEmployee($EmployeeObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE employees SET Empname='$EmployeeObject->Name', Empphone='$EmployeeObject->PhoneNumber',EmpaddressID='$EmployeeObject->AddressID', Empbirthdate='$EmployeeObject->Birthdate', Empshifttime='$EmployeeObject->ShiftTime',EmpjobtypeID='$EmployeeObject->JobTypeID', Empsalary='$EmployeeObject->Salary'";
        mysqli_query($connection, $sql);
    }

    function DeleteEmployee($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `employees` WHERE EmpID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['EmpID'])) {
        $EmployeeObject = new Employee($_REQUEST['EmpID']);
        $View = new EmployeeView();
        $View->ShowEmployeeDetails($EmployeeObject);

        if (isset($_POST['AddButton'])) {
            $Model = new Employee("");
            $Model->Name = $_POST['name'];
            $Model->PhoneNumber = $_POST['number'];
            $Model->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            $Model->Birthdate = $_POST['birthdate'];
            $Model->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            $Model->ShiftTime = $_POST['shifttime'];
            $Model->Salary = $_POST['salary'];
            AddEmployee($Model);
            echo "Added Successfully";
        }

        if (isset($_POST['UpdateButton'])) {
            if($_POST['name'] != "")
            {$EmployeeObject->Name = $_POST['name'];}
            if($_POST['number'] != "")
            {$EmployeeObject->PhoneNumber = $_POST['number'];}
            $EmployeeObject->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            if($_POST['birthdate'])
            {$EmployeeObject->Birthdate = $_POST['birthdate'];}
            $EmployeeObject->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            if($_POST['salary'])
            {$EmployeeObject->Salary = $_POST['salary'];}
            UpdateEmployee($EmployeeObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) {
            DeleteDoctor($EmployeeObject->ID);
            echo "Deleted Successfully";
        }
    }

?>