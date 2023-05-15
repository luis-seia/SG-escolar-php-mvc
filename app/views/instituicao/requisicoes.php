<?php 
$active = "requisicoes";
$requisicoes = $data["requisicoes"];
$salas_model = $data["salas_model"];
$materiais_model = $data["materiais_model"];
$requisitores_model = $data["requisitores_model"];

$requisicoes_activas = [];
$requisicoes_pendentes = [];
$requisicoes_completas = [];
$requisicoes_rejeitadas = [];

if($requisicoes) {
    foreach($requisicoes as $requisicao) {
        if($requisicao["estado"] == "active") {
            array_push($requisicoes_activas, $requisicao);
        }
        if($requisicao["estado"] == "pending") {
            array_push($requisicoes_pendentes, $requisicao);
        }
        if($requisicao["estado"] == "completed") {
            array_push($requisicoes_completas, $requisicao);
        }
        if($requisicao["estado"] == "rejected") {
            array_push($requisicoes_rejeitadas, $requisicao);
        }
    }
}

include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="active-requisicoes content-section">
            <h2 class="content-title">Requisições activas</h2>
            <?php if(empty($requisicoes_activas)) { ?>
                <p class="empty-message">Não tem</p>
            <?php } else { ?>
                <div class="content">
                <?php foreach($requisicoes_activas as $requisicao) {
                    $material = $materiais_model->findById($requisicao["id_material"]);
                    $requisitor = $requisitores_model->findById($requisicao["id_requisitor"]);
                    $sala = $salas_model->findById($requisicao["id_sala"]);
                ?>
                    <div class="card">
                        <div class="card-content">
                            <h2 class="card-title"><?= $material["nome"] ?></h2>
                            <p class="card-intro intro-black"><?= "Requisitado por <strong>".$requisitor["nome"]."</strong>"?></p>
                            <p class="card-intro intro-black"><?= "Data: <strong>".$requisicao["data_desejada"]."</strong>" ?></p>
                            <p class="card-intro intro-black"><?= "Horas: <strong>".$requisicao["hora_inicio"]."->".$requisicao["hora_fim"]."</strong>" ?></p>
                            <p class="card-intro intro-black"><?= "Sala: <strong>".$sala["numero"]."</strong>" ?></p>
                        </div>
                        <div class="card-buttons">
                            <button class="card-button card-normal-button" data-link="<?= ROOT."/instituicao/complete_requisicao/".$requisicao["id"] ?>">Completar</button>
                        </div>
                    </div>
                <?php } 
                } ?>
                </div>
        </div>

        <div class="pending-requisicoes content-section">
            <h2 class="content-title">Requisições pendentes</h2>
            <?php if(empty($requisicoes_pendentes)) { ?>
                <p class="empty-message">Não tem</p>
            <?php } else { ?>
                <div class="content">
                <?php foreach($requisicoes_pendentes as $requisicao) {
                    $material = $materiais_model->findById($requisicao["id_material"]);
                    $requisitor = $requisitores_model->findById($requisicao["id_requisitor"]);
                    $sala = $salas_model->findById($requisicao["id_sala"]);
                ?>
                    <div class="card">
                        <div class="card-content">
                            <h2 class="card-title"><?= $material["nome"] ?></h2>
                            <p class="card-intro intro-black"><?= "Requisitado por <strong>".$requisitor["nome"]."</strong>" ?></p>
                            <p class="card-intro intro-black"><?= "Data: <strong>".$requisicao["data_desejada"]."</strong>" ?></p>
                            <p class="card-intro intro-black"><?= "Horas: <strong>".$requisicao["hora_inicio"]."->".$requisicao["hora_fim"]."</strong>" ?></p>
                            <p class="card-intro intro-black"><?= "Sala: <strong>".$sala["numero"]."</strong>" ?></p>
                        </div>
                        <div class="card-buttons">
                            <button class="card-button card-normal-button" data-link="<?= ROOT."/instituicao/accept_requisicao/".$requisicao["id"] ?>">Aceitar</button>
                            <button class="card-button card-delete-button" data-link="<?= ROOT."/instituicao/reject_requisicao/".$requisicao["id"] ?>">Rejeitar</button>
                        </div>
                    </div>
                <?php } 
                } ?>
                </div>
        </div>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>