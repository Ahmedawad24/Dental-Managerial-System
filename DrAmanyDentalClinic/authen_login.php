<?php  
 require_once 'Connection.php';

    if (isset($_POST['user_id']) and isset($_POST['user_pass']))
    {
        
        // Assigning POST values to variables.
        $Username = $_POST['user_id'];
        $Password = $_POST['user_pass'];

        // CHECK FOR THE RECORD FROM TABLE
        $sql = "SELECT * FROM `users` WHERE Username='$Username' and Password='$Password'";
        $connection = Database::GetConnection();
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $count = mysqli_num_rows($result);

        if($count == 1)
        {
            header("Location: Dashboard.php"); 
            exit;
        }
        else
        {
            header("Refresh:0; url=login.php");
        }
    }
?>