<?php
    require_once 'Connection.php';

     class UserType
     {
         public $ID;
         public $UserType;
         
         function __construct($ID)
         {
             $db = Database::getInstance();
             if ($ID != "") 
             {
                $sql = "SELECT * FROM usertype WHERE UserTypeID = $ID";
                $connection = Database::GetConnection();
                $UserTypeDataSet = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if($row = mysqli_fetch_array($UserTypeDataSet))
                {
                    $this->UserType = $row ['Usertype'];
                }
             }
             
         }
     }
?>