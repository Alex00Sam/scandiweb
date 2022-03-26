<?php

//namespace vendor\lib;

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
                $obj = new $category();
                $obj->select($row);
                array_push($a,$obj);
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        return $a;
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
        $obj = new $array['productType']();
        $obj->add($array);
    }

}