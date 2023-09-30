<!DOCTYPE html>
    <head>
        <title>Dr.AmanyClinic</title>
        <link rel="stylesheet" type="text/css" href="styleReservation.css">
    </head>
    <body>
        <form action="" method="POST">
            <table class = "ReservationTable">
                <tr><th>Patient</th><td>
                    <select name="patientname" style="width:100%">
                    <?php
                        require_once 'Connection.php';
                        $sql = "SELECT * FROM `patients`";
                        $result = mysqli_query(Database::GetConnection(), $sql);
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='".$row['PatID']."'>".$row['Patname']."</option>";
                        }
                    ?>
                    </select>
                </td></tr>
                <tr><th>Reservation Date</th><td><input type="datetime-local" name="reservationdate"></td></tr>
                <tr><th>Doctor</th><td>
                    <select name="doctorname" style="width:100%">
                    <?php
                        require_once 'Connection.php';
                        $sql = "SELECT * FROM `doctors`";
                        $result = mysqli_query(Database::GetConnection(), $sql) or die(mysqli_error($connection));
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='".$row['DocID']."'>".$row['Docname']."</option>";
                        }
                    ?>
                    </select>
                </td></tr>
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
    require_once 'M_Reservation.php';
    require_once 'V_Reservation.php';
    require_once 'Observer.php';
    
    function Check($ReservationObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "SELECT * FROM `reservations`";
        $ReservationDataset = mysqli_query($connection, $sql);
        $found = FALSE;
        while ($row = mysqli_fetch_array($ReservationDataset) and $found == FALSE) {
            if ($_POST['reservationdate'] == $row['ResDate'] and mysqli_real_escape_string($connection, $_POST['doctorname']) == $row['DoctorID']) {
                $found = TRUE;
            }
        }
        return $found;
    }

    function AddReservation($ReservationObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO reservations(PatientID, ResDate, DoctorID) VALUES ('$ReservationObject->PatientID', '$ReservationObject->ReservationDate', '$ReservationObject->DoctorID')";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateReservation($ReservationObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE reservations SET PatientID='$ReservationObject->PatientID', ResDate='$ReservationObject->ReservationDate', DoctorID='$ReservationObject->DoctorID' WHERE ResID = $ReservationObject->ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeleteReservation($ID)
    {
        $db = Database::getInstance();
        $connection - Database::GetConnection();
        $sql = "DELETE * FROM `reservations` WHERE ResID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['ResID'])) {
        $ReservationObject = new Reservation($_REQUEST['ResID']);
        $View = new ReservationView();
        $View->ShowReservationDetails($ReservationObject);

        if (isset($_POST['AddButton']))
         {
            $Model = new Reservation("");
            $Model->PatientID = mysqli_real_escape_string(Database::GetConnection(), $_POST['patientname']);
            $Model->ReservationDate = $_POST['reservationdate'];
            $Model->DoctorID = mysqli_real_escape_string(Database::GetConnection(), $_POST['doctorname']);
            AddReservation($Model);
            echo "Added Successfully";

            print('Email Processing');
            print('');

            $newp = new Patient($ReservationObject->PatientID);
            $Reserve = new PatternSubject();
            $ReserveFan = new PatternObserver();
            $Reserve->register($ReserveFan);
            $myfile = fopen("Notifications.txt", "w") or die("Unable to open file!");

            $txt = "Dr Amany Dental Clinic" . "\n";
            fwrite($myfile,$txt);

            $txt = "Send From:";
            $txt2 = "dramanydentalclinic@gmail.com" . "\n";
            fwrite($myfile,$txt);
            fwrite($myfile,$txt2);

            $txt = "Send To:";
            $txt2 = $newp->Email . "\n";
            fwrite($myfile,$txt);
            fwrite($myfile,$txt2);
            
            $txt = "Dear Mr." . $newp->Name . "\n";
            $txt2 = "Your Reservation Date is going to be on." . "\n";
            fwrite($myfile,$txt);
            fwrite($myfile,$txt2);

            $txt = " Date: ";
            $txt2 =$ReservationObject->ReservationDate . "\n";
            fwrite($myfile,$txt);
            fwrite($myfile, $txt2);
            
            fclose($myfile);
            $Reserve->updateFavorites('Notifications.txt');

        }

        if (isset($_POST['UpdateButton'])) {
            $ReservationObject->PatientID = mysqli_real_escape_string(Database::GetConnection(), $_POST['patientname']);
            $ReservationObject->ReservationDate = $_POST['reservationdate'];
            $ReservationObject->DoctorID = mysqli_real_escape_string(Database::GetConnection(), $_POST['doctorname']);
            UpdateReservation($ReservationObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) {
            DeleteReservation($ReservationObject->ID);
            echo "Deleted Successfully";
        }
    }

?>