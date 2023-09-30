<?php
    require_once 'Connection.php';
    require_once 'M_Address.php';
    require_once 'M_JobType.php';
    require_once 'M_MedicalHistory.php';
    require_once 'Person.php';

    class Patient extends Person
    {
        public $Email;
        public $BloodType;
        public $HealthCareID;
        public $LocalID;
        public $MedicalDiagnosisID;
        public $MedicalDiagnosisObj;

        function __construct($ID)
        {
            $db = Database::getInstance();
            if ($ID != "") 
            {
                $sql = "SELECT * FROM `patients` WHERE PatID = $ID";
                $connecntion = Database::GetConnection();
                $PatientDataset = mysqli_query($connecntion, $sql) or die(mysqli_error());
                if($row = mysqli_fetch_array($PatientDataset))
                {
                    $this->ID = $row['PatID'];
                    $this->Name = $row['Patname'];
                    $this->Email = $row['PatEmail'];
                    $this->PhoneNumber = $row['Patphone'];
                    $this->AddressID = $row['PataddressID'];
                    $Temp = new Address($row['PataddressID']);
                    $this->Address = $Temp->Address;
                    $this->Birthdate = $row['Patbirthdate'];
                    $this->BloodType = $row['Patbloodtype'];
                    $this->HealthCareID = $row['PathealthcareID'];
                    $this->LocalID = $row['PatlocalID'];
                    $Temp = new MedicalHistory($row['PatmedicalhistoryID']);
                    for ($i=0; $i < count($Temp->Diagnosis); $i++) { 
                        $this->MedicalDiagnosisObj[$i] = $Temp->Diagnosis[$i];
                    }
                }
            }
        }

        public static function SelectAllPatients()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM `patients` ORDER BY Patname";
            $connecntion = Database::GetConnection();
            $PatientDataset = mysqli_query($connecntion, $sql) or die(mysql_error());
            $i = 0;
            $result;
            while($row = mysqli_fetch_array($PatientDataset))
            {
                $result[$i] = new Patient($row['PatID']);
                $i++;
            }
            return $result;
        }
    }

?>