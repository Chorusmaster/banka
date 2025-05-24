<?php
include_once dirname(__FILE__, 2) . '/classes/Database.php';

class Registration extends Database
{
    private $connection;

    public function __construct() {
        $this->connect();
        $this->connection = $this->getConnection();
    }

    public function register($reg_data) {
        $db_data = $this->getData($reg_data[0], $reg_data[1], false);
        try {
            if ($db_data != null) {
                throw new InvalidArgumentException("Používateľ už existuje");
            } else {
                $reg_data[2] = password_hash($reg_data[2], PASSWORD_BCRYPT);
                $code = rand(100, 999);
                $card_number = ($this->getLastCardNumber())["card_number"] + 1;

                try {
                    $this->connection->beginTransaction();

                    $sql = "INSERT INTO cards (card_id, card_number, expiration_date, code, balance) VALUES(NULL, ?, DATE_ADD(CURDATE(), INTERVAL 5 YEAR), ?, 0);";
                    $statement = $this->connection->prepare($sql);

                    $statement->bindParam(1, $card_number);
                    $statement->bindParam(2, $code);

                    $statement->execute();

                    $card_id = $this->connection->lastInsertId();

                    $sql = "INSERT INTO accounts (account_id, email, login, password, first_name, last_name, birth_date, isAdmin, card_id) values (NULL, ?, ?, ?, ?, ?, ?, 0, ?)";
                    $statement = $this->connection->prepare($sql);

                    for ($i = 1; $i <= count($reg_data); $i++) {
                        $statement->bindParam($i, $reg_data[$i - 1]);
                    }
                    $statement->bindParam($i, $card_id);

                    $statement->execute();

                    $user_id = $this->connection->lastInsertId();
                    $this->add_session($user_id);

                    $this->connection->commit();
                } catch (Exception $e) {
                    $this->connection->rollBack();
                }
            }
        } catch (PDOException $e) {
            echo "Vyskytla sa chyba pri práci z databázou: " . $e->getMessage();
        } finally {
            $this->disconnect();
        }
    }

    public function login($log_data) {
        $db_data = $this->getData($log_data[0], $log_data[1], true);
        try {
            if ($db_data == null) {
                throw new InvalidArgumentException("Takýto používateľ neexistuje");
            } else {
                if(!password_verify($log_data[2], $db_data["password"])) {
                    throw new InvalidArgumentException("Nesprávne heslo");
                }
            }

            $this->add_session($db_data["account_id"]);

        } catch (PDOException $e) {
            echo "Vyskytla sa chyba pri práci z databázou: " . $e->getMessage();
        } finally {
            $this->disconnect();
        }
    }

    private function getData($email, $login, $isStrict) {
        $sql = "SELECT * FROM accounts WHERE login=:login " . ($isStrict ? "AND" : "OR") . " email=:email";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':login', $login);
        $statement->bindParam(':email', $email);

        $statement->execute();
        return $statement->fetch();
    }

    private function getLastCardNumber() {
        $sql = "SELECT card_number FROM cards ORDER BY card_number DESC LIMIT 1";
        $statement = $this->connection->prepare($sql);

        $statement->execute();
        return $statement->fetch();
    }

    private function add_session($id) {
        session_start();
        $_SESSION['account_id'] = $id;
        $_SESSION['login'] = $_POST['login'];
    }
}