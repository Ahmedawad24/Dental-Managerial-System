<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="stylePatient.css">
    </head>
    <body>
        <form action="" method="POST">
            <table class = "PatientTable">
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
            <tr><th>Blood Type</th><td>
                <select name="bloodtype" style="width:100%">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </td></tr>
            <tr><th>Healthcare ID</th><td><input type="number" name="healthcareid"></th></tr>
            <tr><th>Local ID</th><td><input type="number" name="localid"></th></tr>
            </table>
            <br>
            <button type="submit" name="AddButton" id="AddButton">Add</button>
            <button type="submit" name="UpdateButton" id="UpdateButton">Update</button>
            <button type="submit" name="DeleteButton" id="DeleteButton">Delete</button>
        </form>
    </body>
</html>

<?php

    echo "<br>";
    echo "<button type='submit' id='AddButton'><a href=C_MedicalHistory.php?PatID=".$_REQUEST['PatID'].">Add Diagnosis</a></button>";
    echo "<br>";
    
    require_once 'Connection.php';
    require_once 'M_Patient.php';
    require_once 'V_Patient.php';
    require_once 'Strategy.php';

    function AddPatient($PatientObject) {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO patients (Patname, PatEmail, Patphone, PataddressID, Patbirthdate, Patbloodtype, PathealthcareID, PatlocalID) VALUES ('$PatientObject->Name', '$PatientObject->Email', '$PatientObject->PhoneNumber', '$PatientObject->AddressID', '$PatientObject->Birthdate', '$PatientObject->BloodType', '$PatientObject->HealthcareID', '$PatientObject->LocalID')";
        mysqli_fetch_array($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdatePatient($PatientObject) {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE patients SET Patname='$PatientObject->Name', PatEmail='$PatientObject->Email', Patphone='$PatientObject->PhoneNumber', Patbirthdate='$PatientObject->Birthdate', Patbloodtype='$PatientObject->BloodType', Pathealthcareid='$PatientObject->HealthcareID', PatlocalID='$PatientObject->LocalID'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeletePatient($ID) {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `patients` WHERE PatID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['PatID'])) {
        $PatientObject = new Patient($_REQUEST['PatID']);
        $View = new PatientView();
        $View->ShowPatientDetails($PatientObject);

        if (isset($_POST['AddButton'])) {
            $Model = new Patient("");
            $Model->Name = $_POST['name'];
            $Model->Email = $_POST['email'];
            $Model->PhoneNumber = $_POST['number'];
            $Model->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            $Model->Birthdate = $_POST['birthdate'];
            $Model->BloodType = mysqli_real_escape_string(Database::GetConnection(), $_POST['bloodtype']);
            $Model->HealthCareID = $_POST['healthcareid'];
            $Model->LocalID = $_POST['localid'];
            AddPatient($Model);
            echo "Added Successfully";
        }

        if (isset($_POST['UpdateButton'])) {
            if($_POST['name'] != "")
            {$PatientObject->Name = $_POST['name'];}
            if($_POST['email'] != "")
            {$PatientObject->Email = $_POST['email'];}
            if($_POST['number'] != "")
            {$PatientObject->PhoneNumber = $_POST['number'];}
            $PatientObject->AddressID = mysqli_real_escape_string(Database::GetConnection(), $_POST['address']);
            if($_POST['birthdate'] != "")
            {$PatientObject->Birthdate = $_POST['birthdate'];}
            $PatientObject->BloodType = mysqli_real_escape_string(Database::GetConnection(), $_POST['bloodtype']);
            if($_POST['healthcareid'] != "")
            $PatientObject->HealthCareID = $_POST['healthcareid'];
            if($_POST['localid'] != "")
            {$PatientObject->LocalID = $_POST['localid'];}
            UpdatePatient($PatientObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) {
            DeletePatient($PatientObject->ID);
            echo "Deleted Successfully";
        }

        if (isset($_POST['CashPay'])) {
            $Method = new Method("");
            $cash = new CashMethod("Credit Card");
            echo $cash->showMethod($Method);
        }

        if (isset($_POST['CreditPay'])) {
            $Method = new Method("");
            $credit = new CreditCardMethod("Credit Card");
            echo $credit->showMethod($Method);
        }
    }
?>