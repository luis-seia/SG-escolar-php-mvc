<?php 
$instituicao = $data["instituicao"];
$tipos_material = $data["tipos_material"];

include("../app/views/includes/start.php");
?>

<main class="requisitor">
    <?php include("../app/views/includes/nav_requisitor.php"); ?>
    <section class="contents fade-in">
        <h1 class="requisitor-instituicao-title"><?= $instituicao["nome"] ?></h1>
        <div class="materiais content-section">
            <h2 class="content-title">Materiais</h2>
            <div class="content">
                <?php foreach($tipos_material as $tipo_material) { ?>
                    <div class="card card-no-border">
                        <div class="card-content">
                            <h2 class="card-title"><?= $tipo_material["nome"] ?></h2>
                            <div class="material-type-image-container" data-link="<?= ROOT."/requisitor/material/".$instituicao["id"]."/".$tipo_material["id"] ?>">
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