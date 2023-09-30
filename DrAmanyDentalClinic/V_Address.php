<?php
    require_once 'M_Address.php';

    class AddressView
    {
        public function ShowAllAddresses()
        {
            $result = Address::SelectAllAddresses();
            for($i=0;$i<count($result);$i++)
            {
                echo ("<a href = C_Address.php?id=".$result[$i]->ID.">".$result[$i]->Address."</a><br>");
            }
        }

        public function ShowAddressDetails($AddressObject)
        {
            echo "<table border=2><tr><td>ID</td><td>".$AddressObject->ID."</td></tr>";
            echo "<tr><td>Address</td><td>".$AddressObject->Address."</td></tr>";
            echo "<tr><td>ParentID</td><td>".$AddressObject->ParentID."</td></tr>";
            echo "</table>";
        }

        public function EditingAddressDetails($AddressObject)
        {
            echo "<table border=2><tr><td>ID</td><td>".$AddressObject->ID."</td></tr>";
            $var = $AddressObject->Address;
            echo "<tr><td>Address</td><td>".'<input type="text" name="name" value="'.$var.'">'."</td></tr>";
            echo "<tr><td>ParentID</td><td>".$AddressObject->ParentID."</td></tr>";
        }
    }
?>