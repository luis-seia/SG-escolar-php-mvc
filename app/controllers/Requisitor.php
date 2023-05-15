<?php

class Requisitor extends Controller {

    public function index() {
        authenticate("requisitor");
        header("Location: ".ROOT."/requisitor/requisicoes");
        die();
    }

    public function login() {
        if(!isset($_POST["login"])) {
            $this->view("requisitor/login", ["state" => "default"]);
       } else {
           $email = sanitize($_POST["email"]);
           $password = sanitize($_POST["password"]);
           $requisitores = $this->model("Requisitores");
           $requisitor = $requisitores->findByEmail($email);

           if($requisitor && password_verify($password, $requisitor["password"])) {
               $_SESSION["requisitor"] = $requisitor;
               header("Location: ".ROOT."/requisitor");
               die();
           } else {
               $this->view("requisitor/login", ["state" => "error"]);
           }
       }
    }

    public function register() {
        if(!isset($_POST["register"])) {
            $this->view("requisitor/register", ["state" => "default"]);
        } else {
            $nome = sanitize($_POST["nome"]);
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            $requisitores = $this->model("Requisitores");
            $statement = $requisitores->add($nome, $email, $password);

            if($statement) {
                header("Location: ".ROOT."/requisitor/login");
                die();
            }
            else $this->view("requisitor/register", ["state" => "error"]);
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ".ROOT."/requisitor/login");
        die();
    }

    public function requisicoes() {
        $requisitor = authenticate("requisitor");
        $instituicoes_model = $this->model("Instituicoes");
        $salas_model = $this->model("Salas");
        $materiais_model = $this->model("Materiais");
        $requisicoes = $this->model("Requisicoes");
        $requisicoes_list = $requisicoes->findAllByRequisitorId($requisitor["id"]);

        $this->view("requisitor/requisicoes", [
            "requisicoes" => $requisicoes_list,
            "salas_model" => $salas_model,
            "materiais_model" => $materiais_model,
            "instituicoes_model" => $instituicoes_model
        ]);
    }

    public function instituicoes() {
        $requisitor = authenticate("requisitor");
        $filiacoes = $this->model("Filiacoes");
        $filiacoes_list = $filiacoes->findAllByRequisitorId($requisitor["id"]);
        $instituicoes_model = $this->model("Instituicoes");

        $this->view("requisitor/instituicoes", [
            "instituicoes_model" => $instituicoes_model,
            "filiacoes" => $filiacoes_list
        ]);
    }

    public function instituicao($id) {
        $requisitor = authenticate("requisitor");
        $instituicoes = $this->model("Instituicoes");
        $tipos_material = $this->model("TiposMaterial");
        $tipos_material_list = $tipos_material->findAll();
        $instituicao = $instituicoes->findById($id);

        $this->view("requisitor/instituicao", ["instituicao" => $instituicao, "tipos_material" => $tipos_material_list]);
    }

    public function requisitar($id_material = "") {
        $tipos_material = $this->model("TiposMaterial");
        $requisitor = authenticate("requisitor");
        $instituicoes = $this->model("Instituicoes");
        $materiais = $this->model("Materiais");
        $filiacoes = $this->model("Filiacoes");
        $salas = $this->model("Salas");
        $requisicoes = $this->model("Requisicoes");
        $tipos_material_list = $tipos_material->findAll();
        $filiacoes_list = $filiacoes->findAllByRequisitorId($requisitor["id"]);
        $materiais_list = $materiais->findAll();
        $salas_list = $salas->findAll();

        $material = null;
        if($id_material != "") {
            $material = $materiais->findById($id_material);
        }


        if(!isset($_POST["requisitar"])) {
            $this->view("requisitor/requisitar", [
                "filiacoes" => $filiacoes_list, 
                "instituicoes_model" => $instituicoes,
                "salas" => $salas_list,
                "materiais" => $materiais_list,
                "state" => "default",
                "material" => $material,
                "tipos_materiais" => $tipos_material_list
            ]);
        } else {
            $id_instituicao = sanitize($_POST["instituicao"]);
            $id_sala = sanitize($_POST["sala"]);
            $id_material = sanitize($_POST["material"]);
            $data_desejada = sanitize($_POST["data_desejada"]);
            $hora_inicio = sanitize($_POST["hora_inicio"]);
            $hora_fim = sanitize($_POST["hora_fim"]);

            $available = $requisicoes->checkAvailability($id_material, $data_desejada, $hora_inicio, $hora_fim);

            $state = "available";
            if(!$available) {
                $state = "unavailable";
            } else {
                $requisicoes->add($requisitor["id"], $id_instituicao, $id_material, $id_sala, $data_desejada, $hora_inicio, $hora_fim);
            }

            $this->view("requisitor/requisitar", [
                "filiacoes" => $filiacoes_list, 
                "instituicoes_model" => $instituicoes,
                "salas" => $salas_list,
                "materiais" => $materiais_list,
                "state" => $state,
                "tipos_materiais" => $tipos_material_list
            ]);
        }
    }

    public function material($instituicao_id, $tipo_id) {
        $tipos_material = $this->model("TiposMaterial");
        $materiais = $this->model("Materiais");

        $tipo_material = $tipos_material->findById($tipo_id);
        $materiais_list = $materiais->findAllByInstitutionId($instituicao_id);

        $this->view("requisitor/material", [
            "tipo_material" => $tipo_material,
            "materiais" => $materiais_list
        ]);
    }
}