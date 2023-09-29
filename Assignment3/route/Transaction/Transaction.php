<?php
namespace Banking_App\Transaction;

class Transaction {
    public static function createTransaction($type, $from, $to, $amount) {
        return [
            'type' => $type,
            'from' => $from,
            'to' => $to,
            'amount' => $amount,
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}

?>

