<?php

class Materiais extends Database {

    public function findById($id) {
        $query = "SELECT * FROM material WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data[0];
        else return null;
    }

    public function findByReference($reference) {
        $query = "SELECT * FROM material WHERE referencia = ?";
        $statement = $this->executeQuery($query, "s", [$reference]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data[0];
        else return null;
    }

    public function findAll() {
        $query = "SELECT * FROM material";
        $statement = $this->executeQuery($query);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function findAllByInstitutionId($id_institution) {
        $query = "SELECT * FROM material WHERE id_instituicao = ?";
        $statement = $this->executeQuery($query, "i", [$id_institution]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function add($reference, $name, $id_type, $id_institution) {
        if($this->findByReference($reference)) return null;
        if(!$this->isValid($reference, $name)) return null;

        $values = [$reference, $name, $id_type, $id_institution];
        $query = "INSERT INTO material(referencia, nome, id_tipo, id_instituicao) VALUES (?,?,?,?)";
        $statement = $this->executeQuery($query, "ssii", $values);
        return $statement->insert_id;
    }

    public function delete($id) {
        $query = "DELETE FROM material WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        return $statement;
    }

    public function update($id, $reference, $name) {
        $material = $this->findById($id);
        if(!$material) return null;
        if(!$this->isValid($reference, $name)) return null;
        if($this->findByReference($reference) && $material["referencia"] != $reference) return null;

        $query = "UPDATE material SET referencia = ? , nome = ? WHERE id = ?";
        $values = [$reference, $name, $id];
        $statement = $this->executeQuery($query, "ssi", $values);
        return $statement;
    }

    private function isValid($reference, $name) {
        if(empty($name) || empty($reference)) {
            return false;
        }
        if(is_numeric($name)) {
            return false;
        }
        return true;
    }
}