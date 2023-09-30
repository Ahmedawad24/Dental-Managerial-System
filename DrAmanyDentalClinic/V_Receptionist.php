<?php
    require_once 'M_Receptionist.php';
    require_once 'Connection.php';

    class ReceptionistView
    {
        public function ShowAllReceptionists()
        {
            $result = Receptionist::SelectAllReceptionists();
            echo "<table border=2>";
            for ($i=0; $i < count($result); $i++) 
            { 
                echo ("<tr><td><a href=C_Receptionist.php?RecID=".$result[$i]->ID.">".$result[$i]->Name."</a><br></td></tr>");
            }
            echo "</table>";
        }

        public function ShowReceptionistDetails($ReceptionistObject)
        {
            echo "<table border=2><tr><td>ID</td><td>".$ReceptionistObject->ID."</td></tr>";
            echo "<tr><td>Full Name</td><td>".$ReceptionistObject->Name."</td></tr>";
            echo "<tr><td>Phone Number</td><td>".$ReceptionistObject->PhoneNumber."</td></tr>";
            echo "<tr><td>Address</td><td>".$ReceptionistObject->Address."</td></tr>";
            echo "<tr><td>Birthdate</td><td>".$ReceptionistObject->Birthdate."</td></tr>";
            echo "<tr><td>Shift Time</td><td>".$ReceptionistObject->ShiftTime."</td></tr>";
            echo "<tr><td>Job Type</td><td>".$ReceptionistObject->JobType."</td></tr>";
            echo "<tr><td>Salary</td><td>".$ReceptionistObject->Salary."</td></tr>";
            echo "</table>";
        }
    }
    
?>