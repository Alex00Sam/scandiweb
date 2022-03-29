<?php

//namespace vendor\lib;

class Book extends Product
{
    protected float $weight;
    protected string $category = 'Book';


    public function add($a)
    {
        $this->setSKU($a['sku']);
        $this->setName($a['name']);
        $this->setPrice($a['price']);
        $this->setWeight($a['weight']);
        $this->insert();
    }
    public function getWeight(): float
    {
        return $this->weight;
    }
    public function setWeight($value)
    {
        $this->weight = $value;
    }

    protected function select($row)
    {
        if ($row) {
            $this->setSKU($row["sku"]);
            $this->setName($row["name"]);
            $this->setPrice($row["price"]);
            $this->setWeight($row["weight"]);
        }
    }


    public function renderHTML() :string
    {
        return '<div class="card">
                    <input type="checkbox" class="delete-checkbox" name="checked[]" value="'.self::getSKU().'">'
            .'<p style="font-style: italic; text-align: center">'.
            self::getSKU()
            .'</p><p style="font-weight: bold; text-align: center">'.
            self::getName()
            .'</p><p style="font: italic ;text-align: center">'.
            self::getPrice()
            .' $</p><br><p style="text-align: center">'.
            self::getWeight()
            .' g</p></div>';
    }
    public function getSpecifiedValue():float
    {
        return $this->getWeight();
    }
}