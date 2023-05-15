<?php 
$salas = $data["salas"];
$active="salas";
$state = "default";
if(isset($data["state"])) {
    $state = $data["state"];
}

include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="add-sala content-section">
            <h2 class="content-title">Add sala</h2>
            <form action="" method="POST" class="add-sala-form add-form">
                <div class="add-form-inputs">
                    <input class="add-input add-sala-input" type="text" placeholder="Nome/Numero" name="numero" required>
                </div>
                <button class="add-button" type="submit" name="add">Add</button>
            </form>

            <?php if($state == "error") { ?>
                <div class="form-requisicao-part form-requisicao-error">
                    <p class="form-requisicao-error-message">Erro ao adicionar sala</p>
                </div>
            <?php } ?>

            <?php if($state == "added") { ?>
                <div class="form-requisicao-part form-requisicao-success">
                    <p class="form-requisicao-success-message">Sala adicionada</p>
                </div>
            <?php } ?>
        </div>

        <div class="requisitores content-section">
            <h2 class="content-title">Salas</h2>
            <?php if(empty($salas)) { ?>
                <p class="empty-message">Não tem</p>
            <?php 
            } else { ?>
                <div class="content">
                    <?php foreach($salas as $sala) { ?>
                        <div class="card card-space">
                            <div class="card-content">
                                <p class="card-intro">Nome</p>
                                <h2 class="card-title"><?= $sala["numero"] ?></h2>
                            </div>
                            <div class="card-buttons">
                                <button class="card-button card-delete-button" data-link="<?= ROOT."/instituicao/delete_sala/".$sala["id"]  ?>">Remover</button>
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