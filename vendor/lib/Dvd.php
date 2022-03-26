<?php

//namespace vendor\lib;

class Dvd extends Product
{
    private float $size;
    protected string $category = 'dvd';
    public function add($a)
    {
        $this->setSKU($a['sku']);
        $this->setName($a['name']);
        $this->setPrice($a['price']);
        $this->setSize($a['size']);
        $this->insert();
    }


    public function getSize(): int
    {
        return $this->size;
    }
    public function setSize($value){
        $this->size = $value;
    }



    protected function insert() {
        $conn = $this->mysql();
        // TODO: Implement insert() method.
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO ".
            self::getTableName()
            ."(sku, name,price,size,category) VALUES('".
            self::getSKU()
            ."','".
            self::getName()
            ."','".
            self::getPrice()
            ."','".
            self::getSize()
            ."','".
            self::getCategory()
            ."')";

        $conn->query($sql) === TRUE;
        $conn->close();
    }
    protected function select($row)
    {
        if($row) {

            $this->setSKU($row["sku"]);
            $this->setName($row["name"]);
            $this->setPrice($row["price"]);
            $this->setSize($row["size"]);
        }

    }




    public function renderHTML(): string
    {
        return '<div class="card">
                    <input type="checkbox" class="delete-checkbox" name="checked[]" value="'.self::getSKU().'">'
                .'<br><p style="font-weight: bold; text-align: center">'.
                    self::getName()
                .'</p><br><p style="font: italic ;text-align: center">'.
                self::getPrice()
             .' $</p><br><p style="text-align: center">'.
                    self::getSize()
                 .' MB</p></div>';
    }



}