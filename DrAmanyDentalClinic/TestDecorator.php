<?php

    require_once 'Invoice.php';

    echo "<h1>*************INVOICE*************</h1><br>";
    $invoice = new BaseInvoice("<h3>Khaled Hossameldin</h3><br><br><br>", 100);
    $decorator = new InvoiceDecorator($invoice);
    $SyringeDecorator = new Syringe($decorator);
    $CottonDecorator = new Cotton($decorator);
    //echo $decorator->showDetails();
    $SyringeDecorator->AddSyringe();
    //echo $decorator->showDetails();
    $CottonDecorator->AddCotton();
    $SyringeDecorator->AddSyringeI();
    echo $decorator->showDetails();
    echo "Total Money: " . $decorator->showMoney();
    echo "<br>";
    $decorator->resetDetailsMoney();
    echo "<h1>***********************************</h1>"

?>