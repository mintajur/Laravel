<?php
namespace Banking_App\Admin;

class Admin {
    public function viewAllTransactions($datahandler) {
        return $datahandler->getAllTransactions();
    }

    public function viewTransactionsByUser($datahandler, $email) {
        return $datahandler->getTransactionsByUser($email);
    }

    public function viewAllCustomers($datahandler) {
        return $datahandler->getAllCustomers();
    }
}
