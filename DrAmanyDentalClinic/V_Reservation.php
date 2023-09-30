<?php

    require_once 'M_Reservation.php';
    require_once 'Connection.php';

    class ReservationView
    {
        public function ShowAllReservations()
        {
            $result = Reservation::SelectAllReservations();
            echo "<table border=2>";
            echo "<th>Patient Name</th><th>Doctor Name</th>";
            for ($i=0; $i < count($result); $i++) 
            { 
                echo ("<tr><td><a href=C_Reservation.php?ResID=".$result[$i]->ID.">".$result[$i]->PatientName."</td><td>".$result[$i]->DoctorName."</a></td></tr>");
            }
            echo "</table>";
        }

        public function ShowReservationDetails($ReservationObject)
        {
            echo "<table border=2><tr><th>ID</th><td>".$ReservationObject->ID."</td></tr>";
            echo "<tr><th>Patient ID</th><td>".$ReservationObject->PatientID."</td></tr>";
            echo "<tr><th>Patient Name</th><td>".$ReservationObject->PatientName."</td></tr>";
            echo "<tr><th>Reservation Date</th><td>".$ReservationObject->ReservationDate."</td></tr>";
            echo "<tr><th>DoctorID</th><td>".$ReservationObject->DoctorID."</td></tr>";
            echo "<tr><th>Doctor Name</th><td>".$ReservationObject->DoctorName."</td></tr>";
            echo "</table>";
        }
    }
    

?>