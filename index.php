<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>MyShop</title>
</head>

<body>


<div id="header">
    <h1 style="padding-left: 20px">Product list</h1>
    <div style="margin-top: 20px; margin-right: 20px">
        <a style="text-decoration:none" href="addproduct">
            <button>ADD</button>
        </a>
        <button form="form" type="submit" id="delete-product-btn">MASS DELETE</button>
    </div>
</div>
<form method="post" action="delete.php" id="form">
    <div id="inline">
        <?php
            require 'autoload.php';
            $app = new App();
            $app->loadAll();
            $dvd = new Dvd();
            $dvd->add(['sku'=>'1234AB','name','cartoon','price'=>'10','size'=>'200']);
        ?>
    </div>

</form>
</body>
</html>
