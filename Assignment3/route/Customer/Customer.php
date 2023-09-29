<?php
namespace Banking_App\Customer;

class Customer {
    private $name;
    private $email;
    private $password;
    private $balance;

    public function __construct($name, $email, $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->balance = 0;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function deposit($amount) {
        $this->balance += $amount;
    }

    public function withdraw($amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
        } else {
            echo "Insufficient balance.\n";
        }
    }

    public function transfer($recipient, $amount) {
        if ($this->balance >= $amount) {
            $this->balance -= $amount;
            $recipient->deposit($amount);
        } else {
            echo "Insufficient balance.\n";
        }
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword(){
        return $this->password;
    }
}
