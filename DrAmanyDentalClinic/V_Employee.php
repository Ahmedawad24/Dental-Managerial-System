<?php
    require_once 'M_Employee.php';
    require_once 'Connection.php';
    //require_once 'C_Employee.php';

    class EmployeeView
    {
        public function ShowAllEmployees()
        {
            $result = Employee::SelectAllEmployees();
            echo "<table border=2>";
            for($i=0;$i<count($result);$i++)
            {
                echo ("<tr><td><a href=C_Employee.php?EmpID=".$result[$i]->ID.">".$result[$i]->Name."</a><br></td></tr>");
            }
            echo "</table>";
        }

        public function ShowEmployeeDetails($EmployeeObject)
        {
            echo "<table border=2><tr><td>ID</td><td>".$EmployeeObject->ID."</td></tr>";
            echo "<tr><td>Full Name</td><td>".$EmployeeObject->Name."</td></tr>";
            echo "<tr><td>Phone Number</td><td>".$EmployeeObject->PhoneNumber."</td></tr>";
            echo "<tr><td>Address</td><td>".$EmployeeObject->Address."</td></tr>";
            echo "<tr><td>Birthdate</td><td>".$EmployeeObject->Birthdate."</td></tr>";
            echo "<tr><td>Shift Time</td><td>".$EmployeeObject->ShiftTime."</td></tr>";
            echo "<tr><td>Job Type</td><td>".$EmployeeObject->JobType."</td></tr>";
            echo "<tr><td>Salary</td><td>".$EmployeeObject->Salary."</td></tr>";
            echo "</table>";
        }
    }

?>