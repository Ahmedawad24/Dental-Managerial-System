<?php
    require_once 'Connection.php';
    require_once 'M_Address.php';
    require_once 'M_JobType.php';
    require_once 'Person.php';

    class Employee extends Person
    {
        public $ShiftTime;
        public $JobTypeID;
        public $JobType;
        public $Salary;

        function __construct($ID)
        {
            $db = Database::getInstance();
            if($ID != "")
            {
                $sql = "SELECT * FROM `employees` WHERE EmpID = $ID";
                $connection = Database::GetConnection();
                $EmployeeDataset = mysqli_query($connection, $sql) or die(mysqli_error());
                if($row = mysqli_fetch_array($EmployeeDataset))
                {
                    $this->ID = $row['EmpID'];
                    $this->Name = $row['Empname'];
                    $this->PhoneNumber = $row['Empphone'];
                    $this->AddressID = $row['EmpaddressID'];
                    $Temp = new Address($this->AddressID);
                    $this->Address = $Temp->Address;
                    $this->Birthdate = $row['Empbirthdate'];
                    $this->ShiftTime = $row['Empshifttime'];
                    $this->JobTypeID = $row["EmpjobtypeID"];
                    $Temp2 = new JobType($row['EmpjobtypeID']);
                    $this->JobType = $Temp2->JobTypeName;
                    $this->Salary = $row['Empsalary'];
                }
            }
        }

        public static function SelectAllEmployees()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM `employees` ORDER BY Empname";
            $connection = Database::GetConnection();
            $EmployeeDataset = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $i = 0;
            $result;
            while($row = mysqli_fetch_array($EmployeeDataset))
            {
                $result[$i] = new Employee($row['EmpID']);
                $i++;
            }
            return $result;
        }
    }
?>