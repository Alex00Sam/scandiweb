<?php

//namespace vendor\lib;

abstract class Product {
    protected static string $table = 'product';
    protected string $sku;
    protected string $name;
    protected float $price;
    protected string $category;
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
        return self::$table;
    }

    protected function getFieldSet():string {
        return implode(",",array_keys(get_object_vars($this)));
    }

    protected function insert() {
            $conn = $this->mysql();
            // TODO: Implement insert() method.
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO {$this->getTableName()}(".$this->getFieldSet().") 
                    VALUES('".



                $this->getSKU()
                ."','".
                $this->getName()
                ."','".
                $this->getPrice()
                ."','".
                $this->getCategory()
                ."','".
                $this->getSpecifiedValue()
                ."')";
       // $conn->query($sql);
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        echo $sql;
    }
    abstract protected function select($row);
    abstract public function renderHTML();

    abstract public function getSpecifiedValue();



}