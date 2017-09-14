<?php

class ProductManager {

    public static function renderProductsList() {

        $products = self::_fetchProductsList();
        foreach($products as $product)
            $product->render();

    }

    private static function _fetchProductsList() {
        $res = array();

        try {
            $stmt = Database::getConnection()->prepare("SELECT * FROM `products`");
            $stmt->execute();

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                array_push($res, new Product($row));
        } 
        
        catch(PDOException $e) {
            echo 'Failed to fetch products list:</br>' . $e->getMessage();  
            //On more serious project maybe logging error in database would be cool.
        }

        return $res;
    }

    public static function renderOrdersList() {

    }

}

class Product {

    private $id;
    private $name;
    private $description;
    private $cost;

    function __construct($row) {

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->cost = $row['price'];

    }

    function render() {

        Page::_loadTemplate("product");
        _renderProduct($this);

    }

    public function getID() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getCost() { return $this->cost; }

}