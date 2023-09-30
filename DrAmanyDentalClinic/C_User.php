<!DOCTYPE html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="" method="POST">
            <table border=2>
            <tr><th>Username</th><td><input type="text" name="username"></td></tr>
            <tr><th>Password</th><td><input type="password" name="password"></td></tr>
            <tr><th>User Type</th><td>
                <select name="usertype" style="width:100%">
                <?php
                    require_once 'Connection.php';
                    $sql = "SELECT * FROM `usertype`";
                    $result = mysqli_query(Database::GetConnection(), $sql);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
                    {
                        echo "<option value='".$row['UsertypeID']."'>".$row['Usertype']."</option>";
                    }
                ?>
                </select>
            </td></tr>
            </table>
            <br>
            <button type="submit" name="AddButton" value="Add">Add</button>
            <button type="submit" name="UpdateButton" value="Update">Update</button>
            <button type="submit" name="DeleteButton" value="Delete">Delete</button>
        </form>
    </body>
</html>

<?php

    require_once 'Connection.php';
    require_once 'M_User.php';
    require_once 'V_User.php';

    function AddUser($UserObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "INSERT INTO `users` (`Username`, `Password`, `UsertypeID`) VALUES $UserObject->Username, $UserObject->Password, $UserObject->JobtypeID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function UpdateUser($UserObject)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "UPDATE `users` SET `Username`=$UserObject->Username, `Password`=$UserObject->Password, `JobtypeID`=$UserObject->JobtypeID WHERE UserID = $UserObject->ID";
        mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    function DeleteUser($ID)
    {
        $db = Database::getInstance();
        $connection = Database::GetConnection();
        $sql = "DELETE FROM `users` WHERE UserID = $ID";
        mysqli_query($connection, $sql);
    }

    if (isset($_REQUEST['UserID'])) {
        $UserObject = new User($_REQUEST['UserID']);
        $View = new UserView();
        $View->ShowUsersDetails($UserObject);

        if (isset($_POST['AddButton'])) {
            $Model = new User("");
            $Model->Username = $_POST['username'];
            $Model->Password = $_POST['password'];
            $Model->UsertypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['usertype']);
            AddUser($UserObject);
            echo "Added Successfully";
        }

        if (isset($_POST['UpdateButton'])) {
            if($_POST['username'])
            {$UserObject->Username = $_POST['username'];}
            if($_POST['password'])
            {$UserObject->Password = $_POST['password'];}
            $UserObject->UsertypeID = mysqli_real_escape_string(Database::GetConnection(), $_POST['usertype']);
            UpdateUser($UserObject);
            echo "Updated Successfully";
        }

        if (isset($_POST['DeleteButton'])) {
            DeleteUser($UserObject->ID);
            echo "Deleted Successfully";
        }
    }

?>