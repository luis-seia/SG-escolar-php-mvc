<?php 
$filiacoes = $data["filiacoes"];
$instituicoes_model = $data["instituicoes_model"];

include("../app/views/includes/start.php");
?>

<main class="requisitor">
    <?php include("../app/views/includes/nav_requisitor.php"); ?>
    <section class="contents fade-in">
        <div class="active-requisicoes content-section">
            <h2 class="content-title">Requisições activas</h2>
            <p class="empty-message">Não tem</p>
        </div>

        <div class="requisitor-institutions content-section">
            <h2 class="content-title">Instituições</h2>
            <?php if(empty($filiacoes)) { ?>
                <p class="empty-message">Não tem</p>
            <?php } else { ?>
                <div class="content">
                <?php foreach($filiacoes as $filiacao) {
                    $instituicao = $instituicoes_model->findById($filiacao["id_instituicao"]) ?>
                    <div class="card">
                        <div class="card-content">
                            <h2 class="card-title card-title-small"><?= $instituicao["nome"] ?></h2>
                            <p class="card-intro"><?= $instituicao["email"] ?></p>
                        </div>
                        <div class="card-buttons">
                            <button class="card-button card-normal-button" data-link="<?= ROOT."/requisitor/instituicao/".$instituicao["id"] ?>">Ver material</button>
                        </div>
                    </div>
                <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>