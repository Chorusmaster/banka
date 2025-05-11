<?php
include_once dirname(__FILE__, 2) . '/classes/Database.php';

class Account extends Database
{
    private $connection;

    public function __construct() {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function getData() {
        $account_id = $_SESSION['account_id'];

        $sql = "SELECT * FROM accounts INNER JOIN cards USING(card_id) WHERE account_id=:account_id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':account_id', $account_id);

        $statement->execute();
        return $statement->fetchAll();
    }
}