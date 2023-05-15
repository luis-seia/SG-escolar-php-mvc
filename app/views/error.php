<?php
include("../app/views/includes/start.php");
?>

<main class="error-page">
    <?php include("../app/views/includes/header.php"); ?>
    <section>
        <div class="error-image-container">
            <img class="error-image" src="<?= ROOT."/assets/images/error.webp" ?>">
        </div>
        <h1 class="error-title">Página não encontrada</h1>
    </section>
</main>

<?php
include("../app/views/includes/end.php");
?>
