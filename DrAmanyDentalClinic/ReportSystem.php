<?php

    require_once 'M_Patient.php';
    require_once 'V_Patient.php';
    require_once 'M_Doctor.php';
    require_once 'V_Doctor.php';
    require_once 'M_Receptionist.php';
    require_once 'V_Receptionist.php';
    require_once 'M_Employee.php';
    require_once 'V_Employee.php';
    require_once 'M_MedicalHistory.php';
    require_once 'V_MedicalHistory.php';

    echo "<h1>Patients</h1>";
    $result = Patient::SelectAllPatients();
    $View = new PatientView();
    for ($i=0; $i < count($result); $i++) { 
        $View->ShowPatientDetails($result[$i]);
        echo "<br>";
    }

    echo "<br><h1>Doctors</h1>";
    $result = Doctor::SelectAllDoctors();
    $View = new DoctorView();
    for ($i=0; $i < count($result); $i++) { 
        $View->ShowDoctorDetails($result[$i]);
        echo "<br>";
    }

    echo "<br><h1>Receptionists</h1>";
    $result = Receptionist::SelectAllReceptionists();
    $View = new ReceptionistView();
    for ($i=0; $i < count($result); $i++) { 
        $View->ShowReceptionistDetails($result[$i]);
        echo "<br>";
    }

    echo "<br><h1>Employees</h1>";
    $result = Employee::SelectAllEmployees();
    $View = new EmployeeView();
    for ($i=0; $i < count($result); $i++) { 
        $View->ShowEmployeeDetails($result[$i]);
        echo "<br>";
    }

?>