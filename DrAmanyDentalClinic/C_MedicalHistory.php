<!DOCTYPE html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="" method="POST">
            <table border=2>
            <tr><th>Diagnosis</th><td>
            <input type="text" name="diagnosis" style="height:100px">
            </td></tr>
            </table>
            <br>
            <button type="submit" name="AddButton" value="Add">Add Diagnosis</button>
            <br>
            <button type="submit" name="AddSyringe" value="Syringe">Add Syringe</button>
            <button type="submit" name="AddCotton" value="Cotton">Add Cotton</button>
        </form>
    </body>
</html>

<?php
    echo "<br>";
    echo "<button type='submit'><a href=PrintInvoice.php>Print Invoice</a></button>";
    echo "<br>";

    require_once 'Connection.php';
    require_once 'M_MedicalHistory.php';
    require_once 'V_MedicalHistory.php';
    require_once 'Invoice.php';
    $invoice = new BaseInvoice("", 100);
    $decorator = new InvoiceDecorator($invoice);
    $SyringeDecorator = new Syringe($decorator);
    $CottonDecorator = new Cotton($decorator);

    echo "<a href=".$SyringeDecorator->AddSyringe().">Add Syringe</a>";
    echo "<br>";
    echo "<a href=".$CottonDecorator->AddCotton().">Add Cotton</a>";

    function AddMedicalHistory($MedicalHistoryObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $Model = new MedicalHistory("");
        $Model->Diagnosis = $_POST['diagnosis'];
        $Model->PatientID = $_REQUEST['PatID'];
        $sql = "INSERT INTO medicalhistory(DIagnosis, PatID) VALUES '$Model->Diagnosis', '$Model->PatientID'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateMedicalHistory($MedicalHistoryObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE medicalhistory SET DIagnosis='$MedicalHistoryObject->Diagnosis', PatID='$MedicalHistoryObject->PatientID'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeleteMedicalHistory($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `medicalhistory` WHERE PatID = $ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['PatID'])) {
        $MedicalHistoryObject = new MedicalHistory($_REQUEST['PatID']);
        $ID = $MedicalHistoryObject->ID;
        $View = new MedicalHistoryView();
        $View->ShowMedicalHistoryDetails($MedicalHistoryObject);
        

        if (isset($_POST['AddButton'])) {
            $Model = new MedicalHistory("");
            $Model->Diagnosis = $_POST['diagnosis'];
            $Model->PatientID = $_REQUEST['PatID'];
            AddMedicalHistory($Model);
            echo "Added Successfully";
        }

        if (isset($_POST['AddSyringe'])) {
            $SyringeDecorator->AddSyringe();
            echo $decorator->showDetails();
            echo "<br> Total Money: ";
            echo $decorator->showMoney();
            $_SESSION['Invoice'] = $decorator;
        }

        if (isset($_POST['AddCotton'])) {
            $CottonDecorator->AddCotton();
            echo $decorator->showDetails();
            echo "<br> Total Money: ";
            echo $decorator->showMoney();
            $_SESSION['Invoice'];
        }
    }

?>