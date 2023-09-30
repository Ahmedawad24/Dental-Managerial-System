<?php

    require_once 'Connection.php';
    require_once 'M_Employee.php';
    require_once 'M_Address.php';
    require_once 'M_JobType.php';

    class Receptionist extends Employee
    {
        function __construct($ID)
        {
            $db = Database::getInstance();
            if ($ID != "") 
            {
                $sql = "SELECT * FROM `receptionists` WHERE RecID = $ID";
                $connection = Database::GetConnection();
                $ReceptionistDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($row = mysqli_fetch_array($ReceptionistDataset)) 
                {
                    $this->ID = $row['RecID'];
                    $this->Name = $row['Recname'];
                    $this->PhoneNumber = $row['Recphone'];
                    $this->AddressID = $row['RecaddressID'];
                    $Temp = new Address($this->AddressID);
                    $this->Address = $Temp->Address;
                    $this->Birthdate = $row['Recbirthdate'];
                    $this->ShiftTime = $row['Recshifttime'];
                    $this->JobTypeID = $row['RecjobtypeID'];
                    $Temp2 = new JobType($this->JobTypeID);
                    $this->JobType = $Temp2->JobTypeName;
                    $this->Salary = $row['Recsalary'];
                }
            }
        }

        public static function SelectAllReceptionists()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM `receptionists` ORDER BY Recname";
            $connection = Database::GetConnection();
            $ReceptionistDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $i = 0;
            $result;
            while ($row = mysqli_fetch_array($ReceptionistDataset)) 
            {
                $result[$i] = new Receptionist($row['RecID']);
                $i++;
            }
            return $result;
        }
    }
    

?>