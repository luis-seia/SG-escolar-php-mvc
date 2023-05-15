<section class="dashnav">
    <div class="dashnav-top">
        <a href="<?= ROOT."/instituicao" ?>" class="dashnav-emoji"><span>🏫</span></a>
        <a href="<?= ROOT."/instituicao/requisicoes" ?>" class="dashnav-item <?php if($active=="requisicoes") echo "dashnav-item-active" ?>">Requisições</a>
        <a href="<?= ROOT."/instituicao/materiais" ?>" class="dashnav-item <?php if($active=="materiais") echo "dashnav-item-active" ?>">Materiais</a>
        <a href="<?= ROOT."/instituicao/requisitores" ?>" class="dashnav-item  <?php if($active=="requisitores") echo "dashnav-item-active" ?>">Requisitores</a>
        <a href="<?= ROOT."/instituicao/salas" ?>" class="dashnav-item <?php if($active=="salas") echo "dashnav-item-active" ?>">Salas</a>
        <a href="<?= ROOT."/instituicao/stats" ?>" class="dashnav-item <?php if($active=="estatisticas") echo "dashnav-item-active" ?>">Estatísticas</a>
    </div>
    
    <a href="<?= ROOT."/instituicao/logout" ?>" class="dashnav-item <?php if($active=="pedidos") echo "dashnav-item-active" ?>" >Sair</a>
</section>