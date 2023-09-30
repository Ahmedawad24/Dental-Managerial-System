<?php
    require_once 'M_JobType.php';
    require_once 'Connection.php';

    class JobTypeView
    {
        public function ShowAllJobTypes()
        {
            $result = JobType::SelectAllJobTypes();
            echo "<table border=2>";
            for($i=0;$i<count($result);$i++)
            {
                echo "<tr><td><a href=C_JobType.php?JobtypeID=".$result[$i]->JobTypeID.">".$result[$i]->JobTypeName."</a><br></td></tr>";
            }
            echo "</table>";
        }

        public function ShowJobTypeDetails($JobTypeObject)
        {
            echo "<table border=2><tr><th>ID</th><td>".$JobTypeObject->JobTypeID."</td></tr>";
            echo "<tr><th>Job</th><td>".$JobTypeObject->JobTypeName."</td></tr>";
            echo "</table>";
        }
    }
?>