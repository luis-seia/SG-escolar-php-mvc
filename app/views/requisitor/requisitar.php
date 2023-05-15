<?php 
$tipos_materiais = $data["tipos_materiais"];
$filiacoes = $data["filiacoes"];
$instituicoes_model = $data["instituicoes_model"];
$salas = $data["salas"];
$materiais = $data["materiais"];
$state = $data["state"];
$active="requisitar";

$material = null;
if(isset($data["material"])) {
    $material = $data["material"];
}

include("../app/views/includes/start.php");
?>

<main class="requisitor">
    <?php include("../app/views/includes/nav_requisitor.php"); ?>
    <section class="contents fade-in">
        <div class="content-section">
            <h2>Requisição</h2>
            <form class="form-requisicao" action="" method="POST">
                <?php if($state == "unavailable") { ?>
                    <div class="form-requisicao-part form-requisicao-error">
                        <p class="form-requisicao-error-message">Material não disponível nesse tempo</p>
                    </div>
                <?php } ?>

                <?php if($state == "available") { ?>
                    <div class="form-requisicao-part form-requisicao-success">
                        <p class="form-requisicao-success-message">Requisição feita</p>
                    </div>
                <?php } ?>

                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Instituição</label>
                    <select class="form-requisicao-input institution-select" name="instituicao"  required>
                        <?php foreach($filiacoes as $filiacao) {
                            $instituicao = $instituicoes_model->findById($filiacao["id_instituicao"]); ?>
                            <option value="<?= $filiacao["id_instituicao"] ?>"><?= $instituicao["nome"]  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Sala</label>
                    <select class="form-requisicao-input sala-select" name="sala" required>
                        
                    </select>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Tipo Material</label>
                    <select class="form-requisicao-input tipos-select" name="tipo" required>
                        <?php foreach($tipos_materiais as $tipo) { ?>
                            <option value="<?= $tipo["id"] ?>"><?= $tipo["nome"]  ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Material</label>
                    <select class="form-requisicao-input material-select" name="material" required>
                        
                    </select>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Data</label>
                    <input class="form-requisicao-input" type="date" name="data_desejada" required>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Hora início</label>
                    <input class="form-requisicao-input" type="time" name="hora_inicio" required>
                </div>
                <div class="form-requisicao-part">
                    <label class="form-requisicao-label">Hora fim</label>
                    <input class="form-requisicao-input" type="time" name="hora_fim" required>
                </div>
                <button class="form-requisicao-button" type="submit" name="requisitar">Requisitar</button>
            </form>
        </div>
    </section>
</main>

<script>
    const salas = <?php echo json_encode($salas) ?>;
    const materiais = <?php echo json_encode($materiais) ?>;
    const tipos = <?php echo json_encode($tipos_materiais) ?>;
    const institutionSelect = document.querySelector(".institution-select"); 
    const salaSelect = document.querySelector(".sala-select");
    const materialSelect = document.querySelector(".material-select");
    const tipoSelect = document.querySelector(".tipos-select");


    const material = <?php 
        if($material) echo json_encode($material);
        else echo "null";
    ?>

    populateSalaSelect();
    populateMaterialSelect();

    if(material) {
        institutionSelect.value = material.id_instituicao;
        tipoSelect.value = material.id_tipo;
        populateSalaSelect();
        populateMaterialSelect();
        materialSelect.value = material.id;
    }

    institutionSelect.addEventListener("change", () => {
        populateSalaSelect();
        populateMaterialSelect();
    });

    tipoSelect.addEventListener("change", () => {
        populateMaterialSelect();
    })

    function populateSalaSelect() {
        const institution = institutionSelect.value;

        salaSelect.innerHTML = "";
        
        salas.forEach((sala) => {
            if(sala.id_instituicao == institution) {
                const option = document.createElement("option");
                option.setAttribute("value", sala.id);
                option.innerHTML = sala.numero;
                salaSelect.appendChild(option);
            }
        });
    }

    function populateMaterialSelect() {
        const institution = institutionSelect.value;
        const tipo = tipoSelect.value;

        materialSelect.innerHTML = "";
        
        materiais.forEach((material) => {
            if(material.id_instituicao == institution && material.id_tipo == tipo) {
                const option = document.createElement("option");
                option.setAttribute("value", material.id);
                option.innerHTML = material.nome;
                materialSelect.appendChild(option);
            }
        });
    }
</script>

<?php
include("../app/views/includes/end.php");
?>