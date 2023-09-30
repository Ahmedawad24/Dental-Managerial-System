<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="styleReceptionist.css">
    </head>
    <body>
        <form action="" method="POST">
            <table class = "ReceptionistTable">
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
    require_once 'M_Receptionist.php';
    require_once 'V_Receptionist.php';

    function AddReceptionist($ReceptionistObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO receptionists(Recname, Recphone, RecaddressID, Recbirthdate, Recshifttime, RecjobtypeID, Recsalary) VALUES ('$ReceptionistObject->Name', '$ReceptionistObject->PhoneNumber', '$ReceptionistObject->AddressID', '$ReceptionistObject->Birthdate', '$ReceptionistObject->ShiftTime', '$ReceptionistObject->JobTypeID', '$ReceptionistObject->Salary')";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateReceptionist($ReceptionistObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE receptionists SET Recname='$ReceptionistObject->Name', Recphone='$ReceptionistObject->PhoneNumber',RecaddressID='$ReceptionistObject->AddressID', Recbirthdate='$ReceptionistObject->Birthdate', Recshifttime='$ReceptionistObject->ShiftTime',RecjobtypeID='$ReceptionistObject->JobTypeID', Recsalary='$ReceptionistObject->Salary'";
        mysqli_query($connection, $sql);
    }

    function DeleteReceptionist($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `receptionists` WHERE RecID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['RecID'])) 
    {
        $ReceptionistObject = new Receptionist($_REQUEST['RecID']);
        $View = new ReceptionistView();
        $View->ShowReceptionistDetails($ReceptionistObject);

        if (isset($_POST['AddButton'])) {
            $Model = new Receptionist("");
            $Model->Name = $_POST['name'];
            $Model->PhoneNumber = $_POST['number'];
            $Model->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            $Model->Birthdate = $_POST['birthdate'];
            $Model->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            $Model->ShiftTime = $_POST['shifttime'];
            $Model->Salary = $_POST['salary'];
            AddReceptionist($Model);
            echo "Added Successfully";
        }

        if (isset($_POST['UpdateButton'])) {
            if($_POST['name'] != "")
            {$ReceptionistObject->Name = $_POST['name'];}
            if($_POST['number'])
            {$ReceptionistObject->PhoneNumber = $_POST['number'];}
            $ReceptionistObject->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            if($_POST['birthdate'])
            {-$ReceptionistObject->Birthdate = $_POST['birthdate'];}
            $ReceptionistObject->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            if($_POST['salary'])
            {$ReceptionistObject->Salary = $_POST['salary'];}
            UpdateReceptionist($ReceptionistObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) {
            DeleteReceptionist($ReceptionistObject->ID);
            echo "Deleted Successfully";
        }
    }

?>