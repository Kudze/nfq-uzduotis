<?php

class OrderManager {

    public static $_oCurrentPage;
    public static $_oMinPage;
    public static $_oMaxPage;
    public static $_oItems;
    public static $_oItemsPerPage;

    public static function renderOrdersList() {

       //First lets check if there was any form submitted from main.
       self::_handleOrderForm();

        //Then lets handle all the data from sql.
        self::$_oCurrentPage = @$_GET['oPage'];
        self::$_oItemsPerPage = 12;
        self::_fetchOrders();

        //And now we can render all of it.
        Page::_loadTemplate("order_table");

    }

    private static function _fetchOrders() {
        self::$_oMinPage = 1;
        self::$_oItems = array();

        try {

            //We get product count from database
            $stmt = Database::getConnection()->prepare("SELECT COUNT(*) AS 'count' FROM `orders` WHERE `name` LIKE ? LIMIT 1");
            $stmt->execute(array("%" . @$_GET['oSearch'] . "%"));
            $itemCount = $stmt->fetch()['count'];

            //Then we process the data.
            self::$_oMaxPage = ceil($itemCount / self::$_oItemsPerPage);
            if(!is_numeric(self::$_oCurrentPage) || self::$_oCurrentPage > self::$_oMaxPage) self::$_oCurrentPage = 1; //This should stop any SQL Injection or messing with get values issues.

            //Then we fetch data for the page that we need to show.
            $stmt = Database::getConnection()->prepare("SELECT * FROM `orders` WHERE `name` LIKE ? LIMIT ?, ?");
            $stmt->execute(array("%" . @$_GET['oSearch'] . "%", (self::$_oCurrentPage - 1) * self::$_oItemsPerPage, self::$_oItemsPerPage));

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push(self::$_oItems, new Order($row));
            }

        } 
        
        catch(PDOException $e) {
            echo 'Failed to fetch products list:</br>' . $e->getMessage();  
            //On more serious project maybe logging error in database would be cool.
        }

    }

    private static function _handleOrderForm() {

        if(@$_POST['orderSubmit']) {

            $name = @$_POST['orderName'];
            $surname = @$_POST['orderSurname'];
            $phone = @$_POST['orderPhone'];
            $email = @$_POST['orderMail'];
            $address = @$_POST['orderAddress'];
            $info = @$_POST['orderInfo'];

            if(empty($name) || empty($surname) || empty($phone) || empty($email))
                echo '<center class="alert alert-danger">Vienas arba keli laukeliai buvo neužpildyti!</center>';

            else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                echo '<center class="alert alert-danger">Toks El.Paštas neegzistuoja!</center>';

            else {

                $stmt = Database::getConnection()->prepare("INSERT INTO `orders`(`name`, `surname`, `email`, `phone`, `address`, `additional`) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($name, $surname, $email, $phone, $address, $info));
                
                echo '<center class="alert alert-success">Jūsų užsakymas buvo sėkmingai pridėtas prie sąrašo!</center>';

            }

        }

    }

}

class Order {
    
        private $id;
        private $name;
        private $surname;
        private $email;
        private $phone;
        private $address;
        private $info;
    
        function __construct($row) {

            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->surname = $row['surname'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->address = $row['address'];
            $this->info = $row['additional'];
    
        }
    
        public function getID() { return $this->id; }
        public function getName() { return $this->name; }
        public function getSurname() { return $this->surname; }
        public function getEmail() { return $this->email; }
        public function getPhone() { return $this->phone; }
        public function getAddress() { return $this->address; }
        public function getInfo() { return $this->info; }
    
    }