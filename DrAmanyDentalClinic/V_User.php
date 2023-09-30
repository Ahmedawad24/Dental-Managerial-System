<?php
    require_once 'M_User.php';
    require_once 'Connection.php';

    class UserView
    {
        public function ShowAllUsers()
        {
            $result = User::SelectAllUsers();
            echo "<table border=2>";
            for($i=0; $i<count($result); $i++)
            {
                echo("<tr><td><a href = C_User.php?UserID=".$result[$i]->ID.">".$result[$i]->Username."</a><br></td></tr>");
            }
            echo "</table>";
        }

        public function ShowUsersDetails($UserObject)
        {
            echo "<table border = 2> <tr><th>ID</th><td>".$UserObject->ID."</td></tr>";
            echo "<tr><th>Username</th><td>".$UserObject->Username."</td></tr>";
            echo "<tr><th>Password</th><td>".$UserObject->Password."</td></tr>";
            echo "<tr><th>User Type</th><td>".$UserObject->UserType."</td></tr>";
            echo "</table>";
        }
    }
?>