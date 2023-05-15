<?php 
$active = "materiais";
$tipo_material = $data["tipo_material"];
$materiais_todos = $data["materiais"];
$materiais = [];

if($materiais_todos) {
    foreach($materiais_todos as $material) {
        if($material["id_tipo"] == $tipo_material["id"]) {
            array_push($materiais, $material);
        } 
    }
}

include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="tipo_material content-section">
            <h2 class="content-title"><?= $tipo_material["nome"] ?></h2>
            <div class="content">
                <?php if(empty($materiais)) { ?>
                    <p class="empty-message">Sem material</p>
                <?php } else { ?>
                    <?php foreach($materiais as $material) { ?>
                        <div class="card card-space">
                            <div class="card-content">
                                <p class="card-intro"><?= $material["referencia"] ?></p>
                                <h2 class="card-title"><?= $material["nome"] ?></h2>
                            </div>
                            <div class="card-buttons">
                                <button class="card-button card-normal-button" data-link="<?= ROOT."/instituicao/edit_material/".$material["id"] ?>">Editar</button>
                                <button class="card-button card-delete-button" data-link="<?= ROOT."/instituicao/delete_material/".$material["id"] ?>">Remover</button>
                            </div>
                        </div>
                    <?php
                    }
                 } ?>
            </div>
        </div>
    </section>
</main>
<script src="<?= ROOT."/assets/scripts/materialType.js" ?>"></script>

<?php
include("../app/views/includes/end.php");
?>