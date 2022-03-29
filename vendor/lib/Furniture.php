<?php



class Furniture extends Product

{
    protected float $height;
    protected float $width;
    protected float $length;
    protected string $category = 'Furniture';


    public function add($a)
    {
        $this->setSKU($a['sku']);
        $this->setName($a['name']);
        $this->setPrice($a['price']);
        $this->setHeight($a['height']);
        $this->setWidth($a['width']);
        $this->setLength($a['length']);
        $this->insert();
    }

    public function getWidth():float
    {
        return $this->width;
    }
    public function getHeight():float
    {
        return $this->height;
    }
    public function getLength():float
    {
        return $this->length;
    }
    public function setLength($value){
        $this->length = $value;
    }
    public function setWidth($value){
        $this->width = $value;
    }
    public function setHeight($value){
        $this->height = $value;
    }

    protected function select($row)
    {
        if($row) {

            $this->setSKU($row["sku"]);
            $this->setName($row["name"]);
            $this->setPrice($row["price"]);
            $this->setHeight($row['height']);
            $this->setWidth($row['width']);
            $this->setLength($row['length']);
        }
    }

    public function RenderHTML()
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
            self::getHeight()
            .'x'.
            self::getWidth()
            .'x'.
            self::getLength()
            .'</p></div>';
    }

    public function getSpecifiedValue():string
    {
        return $this->getHeight()."','".$this->getWidth()."','".$this->getLength();
    }
}