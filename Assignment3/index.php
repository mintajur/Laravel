<?php
require_once 'vendor/autoload.php';

use Banking_App\Admin\Admin;
use Banking_App\Customer\Customer;
use Banking_App\Datahandler\Datahandler;
use Banking_App\Transaction\Transaction;

session_start();

$datahandler = new Datahandler();
$admin = new Admin();
$customer = null;

while (true) {
    echo "1. Login\n";
    echo "2. Register as a customer\n";
    echo "3. Exit\n";
    $choice = readline("Enter your choice: ");

    switch ($choice) {
        case 1:
            $email = readline("Enter your email: ");
            $password = readline("Enter your password: ");
            $customer = $datahandler->getCustomerByEmail($email);

            if ($customer && $customer->getPassword() === $password) {
                $_SESSION['user'] = $customer;

                while (true) {
                    echo "Customer Menu\n";
                    echo "1. See all transactions\n";
                    echo "2. Deposit money\n";
                    echo "3. Withdraw money\n";
                    echo "4. Transfer money\n";
                    echo "5. Check balance\n";
                    echo "6. Logout\n";                  
                     
                    $customerChoice = readline("Enter your choice: ");

                    switch ($customerChoice) {
                        case 1:
                            $transactions = $datahandler->getTransactionsByUser($customer->getEmail());
                            if (empty($transactions)) {
                                echo "No transactions found.\n";
                            } else {
                                echo "All transactions for {$customer->getEmail()}:\n";
                                foreach ($transactions as $transaction) {

                                    $amount = isset($transaction['amount']) ? $transaction['amount'] : 'No Amount Found';
                                    $timestamp = isset($transaction['timestamp']) ? $transaction['timestamp'] : 'No Timestamp Found';

                                    $type = isset($transaction['type']) ? $transaction['type'] : 'Unknown';

                                    echo "Type: {$type}, Amount: {$amount}, Timestamp: {$timestamp}\n";
                                }
                                
                            }
                            break;

                        case 2:
                            $amount = readline("Enter the amount to deposit: ");
                            $customer->deposit($amount);
                            $transaction = Transaction::createTransaction('Deposit', $customer->getEmail(), null, $amount);
                            $datahandler->addTransaction($transaction);
                            echo "Deposit successful.\n";
                            break;
    
                        case 3:
                            $amount = readline("Enter the amount to withdraw: ");
                            if ($customer->getBalance() >= $amount) {
                                $customer->withdraw($amount);
                                $transaction = Transaction::createTransaction('Withdraw', $customer->getEmail(), null, $amount);
                                $datahandler->addTransaction($transaction);
                                    echo "Withdrawal successful.\n";
                                } else {
                                    echo "Insufficient balance.\n";
                                }
                                break;    

                                case 4:
                                    $recipientEmail = readline("Enter recipient's email: ");
                                    $recipient = $datahandler->getCustomerByEmail($recipientEmail);
                                    if ($recipient) {
                                        $amount = readline("Enter the amount to transfer: ");
                                        if ($customer->getBalance() >= $amount) {
                                            $transaction = Transaction::createTransaction('Transfer', $customer->getEmail(), $recipient->getEmail(), $amount);
                                            $datahandler->addTransaction($transaction);
                                            $customer->transfer($recipient, $amount);
                                            echo "Transfer successful.\n";
                                        } else {
                                            echo "Insufficient balance.\n";
                                        }
                                    } else {
                                        echo "Recipient not found.\n";
                                    }
                                    break;

                        case 5:
                            echo "Current balance: {$customer->getBalance()}\n";
                            break;

                        case 6:
                            echo "Logging out.\n";
                            $customer = null;
                            break;

                        default:
                            echo "Invalid choice. Please try again.\n";
                    }

                    if ($customerChoice == 6) {
                        break;
                    }
                }
            } else {
                echo "Login failed. Invalid email or password.\n";
            }
            break;

        case 2:
            $name = readline("Enter your name: ");
            $email = readline("Enter your email: ");
            $password = readline("Enter your password: ");
            $newCustomer = new Customer($name, $email, $password);
            $datahandler->registerCustomer($newCustomer);
            echo "Registration successful. You can now log in.\n";
            break;

        case 3:
            echo "Exiting the Banking App. Goodbye!\n";

            session_destroy();
            exit;

        default:
            echo "Invalid choice. Please try again.\n";
    }
}
?>
