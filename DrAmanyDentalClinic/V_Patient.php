<?php
    require_once 'M_Patient.php';
    require_once 'Connection.php';
    //require_once 'C_Patient.php';

    class PatientView
    {
        public function ShowAllPatients()
        {
            $result = Patient::SelectAllPatients();
            echo "<table border=2>";
            for($i=0;$i<count($result);$i++)
            {
                echo ("<tr><td><a href=C_Patient.php?PatID=".$result[$i]->ID.">".$result[$i]->Name."</a><br></td></tr>");
            }
            echo "</table>";
        }

        public function ShowPatientDetails($PatientObject)
        {
            echo "<table border=2><tr><th>ID</th><td>".$PatientObject->ID."</td></tr>";
            echo "<tr><th>Full Name</th><td>".$PatientObject->Name."</td></tr>";
            echo "<tr><th>Email</th><td>".$PatientObject->Email."</td></tr>";
            echo "<tr><th>Phone Number</th><td>".$PatientObject->PhoneNumber."</td></tr>";
            echo "<tr><th>Address</th><td>".$PatientObject->Address."</td></tr>";
            echo "<tr><th>Birthdate</th><td>".$PatientObject->Birthdate."</td></tr>";
            echo "<tr><th>Blood Type</th><td>".$PatientObject->BloodType."</td></tr>";
            echo "<tr><th>Healthcare ID</th><td>".$PatientObject->HealthCareID."</td></tr>";
            echo "<tr><th>Local ID</th><td>".$PatientObject->LocalID."</td></tr>";
            echo "<tr><th>Medical History</th><td>";
            for($i=0;$i<count($PatientObject->MedicalDiagnosisObj);$i++)
            {
                echo $PatientObject->MedicalDiagnosisObj[$i]."<br>";
            }
            echo "</td></tr>";
            echo "</table>";
        }
    }

?>