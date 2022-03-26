<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin-left: 30px;
            background-color: #faf0e6;
            font-family: "Segoe UI";
        }
        input[type=checkbox]
        {
            /* Double-sized Checkboxes */
            -ms-transform: scale(2); /* IE */
            -moz-transform: scale(2); /* FF */
            -webkit-transform: scale(2); /* Safari and Chrome */
            -o-transform: scale(2); /* Opera */
            transform: scale(2);
            margin: 20px;
        }

        #header {
            margin-bottom: 20px;
            color: black;
            text-align: left;
            border-bottom: black solid 3px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            background-color: lightpink;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;

        }

        p {
            font-size: 20px;
        }

        .card{
            height: 300px;
            width: 20%;
            border: 5px solid #ffb0b0;
            border-radius: 8px;
            margin: 20px 20px 20px 20px;
            background-color: #fcced5;
        }

        button {
            border: 5px solid #fd9f9f;
            border-radius: 8px;
            margin: 20px 20px 20px 20px;
            background-color: #fcced5;
            cursor: pointer;
            padding: 10px 50px;
            font-size: larger;
            font-weight: bold;
            font-family: "Segoe UI";
        }
        button:hover {
            transform:scale(1.1);
            -webkit-transform:scale(1.1);
            -moz-transform:scale(1.1);
        }

        #inline {
            width: 100%;
            display: flex;
        }


    </style>
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
            $book = new App();
        ?>
    </div>
</form>
</body>
</html>
