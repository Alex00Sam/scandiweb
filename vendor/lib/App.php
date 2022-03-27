<?php

//This Class is made to call some crucial methods from an abstract Product class. This is not the most efficient way to do this, however.
class App extends Product
{
    public function __construct()
    {
        $loaded = $this->loadAll();
        $this->renderAll($loaded);
    }

    public function loadAll(): array
    {
        $a=[];
        $conn = $this->mysql();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = 'SELECT * FROM '. $this->getTableName();
        $result = $conn->query($sql);
        if($result) {
            while ($row = $result->fetch_assoc()){
                $category =$row['category'];
                $obj = new $category(); //Makes a Book/DVD/Furniture object based on Category field value
                $obj->select($row);
                array_push($a,$obj); //loads all the  products from the database
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        return $a; //sends everything to RenderAll method
    }

    public function renderAll($array){
        foreach($array as $a) echo $a->renderHTML();
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
        if($_POST){
            $sku_array = implode("','",$_POST['checked']);
            $query = "DELETE FROM product WHERE sku IN ('".$sku_array."')";
            mysqli_query(App::mysql(), $query);
            var_dump($query);
        }
        header("Location: ./");
    }

    public static function add($array){
        $obj = new $array['productType']();  //Makes a Book/DVD/Furniture object based on Category field value
        $obj->add($array);
    }

    public static function isUnique($value){ //Checks whether the given SKU is not present in the database
        $conn = App::mysql();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = 'SELECT COUNT(sku) FROM '. App::getTableName().'WHERE sku='.$value;
        $result = $conn->query($sql);
        if($result==1) {
            mysqli_free_result($result);
            mysqli_close($conn);
            return "false";
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        return "true";
    }

}