<?php

class Salas extends Database {

    public function findById($id) {
        $query = "SELECT * FROM sala WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data[0];
        else return null;
        
    }

    public function findAll() {
        $query = "SELECT * FROM sala";
        $statement = $this->executeQuery($query);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function findAllByInstitutionId($inst_id) {
        $query = "SELECT * FROM sala WHERE id_instituicao = ?";
        $statement = $this->executeQuery($query, "i", [$inst_id]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public function add($numero, $inst_id) {
        if(!$this->isValid($numero, $inst_id) || !$this->isNumberAvailable($numero, $inst_id)) return null;

        $values = [$numero, $inst_id];
        $query = "INSERT INTO sala(numero, id_instituicao) VALUES (?,?)";
        $statement = $this->executeQuery($query, "si", $values);
        return $statement->insert_id;
    }

    public function delete($id) {
        $query = "DELETE FROM sala WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        return $statement;
    }

    private function isValid($numero, $inst_id) {
        if(empty($numero) || empty($inst_id) || !is_numeric($inst_id)) return false;
        return true;
    }

    private function isNumberAvailable($numero, $inst_id) {
        $salas = $this->findAllByInstitutionId($inst_id);
        # Returns true if it doesn't have salas
        if(!$salas) return true; 

        foreach($salas as $sala) {
            if($sala["numero"] == $numero) return false;
        }
        return true;
    }
}