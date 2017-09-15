<?php

class ProductManager {

    public static function renderProductsList() {

        $currPage = @$_GET["pPage"]; 
        $maxPage;
        $search = @$_GET["pSearch"];
        $products = self::_fetchProductsList(12, $currPage, $maxPage, $search); //12 is good because it does divide with 1, 2, 3, 4 and 6.

        Page::_loadTemplate("product");
        _renderProductsTop(1, $currPage, $maxPage, $search);

        foreach($products as $product)
            $product->render();

    }

    private static function _fetchProductsList($itemsPerPage, &$currPage, &$maxPage, $search) {
        $res = array();

        try {
            
            $realSearch = "%" . $search . "%";

            //We get product count from database
            $stmt = Database::getConnection()->prepare("SELECT COUNT(*) AS 'count' FROM `products` WHERE `name` LIKE :search LIMIT 1");
            $stmt->bindParam(":search", $realSearch); //Afaik this does protect me against sql injection.
            $stmt->execute();
            $itemCount = $stmt->fetch()['count'];

            //Then we process the data.
            $maxPage = ceil($itemCount / $itemsPerPage);
            if(!is_numeric($currPage) || $currPage > $maxPage) $currPage = 1; //This should stop any SQL Injection or messing with get values issues.

            //Then we fetch data for the page that we need to show.
            $stmt = Database::getConnection()->prepare("SELECT * FROM `products` WHERE `name` LIKE :search LIMIT :offset, :count");
            $stmt->bindParam(":search", $realSearch); //Afaik this does protect me against sql injection.
            $stmt->bindValue(":offset", ($currPage - 1) * $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(":count", $itemsPerPage, PDO::PARAM_INT);
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

        _renderProduct($this);

    }

    public function getID() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDescription() { return $this->description; }
    public function getCost() { return $this->cost; }

}