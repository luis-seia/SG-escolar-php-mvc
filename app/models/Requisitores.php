<?php

class Requisitores extends Database {

    public function findById($id) {
        $query = "SELECT * FROM requisitor WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM requisitor WHERE email = ?";
        $statement = $this->executeQuery($query, "s", [$email]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }

    public function add($name, $email, $password) {
        if(!$this->isValid($name, $email, $password) || $this->findByEmail($email)) return null;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $values = [$name, $email, $hashed_password];
        $query = "INSERT INTO requisitor(nome, email, password) VALUES (?,?,?)";
        $statement = $this->executeQuery($query, "sss", $values);
        return $statement->insert_id;
    }

    private function isValid($name, $email, $password) {
        if(empty($name) || empty($email) || empty($password)) {
            return false;
        }
        if(is_numeric($name) || is_numeric($email)) {
            return false;
        }
        return true;
    }
}