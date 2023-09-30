<?php

    require_once 'Strategy.php';

    // $book = new Book('Object Oriented Software Engineering', 'Khaled Hossameldin');

    // $strategyContextC = new StrategyContext('C');
    // $strategyContextE = new StrategyExclaim('E');
    // $strategyContextS = new StrategyStars('S');

    // echo $strategyContextC->showBookTitle($book);
    // echo "<br>";
    // echo $strategyContextE->showTitle($book);
    // echo "<br>";
    // echo $strategyContextS->showTitle($book);
    // echo "<br>";

    $Method = new Method("");

    $cash = new CashMethod("Cash");
    $Credit = new CreditCardMethod("Credit Card");

    echo $cash->showMethod($Method) . "<br>";
    echo $Credit->showMethod($Method);

?>