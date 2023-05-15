<?php 
include("../app/views/includes/start.php");
$active="pedidos";
?>

<main class="instituicao">
    <?php include("../app/views/includes/nav_instituicao.php"); ?>
    <section class="contents fade-in">
        <div class="pending-pedidos content-section">
            <h2 class="content-title">Pedidos pendentes</h2>
            <p class="empty-message">Nao tem</p>
        </div>

        <div class="pending-requests content-section">
            <h2 class="content-title">Pedidos rejeitados</h2>
            <p class="empty-message">Nao tem</p>
        </div>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>