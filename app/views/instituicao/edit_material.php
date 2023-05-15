<?php 
$active="materiais";
$material = $data["material"];

$state = "";
if(isset($data["state"])) {
    $state = $data["state"];
}

$material = null;
if(isset($data["material"])) {
    $material = $data["material"];
}

include("../app/views/includes/start.php");
?>

<main class="requisitor">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="content-section">
            <h2>Editar material</h2>
            <form class="form-requisicao" action="" method="POST">
                <?php if($state == "error") { ?>
                    <div class="form-requisicao-part form-requisicao-error">
                        <p class="form-requisicao-error-message">Erro ao editar material</p>
                    </div>
                <?php } ?>

                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Referência</label>
                    <input value="<?= $material["referencia"] ?>" class="form-requisicao-input" type="text" name="referencia" required>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Nome</label>
                    <input value="<?= $material["nome"] ?>" class="form-requisicao-input" type="text" name="nome" required>
                </div>
                <button class="form-requisicao-button" type="submit" name="edit">Editar</button>
            </form>
        </div>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>