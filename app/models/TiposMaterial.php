<?php

class TiposMaterial extends Database {

    public function findById($id) {
        $query = "SELECT * FROM tipo_material WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }

    public function findAll() {
        $query = "SELECT * FROM tipo_material ORDER BY nome ASC";
        $statement = $this->executeQuery($query);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }
}