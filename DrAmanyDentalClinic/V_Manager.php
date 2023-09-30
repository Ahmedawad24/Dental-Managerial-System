<?php
    require_once 'M_Manager.php';
    require_once 'Connection.php';
    //require_once 'C_Manager.php';

    class ManagerView
    {
        public function ShowAllManagers()
        {
            $result = Manager::SelectManagers();
            echo "<table border=2>";
            for($i=0; $i<count($result); $i++)
            {
                echo ("<tr><td><a href=C_Manager.php?ManagerID=".$result[$i]->ID.">".$result[$i]->Name."</a><br></td></tr>");
            }
            echo "</table>";
        }

        public function ShowManagerDetails($ManagerObject)
        {
            echo "<table border=2><tr><td>ID</td><td>".$ManagerObject->ID."</td></tr>";
            echo "<tr><td>Full Name</td><td>".$ManagerObject->Name."</td></tr>";
            echo "<tr><td>Phone Number</td><td>".$ManagerObject->PhoneNumber."</td></tr>";
            echo "<tr><td>Address</td><td>".$ManagerObject->Address."</td></tr>";
            echo "<tr><td>Birthdate</td><td>".$ManagerObject->Birthdate."</td></tr>";
            echo "<tr><td>Shift Time</td><td>".$ManagerObject->ShiftTime."</td></tr>";
            echo "<tr><td>Job Type</td><td>".$ManagerObject->JobType."</td></tr>";
            echo "<tr><td>Salary</td><td>".$ManagerObject->Salary."</td></tr>";
            echo "</table>";
        }
    }
?>


