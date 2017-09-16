<?php

class OrderManager {

    public static function renderOrdersList() {

        //First lets check if there was any form submitted from main.
        $error = self::_handleOrderForm();

        echo $error;

    }

    private static function _handleOrderForm() {

        if(@$_POST['orderSubmit']) {

            $name = @$_POST['orderName'];
            $surname = @$_POST['orderSurname'];
            $phone = @$_POST['orderPhone'];
            $email = @$_POST['orderMail'];

            if(empty($name) || empty($surname) || empty($phone) || empty($email))
                return '<center class="alert alert-danger">Vienas arba keli laukeliai buvo neužpildyti!</center>';

            else {

                $stmt = Database::getConnection()->prepare("INSERT INTO `orders`(`name`, `surname`, `email`, `phone`) VALUES (?, ?, ?, ?)");
                $stmt->execute(array($name, $surname, $email, $phone));
                
                return '<center class="alert alert-success">Jūsų užsakymas buvo sėkmingai pridėtas prie sąrašo!</center>';

            }

        }

        return "";

    }

}