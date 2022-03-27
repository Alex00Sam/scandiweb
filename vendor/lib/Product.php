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
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $server = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);
            $conn = new mysqli($server,$username,$password,$db);
          //  $conn = new mysqli('eu-cdbr-west-02.cleardb.net', 'b797fb260f1a36', 'cbbe8e16', 'heroku_db734c534a6f902');
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

    }
        return $conn;
    }

    public function getTableName(): string
    {
        return $this->table;
    }

    abstract protected function insert();
    abstract protected function select($row);
    abstract public function renderHTML();




}