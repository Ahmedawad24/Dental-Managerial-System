<?php
    require_once 'Connection.php';
    require_once 'M_Address.php';
    require_once 'M_JobType.php';
    require_once 'M_Employee.php';
    
    class Doctor extends Employee
    {
        function __construct($ID)
        {
            $db = Database::getInstance();
            if($ID != "")
            {
                $sql = "SELECT * FROM `doctors` WHERE DocID = $ID";
                $connection = Database::GetConnection();
                $DoctorDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if($row = mysqli_fetch_array($DoctorDataset))
                {
                    $this->ID = $row['DocID'];
                    $this->Name = $row['Docname'];
                    $this->PhoneNumber = $row['Docphone'];
                    $this->AddressID = $row['DocaddressID'];
                    $Temp = new Address($row['DocaddressID']);
                    $this->Address = $Temp->Address;
                    $this->Birthdate = $row['Docbirthdate'];
                    $this->ShiftTime = $row['Docshifttime'];
                    $this->JobTypeID = $row['DocjobtypeID'];
                    $Temp2 = new JobType($row['DocjobtypeID']);
                    $this->JobType = $Temp2->JobTypeName;
                    $this->Salary = $row["Docsalary"];
                }
            }
        }

        public static function SelectAllDoctors()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM `doctors` ORDER BY Docname";
            $connection = Database::GetConnection();
            $DoctorDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $i = 0;
            $result;
            while($row = mysqli_fetch_array($DoctorDataset))
            {
                $result[$i] = new Doctor($row['DocID']);
                $i++;
            }
            return $result;
        }
    }
?>