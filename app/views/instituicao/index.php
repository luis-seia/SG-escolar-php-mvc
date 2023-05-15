<?php 
include("../app/views/includes/start.php");
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="active-requisicoes content-section">
            <h2 class="content-title">Requisições activas</h2>
            <p class="empty-message">Nao tem</p>
        </div>

        <div class="pending-requisicoes content-section">
            <h2 class="content-title">Requisições pendentes</h2>
            <p class="empty-message">Nao tem</p>
        </div>

        <div class="popular-materials content-section">
            <h2 class="content-title">Materiais mais populares</h2>
            <p class="empty-message">Nao tem</p>
        </div>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>