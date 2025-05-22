<?php
include_once dirname(__FILE__, 2) . '/classes/Database.php';

class Messages extends Database
{
    private $connection;

    public function __construct() {
        $this->connect();
        $this->connection = $this->getConnection();

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addMessage($text, $receiver_id=null) {
        if ($receiver_id == null) {
            $receiver_id = $this->getAdmin()["account_id"];
        } else if ($_SESSION['account_id'] != $this->getAdmin()["account_id"]) {
            exit("Nie ste administrátor");
        }

        $user_id = $_SESSION['account_id'];
        $sql = "INSERT INTO messages (message_id, time, text, sender_id, receiver_id) VALUES (NULL, NOW(), ?, ?, ?)";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $text);
        $statement->bindParam(2, $user_id);
        $statement->bindParam(3, $receiver_id);

        $statement->execute();
    }

    public function getAdmin() {
        $sql = "SELECT account_id FROM accounts WHERE isAdmin=1 LIMIT 1";
        $statement = $this->connection->prepare($sql);

        $statement->execute();

        return $statement->fetch();
    }

    public function getMessages() {
        $id = $_SESSION['account_id'];
        $sql = "SELECT * FROM messages WHERE receiver_id=? OR sender_id=?";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $id);
        $statement->bindParam(2, $id);

        $statement->execute();
        return $statement->fetchAll();
    }

    public function validateOwner($id) {
        $sql = "SELECT sender_id FROM messages WHERE message_id=?";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $id);

        $statement->execute();
        return $statement->fetch();
    }

    public function deleteMessage($id) {
        if ($_SESSION['account_id'] == $this->validateOwner($id)["sender_id"]) {
            $sql = "DELETE FROM messages WHERE message_id=?";
            $statement = $this->connection->prepare($sql);

            $statement->bindParam(1, $id);

            $statement->execute();
        }
    }

    public function getMessage($id) {
        if ($_SESSION['account_id'] == $this->validateOwner($id)["sender_id"]) {
            $sql = "SELECT text FROM messages WHERE message_id=?";
            $statement = $this->connection->prepare($sql);

            $statement->bindParam(1, $id);

            $statement->execute();
            return $statement->fetch()["text"];
        }
        else return "Ospravedlňujem sa, vyskytla sa chyba";
    }

    public function updateMessage($id, $text) {
        if ($_SESSION['account_id'] == $this->validateOwner($id)["sender_id"]) {
            $sql = "UPDATE messages SET text=? WHERE message_id=?";
            $statement = $this->connection->prepare($sql);

            $statement->bindParam(1, $text);
            $statement->bindParam(2, $id);

            $statement->execute();
        }
    }

    public function getUserName($id) {
        $sql = "SELECT CONCAT(first_name, ' ', last_name) AS name FROM accounts WHERE account_id=?";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(1, $id);

        $statement->execute();
        return $statement->fetch()["name"];
    }
}