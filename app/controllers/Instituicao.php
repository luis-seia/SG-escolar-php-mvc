<?php

class Instituicao extends Controller {
    
    public function index() {
        header("Location: ".ROOT."/instituicao/requisicoes");
        die();
    }

    public function login() {
        if(!isset($_POST["login"])) {
            $this->view("instituicao/login", ["state" => "default"]);
        } else {
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            $instituicoes = $this->model("Instituicoes");
            $instituicao = $instituicoes->findByEmail($email);

            if($instituicao && password_verify($password, $instituicao["password"])) {
                $_SESSION["instituicao"] = $instituicao;
                header("Location: ".ROOT."/instituicao");
                die();
            } else {
                $this->view("instituicao/login", ["state" => "error"]);
            }
        }
    }

    public function register() {
        if(!isset($_POST["register"])) {
            $this->view("instituicao/register", ["state" => "default"]);
        } else {
            $nome = sanitize($_POST["nome"]);
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            $instituicoes = $this->model("Instituicoes");
            $statement = $instituicoes->add($nome, $email, $password);

            if($statement) {
                header("Location: ".ROOT."/instituicao/login");
                die();
            }
            else $this->view("instituicao/register", ["state" => "error"]);
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ".ROOT."/instituicao/login");
        die();
    }

    public function requisicoes() {
        $instituicao = authenticate("instituicao");
        $requisitores_model = $this->model("Requisitores");
        $salas_model = $this->model("Salas");
        $materiais_model = $this->model("Materiais");
        $requisicoes = $this->model("Requisicoes");
        $requisicoes_list = $requisicoes->findAllByInstitutionId($instituicao["id"]);

        $this->view("instituicao/requisicoes", [
            "requisicoes" => $requisicoes_list,
            "salas_model" => $salas_model,
            "materiais_model" => $materiais_model,
            "requisitores_model" => $requisitores_model
        ]);
    }

    public function materiais() {
        $instituicao = authenticate("instituicao");
        $materiais = $this->model("Materiais");
        $tipos_material = $this->model("TiposMaterial");
        $tipos_material_list = $tipos_material->findAll();

        if(!isset($_POST["add"])) {
            $this->view("instituicao/materiais", ["tipos_material" => $tipos_material_list]);
        } else {
            $referencia = sanitize($_POST["referencia"]);
            $nome = sanitize($_POST["nome"]);
            $tipo = sanitize($_POST["tipo"]);
            
            $statement = $materiais->add($referencia, $nome, $tipo, $instituicao["id"]);

            if($statement == null) {
                $this->view("instituicao/materiais", ["tipos_material" => $tipos_material_list, "state" => "error"]);
            } else {
                $this->view("instituicao/materiais", ["tipos_material" => $tipos_material_list, "state" => "added"]);
            }
        }
    }

    public function material($tipo_id) {
        $instituicao = authenticate("instituicao");
        $tipos_material = $this->model("TiposMaterial");
        $materiais = $this->model("Materiais");

        $tipo_material = $tipos_material->findById($tipo_id);

        if(!$tipo_material) $this->pageNotFound();
        
        else {
            $materiais_list = $materiais->findAllByInstitutionId($instituicao["id"]);

            $this->view("instituicao/material", [
                "tipo_material" => $tipo_material,
                "materiais" => $materiais_list
            ]);
        }
    }

    public function requisitores() {
        $instituicao = authenticate("instituicao");
        $requisitores = $this->model("Requisitores");
        $filiacoes = $this->model("Filiacoes");

        $filiacoes_list = $filiacoes->findAllByInstitutionId($instituicao["id"]);

        if(!isset($_POST["add"])) {
            $this->view("instituicao/requisitores", ["filiacoes" => $filiacoes_list, "requisitores_model" => $requisitores]);
        } else {
            $email = sanitize($_POST["email"]);
            $requisitor = $requisitores->findByEmail($email);
            
            if($requisitor) $statement = $filiacoes->add($instituicao["id"], $requisitor["id"]);
            else $statement = null;

            # After adding, we have to get the new list
            $filiacoes_list = $filiacoes->findAllByInstitutionId($instituicao["id"]);

            if($statement === null) {
                $this->view("instituicao/requisitores", ["filiacoes" => $filiacoes_list, "requisitores_model" => $requisitores, "state" => "error"]);
            } else {
                $this->view("instituicao/requisitores", ["filiacoes" => $filiacoes_list, "requisitores_model" => $requisitores, "state" => "added"]);
            }
             
        }
    }

    public function salas() {
        $instituicao = authenticate("instituicao");
        $salas = $this->model("Salas");
        $salas_list = $salas->findAllByInstitutionId($instituicao["id"]);

        if(!isset($_POST["add"])) { 
            $this->view("instituicao/salas", ["state" => "default", "salas" => $salas_list]);
        } 
        else {
            $numero = sanitize($_POST["numero"]);
            $statement = $salas->add($numero, $instituicao["id"]);

            if($statement) {   
                $salas_list = $salas->findAllByInstitutionId($instituicao["id"]);
                $this->view("instituicao/salas", ["state" => "added", "salas" => $salas_list]);
            } else { 
                $this->view("instituicao/salas", ["state" => "error", "salas" => $salas_list]);
            }
        }
    }

    public function pedidos() {
        authenticate("instituicao");
        $this->view("instituicao/pedidos");
    }

    public function delete_sala($id) {
        authenticate("instituicao");
        $salas = $this->model("Salas");
        $salas->delete($id);

        header("Location: ".ROOT."/instituicao/salas");
        die();
    }

    public function delete_requisitor($id_requisitor) {
        $instituicao = authenticate("instituicao");
        $filiacoes = $this->model("Filiacoes");
        $filiacoes->delete($instituicao["id"], $id_requisitor);

        header("Location: ".ROOT."/instituicao/requisitores");
        die();
    }

    public function accept_requisicao($id) {
        authenticate("instituicao");
        $requisicoes = $this->model("Requisicoes");
        $requisicoes->changeStatus($id, "active");

        header("Location: ".ROOT."/instituicao/requisicoes");
        die();
    }

    public function reject_requisicao($id) {
        authenticate("instituicao");
        $requisicoes = $this->model("Requisicoes");
        $requisicoes->changeStatus($id, "rejected");

        header("Location: ".ROOT."/instituicao/requisicoes");
        die();
    }

    public function complete_requisicao($id) {
        authenticate("instituicao");
        $requisicoes = $this->model("Requisicoes");
        $requisicoes->changeStatus($id, "completed");

        header("Location: ".ROOT."/instituicao/requisicoes");
        die();
    }

    public function edit_material($id) {
        authenticate("instituicao");
        $materiais = $this->model("Materiais");
        $material = $materiais->findById($id);

        if(!$material) {
            $this->pageNotFound();
        } else {
            if(!isset($_POST["edit"])) {
                $this->view("instituicao/edit_material", ["material" => $material]);
            } else {
                $referencia = sanitize($_POST["referencia"]);
                $nome = sanitize($_POST["nome"]);
                $statement = $materiais->update($id, $referencia, $nome);
                show($statement);
                
                if($statement) {
                    header("Location: ".ROOT."/instituicao/material/".$material["id_tipo"]);
                    die();
                } else {
                    $this->view("instituicao/edit_material", [
                        "material" => $material,
                        "state" => "error"
                    ]);
                }
            }
        }
    }

    public function delete_material($id) {
        authenticate("instituicao");
        $materiais = $this->model("Materiais");
        $material = $materiais->findById($id);

        if(!$material) $this->pageNotFound();
        else {
            $materiais->delete($id);
            header("Location: ".ROOT."/instituicao/material/".$material["id_tipo"]);
            die();
        }
    }

    public function stats() {
        $instituicao = authenticate("instituicao");
        $requisicoes = $this->model("Requisicoes");
        $materiais = $this->model("Materiais");
        $total = $requisicoes->findTotalCountByInstitutionId($instituicao["id"]);
        $count = $requisicoes->findMaterialCountByInstitutionId($instituicao["id"]);

        $this->view("instituicao/stats", [
            "instituicao" => $instituicao,
            "count_materiais" => $count,
            "total" => $total,
            "materiais_model" => $materiais
        ]);
    }
}