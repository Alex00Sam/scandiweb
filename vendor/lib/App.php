<?php

//This Class is made to call some crucial methods from an abstract Product class. This is not the most efficient way to do this, however.
class App extends Product
{
    public function __construct()
    {

    }

    public function loadAll(): void
    {
        $a = [];
        $conn = $this->mysql();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = 'SELECT * FROM ' . $this->getTableName();
        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $category = $row['category'];
                $obj = new $category(); //Makes a Book/DVD/Furniture object based on Category field value
                $obj->select($row);
                array_push($a, $obj); //loads all the  products from the database
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        $this->renderAll($a);
        //sends everything to RenderAll method
    }

    public function renderAll($array)
    {
        foreach ($array as $a) echo $a->renderHTML();
    }

    protected function insert()
    {
        // TODO: Implement insert() method.
    }

    protected function select($row)
    {
        // TODO: Implement select() method.
    }

    public function renderHTML()
    {
        // TODO: Implement renderHTML() method.
    }

    public static function delete()
    {
        if ($_POST) {
            $sku_array = implode("','", $_POST['checked']);
            $query = "DELETE FROM " . (new App)->getTableName() . " WHERE sku IN ('" . $sku_array . "')";
            mysqli_query(App::mysql(), $query);
            var_dump($query);
        }
        header("Location: ./");
    }

    public static function add($array)
    {
        $obj = new $array['productType']();  //Makes a Book/DVD/Furniture object based on Category field value
        $obj->add($array);
    }

    public static function isUnique($value): string
    { //Checks whether the given SKU is present in the database
        $conn = App::mysql();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT COUNT(sku) as total FROM " . (new App())->getTableName() . " WHERE sku=" . $value;
        $result = $conn->query($sql);
        $data = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        if ($data['total'] == 1) {
            return "This SKU is NOT available!";
        }
        return "This SKU is available!";
    }

}