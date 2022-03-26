<?php

//namespace vendor\lib;

abstract class Product {
    protected string $table = 'product';
    protected string $category;
    private string $sku;
    private string $name;
    private float $price;

    public function getSKU(): string
    {
        return $this->sku;
    }
    public function setSKU($value){
        $this->sku = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName($value){
        $this->name = $value;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice($value){
        $this->price = $value;
    }

    protected function getCategory(): string
    {
        return $this->category;
    }

    public static function mysql()
    {
        if (isset($_ENV['CLEARDB_DATABASE_URL'])) {
            return new PDO($_ENV['CLEARDB_DATABASE_URL']);
        } else {

        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        $dbname = "myshop";
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    }

    public function getTableName(): string
    {
        return $this->table;
    }

    abstract protected function insert();
    abstract protected function select($row);
 //   abstract static public function loadAll():array;
    abstract public function renderHTML();




}