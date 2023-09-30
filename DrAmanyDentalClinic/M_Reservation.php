<?php

    require_once 'Connection.php';
    require_once 'M_Patient.php';
    require_once 'M_Doctor.php';

    class Reservation
    {
        public $ID;
        public $PatientID;
        public $PatientName;
        public $ReservationDate;
        public $DoctorID;
        public $DoctorName;

        public function __construct($ID)
        {
            $db = Database::getInstance();
            if ($ID != "") 
            {
                $sql = "SELECT * FROM `reservations` WHERE ResID = $ID";
                $connection = Database::GetConnection();
                $ReservationDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($row = mysqli_fetch_array($ReservationDataset)) 
                {
                    $this->ID = $row['ResID'];
                    $this->PatientID = $row['PatientID'];
                    $Model = new Patient($this->PatientID);
                    $this->PatientName = $Model->Name;
                    $this->ReservationDate = $row['ResDate'];
                    $this->DoctorID = $row['DoctorID'];
                    $Model = new Doctor($this->DoctorID);
                    $this->DoctorName = $Model->Name;
                }
            }
        }

        public static function SelectAllReservations()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM `reservations` ORDER BY ResDate";
            $connection = Database::GetConnection();
            $ReservationDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $i = 0;
            $result;
            while ($row = mysqli_fetch_array($ReservationDataset)) 
            {
                $result[$i] = new Reservation($row['ResID']);
                $i++;
            }
            return $result;
        }
    }
    

?>