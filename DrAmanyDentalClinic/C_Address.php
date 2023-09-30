<?php
    require_once 'M_Address.php';
    require_once 'V_Address.php';

    $AddressView = new AddressView();
    $AddressObject = new Address(1);
    $AddressView->ShowAddressDetails($AddressObject);

    if(isset($_REQUEST["AddressID"]))
    {
        $AddressObject = new Address($_REQUEST["AddressID"]);

        $AddressView->EditingAddressDetails($AddressObject);
    }
?>