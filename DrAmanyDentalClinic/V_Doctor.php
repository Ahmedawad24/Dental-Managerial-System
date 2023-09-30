<?php
    require_once 'M_Doctor.php';
    require_once 'Connection.php';

    class DoctorView
    {
        public function ShowAllDoctors()
        {
            $result = Doctor::SelectAllDoctors();
            echo "<table border=2>";
            for($i=0;$i<count($result);$i++)
            {
                echo ("<tr><td><a href = C_Doctor.php?DocID=".$result[$i]->ID.">".$result[$i]->Name."</a><br></td></tr>");
            }
            echo "</table>";
        }

        public function ShowDoctorDetails($DoctorObject)
        {
            echo "<table border=2><tr><td>ID</td><td>".$DoctorObject->ID."</td></tr>";
            echo "<tr><td>Full Name</td><td>".$DoctorObject->Name."</td></tr>";
            echo "<tr><td>Phone Number</td><td>".$DoctorObject->PhoneNumber."</td></tr>";
            echo "<tr><td>Address</td><td>".$DoctorObject->Address."</td></tr>";
            echo "<tr><td>Birthdate</td><td>".$DoctorObject->Birthdate."</td></tr>";
            echo "<tr><td>Shift Time</td><td>".$DoctorObject->ShiftTime."</td></tr>";
            echo "<tr><td>Job Type</td><td>".$DoctorObject->JobType."</td></tr>";
            echo "<tr><td>Salary</td><td>".$DoctorObject->Salary."</td></tr>";
            echo "</table>";
        }
    }
?>