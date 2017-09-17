<?php

class OrderManager {

    public static $_oCurrentPage;
    public static $_oMinPage;
    public static $_oMaxPage;
    public static $_oItems;
    public static $_oItemsPerPage;
    public static $_oFormError;

    public static function renderOrdersList() {

        //Then lets handle all the data from sql.
        self::$_oCurrentPage = @$_GET['oPage'];
        self::$_oItemsPerPage = 10;
        self::_fetchOrders();

        //And now we can render all of it.
        Page::_loadTemplate("order_table");

    }

    private static function _fetchOrders() {
        self::$_oMinPage = 1;
        self::$_oItems = array();

        try {

            //We get product count from database (This Query is performance killer, but db is small so it'll do)
            $stmt = Database::getConnection()->prepare("SELECT COUNT(*) AS 'count' FROM `orders` WHERE 
                                                                LOWER(`name`) LIKE LOWER(?) OR
                                                                LOWER(`surname`) LIKE LOWER(?) OR
                                                                LOWER(`email`) LIKE LOWER(?) OR
                                                                LOWER(`address`) LIKE LOWER(?) OR
                                                                LOWER(`phone`) LIKE LOWER(?) OR
                                                                LOWER(`additional`) LIKE LOWER(?)
                                                                LIMIT 1");
            $stmt->execute(array(
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%"
            ));
            $itemCount = $stmt->fetch()['count'];

            //Then we process the data.
            self::$_oMaxPage = ceil($itemCount / self::$_oItemsPerPage);
            if(!is_numeric(self::$_oCurrentPage) || self::$_oCurrentPage > self::$_oMaxPage) self::$_oCurrentPage = 1; //This should stop any SQL Injection or messing with get values issues.
            if(@$_GET['success']) self::$_oCurrentPage = self::$_oMaxPage;

            //Lets process order part
            $orderType = @$_GET['oOrType'];
            if(!isset($orderType)) $orderType = 0;
            $orderWhich = @$_GET['oOrWhich'];
            if(!isset($orderWhich)) $orderWhich = 0;

            $orderAsked = false;
            $orderTypeSQL;
            $orderWhichSQL;
            if($orderType > 0 && $orderType <= 2 && $orderWhich > 1 && $orderWhich <= 7) {

                $orderTypesSQL = array(
                    1 => "ASC",
                    2 => "DESC"
                );
                $orderCollumnsSQL= array(
                    2 => "name",
                    3 => "surname",
                    4 => "email",
                    5 => "phone",
                    6 => "address",
                    7 => "additional"
                );

                $orderTypeSQL = $orderTypesSQL[$orderType];
                $orderWhichSQL = $orderCollumnsSQL[$orderWhich];

                $orderAsked = true;
            }

            //Then we fetch data for the page that we need to show. (This Query is performance killer, but db is small so it'll do)
            $stmt = Database::getConnection()->prepare("SELECT * FROM `orders` WHERE 
                                                                LOWER(`name`) LIKE LOWER(?) OR
                                                                LOWER(`surname`) LIKE LOWER(?) OR
                                                                LOWER(`email`) LIKE LOWER(?) OR
                                                                LOWER(`address`) LIKE LOWER(?) OR
                                                                LOWER(`phone`) LIKE LOWER(?) OR
                                                                LOWER(`additional`) LIKE LOWER(?) "
                                                                //Because Those are hardcoded, we don't really need to use execute to protect agaisnt SQL Injection
                                                                 . ($orderAsked ? "ORDER BY `" . $orderWhichSQL . "` " . $orderTypeSQL . " " : "") . 
                                                                "LIMIT ?, ?");
            $stmt->execute(array(
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                "%" . @$_GET['oSearch'] . "%",
                (self::$_oCurrentPage - 1) * self::$_oItemsPerPage, 
                self::$_oItemsPerPage
            ));

            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push(self::$_oItems, new Order($row));
            }

        } 
        
        catch(PDOException $e) {
            echo 'Failed to fetch products list:</br>' . $e->getMessage();  
            //On more serious project maybe logging error in database would be cool.
        }

    }

    //Called from preprocessor
    public static function handleOrderForm() {

        if(@$_POST['orderSubmit']) {

            $name = @$_POST['orderName'];
            $surname = @$_POST['orderSurname'];
            $phone = @$_POST['orderPhone'];
            $email = @$_POST['orderMail'];
            $address = @$_POST['orderAddress'];
            $info = @$_POST['orderInfo'];

            if(empty($name) || empty($surname) || empty($phone) || empty($email))
                self::$_oFormError = '<center class="alert alert-danger">Vienas arba keli laukeliai buvo neužpildyti!</center></br>';

            else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                self::$_oFormError = '<center class="alert alert-danger">Toks El.Paštas neegzistuoja!</center></br>';

            else {

                $stmt = Database::getConnection()->prepare("INSERT INTO `orders`(`name`, `surname`, `email`, `phone`, `address`, `additional`) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($name, $surname, $email, $phone, $address, $info));
                
                header("Location: index.php?page=orders&success=1");

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