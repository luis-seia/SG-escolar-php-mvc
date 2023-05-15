<?php
$state = $data["state"];

include("../app/views/includes/start.php");
?>

<main class="login">
    <?php include("../app/views/includes/header.php"); ?>
    <section class="login-section container fade-in">
        <form class="form login-form" action="" method="POST">
            <span class="form-emoji">🏫</span>
            <h2 class="form-title">Instituição</h2>
            <?php  if($state == "registered") { ?>
                <div class="success-message">
                    <p>Conta criada</p>
                </div>
            <?php } else if($state == "error") { ?>
                <div class="error-message">
                    <p>Credenciais inválidas</p>
                </div>
            <?php } ?>
            <input class="form-input" type="email" name="email" placeholder="Email" required>
            <input class="form-input" type="password" name="password" placeholder="Password" required>
            <button class="form-button" type="submit" name="login">Entrar</button>
            <p class="form-additional">Não tens conta? <a class="link" href="<?= ROOT."/instituicao/register" ?>">Registrar</a></p>
        </form>
    </section>
</main>

<?php
include("../app/views/includes/footer.php");
include("../app/views/includes/end.php");
?>