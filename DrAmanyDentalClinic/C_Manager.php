<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="styleManager.css">
    </head>
    <body>
        <form action="" method="POST">
            <table class = "ManagerTable">
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
    require_once 'M_Manager.php';
    require_once 'V_Manager.php';

    function AddManager($ManagerObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO manager(Managername, Managerphone, ManageraddressID, Managerbirthdate, Managershifttime, ManagerjobtypeID, Managersalary) VALUES ('$ManagerObject->Name', '$ManagerObject->PhoneNumber', '$ManagerObject->AddressID', '$ManagerObject->Birthdate', '$ManagerObject->ShiftTime', '$ManagerObject->JobTypeID', '$ManagerObject->Salary')";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateManager($ManagerObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE manager SET Managername='$ManagerObject->Name', Managerphone='$ManagerObject->PhoneNumber', ManageraddressID='$ManagerObject->AddressID', Managerbirthdate='$ManagerObject->Birthdate', Managershifttime='$ManagerObject->ShiftTime', ManagerjobtypeID='$ManagerObject->JobTypeID', Managersalary='$ManagerObject->Salary'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeleteManager($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `manager` WHERE ManagerID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['ManagerID'])) 
    {
        $ManagerObject = new Manager($_REQUEST['ManagerID']);
        $View = new ManagerView();
        $View->ShowManagerDetails($ManagerObject);

        if (isset($_POST['AddButton'])) 
        {
            $Model = new Manager("");
            $Model->Name = $_POST['name'];
            $Model->PhoneNumber = $_POST['number'];
            $Model->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            $Model->Birthdate = $_POST['birthdate'];
            $Model->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            $Model->ShiftTime = $_POST['shifttime'];
            $Model->Salary = $_POST['salary'];
            AddManager($Model);
            echo "Added Successfully";
        }

        if (isset($_POST['UpdateButton'])) 
        {
            if($_POST['name'] != "")
            {$ManagerObject->Name = $_POST['name'];}
            if($_POST['number'] != "")
            {$ManagerObject->PhoneNumber = $_POST['number'];}
            $ManagerObject->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            if($_POST['birthdate'] != "")
            {$ManagerObject->Birthdate = $_POST['birthdate'];}
            $ManagerObject->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            if($_POST['shifttime'] != "")
            {$ManagerObject->ShiftTime = $_POST['shifttime'];}
            if($_POST['salary'])
            {$ManagerObject->Salary = $_POST['salary'];}
            UpdateManager($ManagerObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) 
        {
            DeleteManager($ManagerObject->ID);
            echo "Deleted Successfully";
        }
    }

?>