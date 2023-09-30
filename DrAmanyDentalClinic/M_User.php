<?php
    require_once 'Connection.php';
    require_once 'UserType.php';

    class User
    {
        public $ID;
        public $Username;
        public $Password;
        public $UsertypeID;
        public $UserType;
        
        function __construct($ID)
        {
            $db = Database::getInstance();
            if ($ID != "") 
            {
                $sql = "SELECT * FROM users WHERE $ID = UserID";
                $connection = Database::GetConnection();
                $UsersDataSet = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if($row = mysqli_fetch_array($UsersDataSet))
                {
                    $this->ID = $row['UserID'];
                    $this->Username = $row ['Username'];
                    $this->Password = $row ['Password'];
                    $this->UsertypeID = $row ['UsertypeID'];
                    $Temp = new UserType($this->UsertypeID);
                    $this->Usertype = $Temp->UserType;
                }
            }
            
        }

        public static function SelectAllUsers()
        {
            $db = Database::getInstance();
            $sql = "SELECT * FROM users ORDER BY Username";
            $connection = Database::GetConnection();
            $UsersDataSet = mysqli_query($connection, $sql) or die(mysqli_error($connection));
            $i = 0;
            while($row = mysqli_fetch_array($UsersDataSet))
            {
                $result[$i] = new User($row["UserID"]);
                $i++;
            }
            return $result;
        }
        
    }
?>