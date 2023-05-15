<?php
include("../app/views/includes/start.php");
?>

<main class="home">
    <?php include("../app/views/includes/header.php"); ?>
    <section class="hero-section-instituicao container fade-in">
        <div class="hero">
            <h1 class="hero-text">Utilização eficiente do material escolar da instituição</h1>
            <p class="hero-description">Adiciona, edita, remove e controla requisições feitas a cada material</p>
            <div class="hero-buttons">
                <button class="hero-button button" data-link="<?= ROOT."/instituicao/login" ?>">Entrar</button>
                <button class="hero-button button" data-link="<?= ROOT."/instituicao/register" ?>">Registrar</button>
            </div>
        </div>
        <div class="hero-image-div">
            <img class="hero-image" src="<?= ROOT."/assets/images/instituicao.jpg" ?>">
        </div>
    </section>

    <section class="hero-section-requisitor container fade-in">
        <div class="hero">
            <h1 class="hero-text">Requisite material das instituições</h1>
            <p class="hero-description">Verifique os materias disponíveis e requisite-os com antecedência</p>
            <div class="hero-buttons">
                <button class="hero-button button" data-link="<?= ROOT."/requisitor/login" ?>">Entrar</button>
                <button class="hero-button button" data-link="<?= ROOT."/requisitor/register" ?>">Registrar</button>
            </div>
        </div>
        <div class="hero-image-div">
            <img class="hero-image" src="<?= ROOT."/assets/images/requisitor.jpg" ?>">
        </div>
    </section>
</main>

<?php
include("../app/views/includes/footer.php");
include("../app/views/includes/end.php");
?>