<?php
    require_once "M_MedicalHistory.php";

    class MedicalHistoryView
    {
        public function  ShowMedicalHistoryDetails($MedicalHistoryObject)
        {
            $Temp = "<table border=2><tr><th>ID</td><td>";
            for ($i=0; $i < count($MedicalHistoryObject->ID); $i++) { 
                $Temp .= $MedicalHistoryObject->ID[$i]."<br>";
            }
            $Temp .= "</td></tr><tr><th>Medical History</th><td>";
            for ($i=0; $i < count($MedicalHistoryObject->Diagnosis); $i++) { 
                $Temp .= $MedicalHistoryObject->Diagnosis[$i]."<br>";
            }
            $Temp .= "</td></tr></table>";
            echo $Temp;
        }

        public function ShowAllMedicalHistory()
        {
            $result = MedicalHistory::SelectAllMedicalHistory();
            echo "<table border=2>";
            for($i=0; $i<count($result); $i++)
            {
                echo ("<tr><td><a href = C_MedicalHistory.php?MhistoryID=".$result[$i]->ID[$i]."&PatID=".$result[$i]->PatientID.">".$result[$i]->Diagnosis[$i]."</a></td></tr>");
                // $MedicalHistoryObject = new MedicalHistory($result[$i]->ID);
            }
            echo "</table>";
        }
    } 

?>


