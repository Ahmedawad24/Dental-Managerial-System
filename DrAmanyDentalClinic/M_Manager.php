<?php
    require_once 'Connection.php';
    require_once 'M_Address.php';
    require_once 'M_JobType.php';
    require_once 'M_Employee.php';

    class Manager extends Employee
    {
        function __construct($ID)
        {
            $db = Database::getInstance();
            if ($ID != "") 
            {
                $sql = "SELECT * FROM `manager` WHERE ManagerID = $ID";
                $connection = Database::GetConnection();
                $ManagerDataSet = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if ($row = mysqli_fetch_array($ManagerDataSet)) 
                {
                    $this->ID = $row['ManagerID'];
                    $this->Name = $row['Managername'];
                    $this->PhoneNumber = $row['Managerphone'];
                    $this->AddressID = $row['ManageraddressID'];
                    $Temp = new Address($this->AddressID);
                    $this->Address = $Temp->Address;
                    $this->Birthdate = $row['Managerbirthdate'];
                    $this->ShiftTime = $row['Managershiftime'];
                    $this->JobTypeID = $row["ManagerjobtypeID"];
                    $Temp2 = new JobType($this->JobTypeID);
                    $this->JobType = $Temp2->JobTypeName;
                    $this->Salary = $row['Managersalary'];
                }
            }
        }

        public static function SelectManagers()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM `manager` ORDER BY Managername";
            $connection = Database::GetConnection();
            $ManagerDataSet = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $i = 0;
            $result;
            while ($row = mysqli_fetch_array($ManagerDataSet))
            {
                $result[$i] = new Manager($row['ManagerID']);
                $i++;
            }
            return $result;
        }
        
    }
?>