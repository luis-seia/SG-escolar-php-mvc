<?php 
$active= "estatisticas";
$instituicao = $data["instituicao"];
$total = $data["total"];
$count_materiais = $data["count_materiais"];
$materiais_model = $data["materiais_model"];

include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="total-requisicoes content-section">
            <h1><?= $instituicao["nome"] ?></h1>

            <?php if(!$total) { ?>
                <p class="empty-message">Sem requisições</p>
            <?php } else { ?>
                <p class="total">Total de requisições: <strong><?= $total["count(id)"] ?></strong></p>
            <?php } ?>

            <?php if($count_materiais) { ?>
                <table class="table" border=2>
                    <tr>
                        <th>Referencia</th>
                        <th>Material</th>
                        <th>Número de requisições</th>
                    </tr>

                    <?php foreach($count_materiais as $count) {
                        $material = $materiais_model->findById($count["id_material"]);  ?>
                        <tr>
                            <td><?= $material["referencia"] ?></td>
                            <td><?= $material["nome"] ?></td>
                            <td class="td-number"><?= $count["count(id_material)"] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>