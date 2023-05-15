<?php 
$active="materiais";
$tipos_material = $data["tipos_material"];
$state = "default";
if(isset($data["state"])) {
    $state = $data["state"];
}

include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="add-material content-section">
            <h2 class="content-title">Add material</h2>
            <form action="" method="POST" class="add-material-form add-form">
                <div class="add-form-inputs">
                    <input class="add-input" placeholder="Referencia" name="referencia" required>
                    <input class="add-input" placeholder="Nome" name="nome" required>
                    <select class="add-select" name="tipo" required>
                        <?php foreach($tipos_material as $tipo_material) { ?>
                            <option value="<?= $tipo_material["id"] ?>"><?= $tipo_material["nome"] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class="add-button" type="submit" name="add">Add</button>
            </form>

            <?php if($state == "error") { ?>
                <div class="form-requisicao-part form-requisicao-error">
                    <p class="form-requisicao-error-message">Erro ao adicionar material</p>
                </div>
            <?php } ?>

            <?php if($state == "added") { ?>
                <div class="form-requisicao-part form-requisicao-success">
                    <p class="form-requisicao-success-message">Material adicionado</p>
                </div>
            <?php } ?>
        </div>

        <div class="materiais content-section">
            <h2 class="content-title">Materiais</h2>
            <div class="content">
                <?php foreach($tipos_material as $tipo_material) { ?>
                    <div class="card card-no-border">
                        <div class="card-content">
                            <h2 class="card-title"><?= $tipo_material["nome"] ?></h2>
                            <div class="material-type-image-container" data-link="<?= ROOT."/instituicao/material/".$tipo_material["id"] ?>">
                                <img class="material-type-image" src="<?= ROOT."/assets/images/material/".$tipo_material["foto_url"] ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<script src="<?= ROOT."/assets/scripts/materialType.js" ?>"></script>

<?php
include("../app/views/includes/end.php");
?>