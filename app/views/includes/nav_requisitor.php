<section class="dashnav">
    <div class="dashnav-top">
        <a href="<?= ROOT."/requisitor" ?>" class="dashnav-emoji"><span>📋</span></a>
        <a href="<?= ROOT."/requisitor/requisicoes" ?>" class="dashnav-item <?php if($active=="requisicoes") echo "dashnav-item-active" ?>">Requisições</a>
        <a href="<?= ROOT."/requisitor/instituicoes" ?>" class="dashnav-item <?php if($active=="instituicoes") echo "dashnav-item-active" ?>">Instituições</a>
        <a href="<?= ROOT."/requisitor/requisitar" ?>" class="dashnav-item <?php if($active=="requisitar") echo "dashnav-item-active" ?>">Requisitar</a>
    </div>
    
    <a href="<?= ROOT."/requisitor/logout" ?>" class="dashnav-item <?php if($active=="logout") echo "dashnav-item-active" ?>">Sair</a>
</section>