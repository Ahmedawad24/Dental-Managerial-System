<!DOCTYPE html>
    <head>
        <title>Dr.AmanyDentalClinic</title>
        <link rel="stylesheet" type="text/css" href="styleJobType.css">
    </head>
    <body>
        <form action="" method="POST">
            <table class="JobTypeTable">
            <tr><th>Job</th><td><input type="text" name="job"></td></tr>
            </table>
            <br>
            <button type="submit" name="AddButton" value="Add" id="AddButton">Add</button>
            <button type="submit" name="UpdateButton" value="Update" id="UpdateButton">Update</button>
            <button type="submit" name="DeleteButton" value="Delete" id="DeleteButton">Delete</button>
        </form>
    </body>
</html>

<?php

    require_once 'Connection.php';
    require_once 'M_JobType.php';
    require_once 'V_JobType.php';

    function AddJobType($JobTypeObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO jobtypes (jobtypename) VALUES '$JobTypeObject->JobTypeName'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateJobType($JobTypeObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE jobtypes SET jobtypename='$JobTypeObject->JobTypeName' WHERE JobtypeID = '$JobTypeObject->JobTypeID'";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeleteJobType($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `jobtypes` WHERE JobtypeID = $JobTypeObject->JobTypeID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_REQUEST['JobtypeID'])) {
        $JobTypeObject = new JobType($_REQUEST['JobtypeID']);
        $View = new JobTypeView();
        $View->ShowJobTypeDetails($JobTypeObject);

        if (isset($_POST['AddButton'])) {
            $Model = new JobType("");
            $Model->JobTypeName = $_POST['job'];
            AddJobType($JobTypeObject);
            echo "Added Successfully";
        }

        if (isset($_POST['UpdateButton'])) {
            $JobTypeObject->JobTypeName = $_POST['job'];
            UpdateJobType($JobTypeObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) {
            DeleteJobType($JobTypeObject->JobTypeID);
            echo "Deleted Successfully";
        }
    }

?>