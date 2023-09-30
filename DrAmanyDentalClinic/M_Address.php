<?php
    require_once 'Connection.php';
    class Address
    {
        public $ID;
        public $Address;
        public $ParentID;

        function __construct($ID)
        {
            if($ID != "")
            {
                $db = Database::getInstance();
                $sql = "SELECT * FROM `address` WHERE $ID = AddressID";
                $connection = Database::GetConnection();
                $AddressDataset = mysqli_query($connection, $sql) or die(mysqli_error());
                if($row = mysqli_fetch_array($AddressDataset))
                {
                    $Temp = "";
                    $this->Address = Address::FillAddress($ID, $Temp);
                    $this->ParentID = $row['ParentID'];
                }
            }
        }

        public static function FillAddress($ID, &$Temp)
        {
            $connection = Database::GetConnection();
            $sql = "SELECT * FROM `address` WHERE $ID = AddressID";
            $AddressDataset = mysqli_query($connection, $sql) or die(mysqli_error());
            if ($row = mysqli_fetch_array($AddressDataset)) {
                $Temp .= $row['Address']." ";
                if ($row['ParentID'] == 0) {
                    return $Temp;
                }
                else {
                    return Address::FillAddress($row['ParentID'], $Temp);
                }
            }
        }

        public static function SelectAllAddresses()
        {
            $sql = "SELECT * FROM address ORDER BY Address";
            $connection = Database::GetConnection();
            $AddressDataset = mysqli_query($connection, $sql) or die(mysql_error());
            $i = 0;
            $result;
            while($row = mysqli_fetch_array($AddressDataset))
            {
                $result[$i] = new Address($row['AddressID']);
                $i++;
            }
            return $result;
        }
    }
?>