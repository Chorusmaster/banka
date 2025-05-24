<?php
include_once dirname(__FILE__, 2) . '/classes/Database.php';

class Operations extends Database
{
    private $connection;

    public function __construct() {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function getData($card_number=null) {

        if(!$card_number) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $account_id = $_SESSION['account_id'];
            $sql = "SELECT * FROM accounts INNER JOIN cards USING(card_id) WHERE account_id=?";
        } else {
            $sql = "SELECT * FROM cards WHERE card_number=?";
        }

        $statement = $this->connection->prepare($sql);

        $param = (!$card_number) ? $account_id : $card_number;
        $statement->bindParam(1, $param);

        $statement->execute();
        return $statement->fetch();
    }

    public function changeAmount($amount, $number = null) {
        $data = $this->getData($number);
        if(!$data) {
            $_SESSION["error"] = "Nesprávne číslo karty";
            throw new Exception("Nesprávne číslo karty");
        }

        $current_amount = $data["balance"];
        if ($current_amount + $amount >= 0) $new_amount = $current_amount + $amount;
        else {
            $_SESSION["error"] = "Nemáte dostatočnú sumu na účte";
            throw new Exception("Nemáte dostatočnú sumu na účte");
        }

        if ($number == null) $number = $data["card_number"];

        $sql = "UPDATE cards SET balance=:new_amount WHERE card_number=:card_number";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':card_number', $number);
        $statement->bindParam(':new_amount', $new_amount);

        $statement->execute();

        return $data["card_id"];
    }

    public function transfer($amount, $receiver) {
        try {
            $this->connection->beginTransaction();

            $sender_id = $this->changeAmount(-$amount);
            $reciever_id = $this->changeAmount($amount, $receiver);
            $this->addNotation($amount, $sender_id, $reciever_id);

            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollBack();
        } finally {
            $this->disconnect();
        }
    }

    public function addNotation($amount, $sender_id, $reciever_id, $type=null) {
        if ($type == null) {$type = "transaction";}
        else {$reciever_id = null;}

        $sql = "INSERT INTO transactions (transaction_id, amount, type, sender_card, reciever_card, date) VALUES (NULL, ?, ?, ?, ?, NOW())";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $amount);
        $statement->bindParam(2, $type);
        $statement->bindParam(3, $sender_id);
        $statement->bindParam(4, $reciever_id);

        $statement->execute();
    }

    public function getHistory() {
        $card_id = $this->getData()["card_id"];

        $sql = "SELECT t.amount AS amount, t.date AS date, t.type AS type, 
                s.card_number AS sender, r.card_number AS reciever,
                ra.first_name AS reciever_first_name, ra.last_name AS reciever_last_name,
                sa.first_name AS sender_first_name, sa.last_name AS sender_last_name
                FROM transactions t 
                LEFT OUTER JOIN cards r ON t.reciever_card = r.card_id 
                INNER JOIN cards s ON t.sender_card = s.card_id 
                LEFT OUTER JOIN accounts ra ON t.reciever_card = ra.card_id
                INNER JOIN accounts sa ON t.sender_card = sa.card_id
                WHERE r.card_id = ? OR s.card_id = ?
                ORDER BY date";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $card_id);
        $statement->bindParam(2, $card_id);

        $statement->execute();
        $result = $statement->fetchAll();

        $this->disconnect();
        return $result;
    }
}