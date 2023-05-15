<?php
$state = $data["state"];

include("../app/views/includes/start.php");
?>

<main class="register">
    <?php include("../app/views/includes/header.php"); ?>
    <section class="register-section container fade-in">
        <form class="form register-form" action="" method="POST">
            <span class="form-emoji">📋</span>
            <h2 class="form-title">Requisitor</h2>
            <?php if($state == "error") { ?>
                <div class="error-message">
                    <p>Não foi possível registrar essa conta</p>
                </div>
            <?php } ?>
            <input class="form-input" type="text" name="nome" placeholder="Nome" required>
            <input class="form-input" type="email" name="email" placeholder="Email" required>
            <input class="form-input" type="password" name="password" placeholder="Password" required>
            <button class="form-button" type="submit" name="register">Registrar</button>
            <p class="form-additional">Já tens conta? <a class="link" href="<?= ROOT."/requisitor/login" ?>">Entrar</a></p>
        </form>
    </section>
</main>

<?php
include("../app/views/includes/footer.php");
include("../app/views/includes/end.php");
?>