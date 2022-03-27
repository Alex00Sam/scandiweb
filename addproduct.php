<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            margin-left: 30px;
            background-color: #faf0e6;
            font-family: "Segoe UI";
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

        .card {
            height: 300px;
            width: 20%;
            border: 2px solid red;
            border-radius: 5px;
            margin: 20px 20px 20px 20px;
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

        input[type=text], input[type=number], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #fcced5;
            padding: 20px;
            width: 50%
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 70%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>MyShop</title>
</head>
<body>

<script> //jQuery script that shows/hides fields and making them required
    $(document).ready(function(){
        $('#productType').on('change', function() {
            $("#size").prop('required', false);
            $("#weight").prop('required', false);
            $("#height").prop('required', false);
            $("#width").prop('required', false);
            $("#length").prop('required', false);
            $("#size").hide();
            $("#weight").hide();
            $("#hwl").hide();
            switch (this.value) {
                case "Dvd":
                    $("#size").show();
                    $("#size").prop('required', true);

                    break;
                case "Book":
                    $("#weight").show();
                    $("#weight").prop('required', true);
                    break;
                case "Furniture":
                    $("#hwl").show();
                    $("#height").prop('required', true);
                    $("#width").prop('required', true);
                    $("#length").prop('required', true);
            }
        });
    });
</script>
<!--
<script> //an attempt to check the SKU field uniqueness. But, I'm not quite experienced in ajax queries, so it doesn't work
    function isUnique(){
    let sku = $("#sku").value;
    $.ajax({
        type: "POST",
        url: 'isunique.php',
        dataType: 'html',
        data: {sku},
        success: function(result){
                    if(result=="false")
                        alert('This SKU is already taken.');

                }
    }
    });
    }
</script> -->

<div id="header">
    <h1>Add product</h1>
    <div style="margin-top: 20px">
        <button type="submit" form="product_form" onsubmit="isUnique()">Save</button>
        <a href="./">
            <button>Cancel</button>
        </a>
    </div>
</div>


<div class="container">
    <form id="product_form" method="post" onsubmit="return validate()" action="save.php">
        <div class="row">
            <div class="col-25">
                <label for="sku">SKU</label>
            </div>
            <div class="col-75">
                <input type="text" id="sku" name="sku" placeholder="SKU" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="name">Name</label>
            </div>
            <div class="col-75">
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="price">Price ($)</label>
            </div>
            <div class="col-75">
                <input type="number" step="0.01" id="price" name="price" placeholder="Price ($)" required>
            </div>

        </div>
        <div class="row">
            <div class="col-25">
                <label for="productType">Choose a type:</label>
            </div>
            <div class="col-75">
                <select required name="productType" id="productType">
                    <option disabled value ="" selected>--Choose a type--</option>
                    <option value="Dvd">DVD</option>
                    <option value="Book">Book</option>
                    <option value="Furniture">Furniture</option>
                </select>
            </div>
            <div>

            </div>
            <div class="col-75">
                <input id="size" type="text" name="size" class="form-control"
                       placeholder="Enter DVD Size" data-sel-type="Dvd" hidden>

                <input id="weight" type="text" name="weight" class="form-control"
                       placeholder="Enter Book Weight" data-sel-type="Book" hidden>

                <div id="hwl" data-sel-type="Furniture" hidden>
                    <input style="margin:10px;" id="height" type="text" name="height" class="form-control"
                           placeholder="Enter Furniture Height" >

                    <input style="margin:10px;" id="width" type="text" name="width" class="form-control"
                           placeholder="Enter Furniture Width">

                    <input style="margin:10px;" id="length" type="text" name="length" class="form-control"
                           placeholder="Enter Furniture Length">
                </div>
            </div>

    </form>
</div>


</body>
</html>
