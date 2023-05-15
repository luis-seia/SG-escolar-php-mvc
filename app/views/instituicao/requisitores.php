<?php 
$filiacoes = $data["filiacoes"];
$requisitores_model = $data["requisitores_model"];
$active="requisitores";
$state = "default";
if(isset($data["state"])) {
    $state = $data["state"];
}

include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="add-requisitor content-section">
            <h2>Add requisitor</h2>
            <form action="" method="POST" class="add-requisitor-form add-form">
                <div class="add-form-inputs">
                    <input class="add-input add-requisitor-input" type="email" placeholder="Email" name="email" required>
                </div>
                <button class="add-button" type="submit" name="add">Add</button>
            </form>

            <?php if($state == "error") { ?>
                <div class="form-requisicao-part form-requisicao-error">
                    <p class="form-requisicao-error-message">Erro ao adicionar requisitor</p>
                </div>
            <?php } ?>

            <?php if($state == "added") { ?>
                <div class="form-requisicao-part form-requisicao-success">
                    <p class="form-requisicao-success-message">Requisitor adicionado</p>
                </div>
            <?php } ?>
        </div>

        <div class="requisitores content-section">
            <h2 class="content-title">Requisitores</h2>
            <div class="content">
                <?php if(!$filiacoes) { ?>
                    <p class="empty-message">Nao tem</p>
                <?php } else { 
                    foreach($filiacoes as $filiacao) {
                        $requisitor = $requisitores_model->findById($filiacao["id_requisitor"]); ?>
                        <div class="card card-space">
                            <div class="card-content">
                                <h2 class="card-title"><?= $requisitor["nome"] ?></h2>
                                <p class="card-intro"><?= $requisitor["email"] ?></p>
                            </div>
                            <div class="card-buttons">
                                <button class="card-button card-delete-button" data-link="<?= ROOT."/instituicao/delete_requisitor/".$requisitor["id"] ?>">Remover</button>
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