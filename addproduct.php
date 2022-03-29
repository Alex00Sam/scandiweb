<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>MyShop</title>
</head>
<body>

<script> //jQuery script that shows/hides fields and making them required
    $(document).ready(function () {
        $('#productType').on('change', function () {
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

<script>
    function isUnique(str) {
        if (str.length != 0) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    document.getElementById("txtHint").innerHTML = this.responseText;
                    if (this.responseText == "This SKU is NOT available!") {
                        document.getElementById("submit_btn").disabled = true;
                    } else {
                        document.getElementById("submit_btn").disabled = false;
                    }
                }
            };
            xmlhttp.open("GET", "isunique.php?q=" + str, true);
            xmlhttp.send();
        }

    }


</script>

<div id="header">
    <h1 style="padding-left: 20px">Add product</h1>
    <div style="margin-top: 20px">
        <button id="submit_btn" type="submit" form="product_form"
        ">Save</button>
        <a href="./">
            <button>Cancel</button>
        </a>
    </div>
</div>


<div class="container">
    <p style="margin: 0px"><span id="txtHint"></span>&nbsp</p>
    <form id="product_form" method="post"
    " action="save.php">
    <div class="row">
        <div class="col-25">
            <label for="sku">SKU</label>
        </div>
        <div class="col-75">
            <input type="text" id="sku" name="sku" placeholder="SKU" onkeyup="isUnique(this.value)" required>

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
                <option disabled value="" selected>--Choose a type--</option>
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
                       placeholder="Enter Furniture Height">

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
