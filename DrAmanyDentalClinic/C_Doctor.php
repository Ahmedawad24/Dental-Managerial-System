<!DOCTYPE html>
    <head>
    <title>Dr.AmanyDentalClinic</title>
    <link rel="stylesheet" type="text/css" href="styleDoctor.css">
    </head>
    <body>
        <form action="" method="POST">
             <table class = "DoctorTable">
               
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
    require_once 'M_Doctor.php';
    require_once 'V_Doctor.php';

    function AddDoctor($DoctorObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO doctors(Docname, Docphone, DocaddressID, Docbirthdate, Docshifttime, DocjobtypeID, Docsalary) VALUES ('$DoctorObject->Name','$DoctorObject->PhoneNumber','$DoctorObject->AddressID','$DoctorObject->Birthdate','$DoctorObject->ShiftTime','$DoctorObject->JobTypeID','$DoctorObject->Salary')";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateDoctor($DoctorObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE doctors SET Docname='$DoctorObject->Name',Docphone='$DoctorObject->PhoneNumber',Docbirthdate='$DoctorObject->Birthdate',Docshifttime='$DoctorObject->ShiftTime',Docsalary='$DoctorObject->Salary' WHERE DocID = '$DoctorObject->ID'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeleteDoctor($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `doctors` WHERE DocID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['DocID'])) {
        $DoctorObject = new Doctor($_REQUEST['DocID']);
        $View = new DoctorView();
        $View->ShowDoctorDetails($DoctorObject);

        if (isset($_POST['AddButton'])) {
            $Model = new Doctor("");
            $Model->Name = $_POST['name'];
            $Model->PhoneNumber = $_POST['number'];
            $Model->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            $Model->Birthdate = $_POST['birthdate'];
            $Model->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            $Model->ShiftTime = $_POST['shifttime'];
            $Model->Salary = $_POST['salary'];
            AddDoctor($Model);
            echo "Addedd Successfully";
        }
    
        if (isset($_POST['UpdateButton'])) {
            if($_POST['name'] != "")
            {$DoctorObject->Name = $_POST['name'];}
            if($_POST['number'] != "")
            {$DoctorObject->PhoneNumber = $_POST['number'];}
            $DoctorObject->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            if($_POST['birthdate'] != "")
            {$DoctorObject->Birthdate = $_POST['birthdate'];}
            if($_POST['shifttime'] != "")
            {$DoctorObject->ShiftTime = $_POST['shifttime'];}
            $DoctorObject->JobTypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['jobtype']);
            if($_POST['salary'] != "")
            {$DoctorObject->Salary = $_POST['salary'];}
            UpdateDoctor($DoctorObject);
            echo "Updated Successfully";
        }
    
        if (isset($_POST['DeleteButton'])) {
            DeleteDoctor($DoctorObject->ID);
            echo "Deleted Successfully";
        }
    }
    

?>