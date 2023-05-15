<?php

class Filiacoes extends Database {

    public function findByInstitutionIdAndRequisitorId($id_instituicao, $id_requisitor) {
        $query = "SELECT * FROM filiacao WHERE id_instituicao = ? AND id_requisitor = ?";
        $values = [$id_instituicao, $id_requisitor];
        $statement = $this->executeQuery($query, "ii", $values);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data[0];
        else return null;
    }

    public function findAllByRequisitorId($id_requisitor) {
        $query = "SELECT * from filiacao WHERE id_requisitor = ?";
        $statement = $this->executeQuery($query, "i", [$id_requisitor]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function findAllByInstitutionId($id_instituicao) {
        $query = "SELECT * from filiacao WHERE id_instituicao = ?";
        $statement = $this->executeQuery($query, "i", [$id_instituicao]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function add($id_instituicao, $id_requisitor) {
        if(!$this->isValid($id_instituicao, $id_requisitor)) return null;
        if($this->findByInstitutionIdAndRequisitorId($id_instituicao, $id_requisitor)) return null;

        $values = [$id_instituicao, $id_requisitor];
        $query = "INSERT INTO filiacao VALUES (?,?, NOW())";
        $statement = $this->executeQuery($query, "ii", $values);
        return $statement->insert_id;
    }

    public function delete($id_instituicao, $id_requisitor) {
        $query = "DELETE FROM filiacao WHERE id_instituicao = ? and id_requisitor = ?";
        $statement = $this->executeQuery($query, "ii", [$id_instituicao, $id_requisitor]);
        return $statement;
    }

    private function isValid($id_instituicao, $id_requisitor) {
        if(empty($id_instituicao) || empty($id_requisitor)) {
            return false;
        }
        if(!is_numeric($id_instituicao) || !is_numeric($id_requisitor)) {
            return false;
        }
        return true;
    }
}