<?php
require_once 'vendor/autoload.php';

use Banking_App\Admin\Admin;
use Banking_App\Datahandler\Datahandler;

$datahandler = new Datahandler();

$adminLoggedIn = false; // Track if Admin is logged in

while (true) {
    if (!$adminLoggedIn) {
        echo "Admin Registration\n";
        $name = readline("Enter your name: ");
        $email = readline("Enter your email: ");
        $password = readline("Enter your password: ");

        $admin = new Admin($name, $email, $password);
        $datahandler->registerAdmin($admin);

        echo "Admin registration successful. You can now log in as an Admin.\n";
        $adminLoggedIn = true;
    }

    echo "Admin Menu\n";
    echo "1. See all transactions by all users\n";
    echo "2. See transactions by a specific user (searching by their email)\n";
    echo "3. See the list of all customers\n";
    echo "4. LogOut\n";
    $adminChoice = readline("Enter your choice: ");

    switch ($adminChoice) {
        case 1:
            $transactions = $datahandler->getAllTransactions();
            if (empty($transactions)) {
                echo "No transactions found.\n";
            } else {
                echo "All transactions by all users:\n";
                foreach ($transactions as $transaction) {
                    $amount = isset($transaction['amount']) ? $transaction['amount'] : 'No Amount Found';
                    $timestamp = isset($transaction['timestamp']) ? $transaction['timestamp'] : 'No Timestamp Found';

                    $type = isset($transaction['type']) ? $transaction['type'] : 'Unknown';

                    echo "Type: {$type}, Amount: {$amount}, Timestamp: {$timestamp}\n";
                }
            }
            break;

        case 2:
            $email = readline("Enter the user's email to see their transactions: ");
            $transactions = $datahandler->getTransactionsByUser($email);
            if (empty($transactions)) {
                echo "No transactions found for {$email}.\n";
            } else {
                echo "All transactions for {$email}:\n";
                foreach ($transactions as $transaction) {
                    $amount = isset($transaction['amount']) ? $transaction['amount'] : 'No Amount Found';
                    $timestamp = isset($transaction['timestamp']) ? $transaction['timestamp'] : 'No Timestamp Found';

                    $type = isset($transaction['type']) ? $transaction['type'] : 'Unknown';

                    echo "Type: {$type}, Amount: {$amount}, Timestamp: {$timestamp}\n";
                }
            }
            break;

        case 3:
            $customers = $datahandler->getAllCustomers();
            if (empty($customers)) {
                echo "No customers found.\n";
            } else {
                echo "List of all customers:\n";
                foreach ($customers as $customer) {
                    echo "Name: {$customer['name']}, Email: {$customer['email']}\n";
                }
            }
            break;

        case 4:
            echo "Logging out.\n";
            exit;

        default:
            echo "Invalid choice. Please try again.\n";
    }
}
?>
