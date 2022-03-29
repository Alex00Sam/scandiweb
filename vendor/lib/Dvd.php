<?php

//namespace vendor\lib;

class Dvd extends Product
{
    protected float $size;
    protected string $category = 'Dvd';
    public function add($a)
    {
        $this->setSKU($a['sku']);
        $this->setName($a['name']);
        $this->setPrice($a['price']);
        $this->setSize($a['size']);
        $this->insert();
    }

    public function getSize(): float
    {
        return $this->size;
    }
    public function setSize($value){
        $this->size = $value;
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
                .'<br><p style="font-style: italic; text-align: center">'.
                    self::getSKU()
                .'</p><p style="font-weight: bold; text-align: center">'.
                    self::getName()
                .'</p><p style="font: italic ;text-align: center">'.
                    self::getPrice()
                .' $</p><br><p style="text-align: center">'.
                    self::getSize()
                 .' MB</p></div>';
    }


    public function getSpecifiedValue():float
    {
        return $this->getSize();
    }
}