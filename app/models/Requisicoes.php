<?php
class Requisicoes extends Database {

    public function findById($id) {
        $query = "SELECT * FROM requisicao WHERE id = ?";
        $statement = $this->executeQuery($query, "i", [$id]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }

    public function findAllByInstitutionId($id_instituicao) {
        $query = "SELECT * FROM requisicao WHERE id_instituicao = ? ORDER BY data_desejada ASC, hora_inicio ASC";
        $statement = $this->executeQuery($query, "i", [$id_instituicao]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function findAllByRequisitorId($id_requisitor) {
        $query = "SELECT * FROM requisicao WHERE id_requisitor = ? ORDER BY data_desejada ASC, hora_inicio ASC";
        $statement = $this->executeQuery($query, "i", [$id_requisitor]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function add($id_requisitor, $id_instituicao, $id_material, $id_sala, $data_desejada, $hora_inicio, $hora_fim) {
        $values = [$id_requisitor, $id_instituicao, $id_material, $id_sala, $data_desejada, $hora_inicio, $hora_fim];
        $query = "INSERT INTO requisicao(id_requisitor, id_instituicao, id_material, id_sala, data_desejada, hora_inicio, hora_fim, data_requisicao, estado) VALUES (?,?,?,?,?,?,?, NOW(), 'pending')";
        $statement = $this->executeQuery($query, "iiiisss", $values);
        return $statement->insert_id;
    }

    public function changeStatus($id, $status) {
        if(!$this->findById($id)) return false;
        $query = "UPDATE requisicao SET estado = ? WHERE id = ?";
        $statement = $this->executeQuery($query, "si", [$status, $id]);
        return $statement;
    }

    public function checkAvailability($id_material, $data_desejada, $hora_inicio, $hora_fim) {
        $query = "SELECT * FROM requisicao WHERE id_material = ? AND data_desejada = ? AND (hora_inicio >= ? AND hora_inicio <= ? OR hora_fim >= ? AND hora_fim <= ?) AND estado = 'active'";
        $values = [$id_material, $data_desejada, $hora_inicio, $hora_fim, $hora_inicio, $hora_fim];
        $statement = $this->executeQuery($query, "isssss", $values);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return false;
        else return true;
    }

    public function findMaterialCountByInstitutionId($id_instituicao) {
        $query = "SELECT id_material, count(id_material) from requisicao where id_instituicao = ? group by id_material order by count(id_material) desc limit 5";
        $statement = $this->executeQuery($query, "i", [$id_instituicao]);
        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data;
        else return null;
    }

    public function findTotalCountByInstitutionId($id_instituicao) {
        $query = "SELECT count(id) from requisicao where id_instituicao = ?";
        $statement = $this->executeQuery($query, "i", [$id_instituicao]);

        $result = $statement->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if(count($data) > 0) return $data[0];
        else return null;
    }
}