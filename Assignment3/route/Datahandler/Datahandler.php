<?php
namespace Banking_App\Datahandler;

class Datahandler {
    private $customers = [];
    private $transactions = [];
    private $admins = [];

    public function registerCustomer($customer) {
        $this->customers[] = $customer;
    }

    public function getAllCustomers() {
        return $this->customers;
    }

    public function getCustomerByEmail($email) {
        foreach ($this->customers as $customer) {
            if ($customer->getEmail() === $email) {
                return $customer;
            }
        }
        return null;
    }


    public function addTransaction($transaction) {
    // Ensure that each transaction includes a 'type' field
    if (!isset($transaction['type'])) {
        $transaction['type'] = 'Unknown';
    }
    $this->transactions[] = $transaction;
}


    public function getAllTransactions() {
        return $this->transactions;
    }

    public function getTransactionsByUser($email) {
        $userTransactions = [];
        foreach ($this->transactions as $transaction) {
            if ($transaction['from'] === $email || $transaction['to'] === $email) {
                // Ensure that each transaction includes a 'type' field
                if (isset($transaction['type'])) {
                    $userTransactions[] = $transaction;
                } else {
                    // Provide a default 'type' value if it's missing
                    $transaction['type'] = 'Unknown';
                    $userTransactions[] = $transaction;
                }
            }
        }
        return $userTransactions;
    }

    public function registerAdmin($admin) {
        $this->admins[] = $admin;
    }
    
}
