<!DOCTYPE html>
    <head>
        <title></title>
    </head>
    <body>
        <h1 style="text-align: center;">********INVOICE********</h1>
        <h3 style="text-align: center;">Khaled Hossameldin</h3>
        <br>
        <div style="text-align: center;">
            <?php
                $decorator = $_SESSION['Invoice'];
                echo $decorator->ShowDetails();
            ?>
        </div>
        <h1></h1>
    </body>
</html>