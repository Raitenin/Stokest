<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2)); ?>
<?php $titulo_pagina = 'Adicionar Produto'; ?>
<?php if (isset($_POST['add_Produto'])) {
    if ($_POST['nome'] != null) {
        $nome = limpaString($_POST['nome']);
        $atual = (int)limpaString($_POST['atual']);
        $minimo = (int)limpaString($_POST['minimo']);
        $sql = "INSERT INTO produtos (nomeProduto, estoqueAtual, estoqueMinimo) VALUES ('" . $nome . "'," . $atual . "," . $minimo . ")";
        if ($db->query($sql)) {
            $session->msg("s", "Produto inserido com sucesso.");
            redirect('adicionarProduto.php', false);
        } else {
            $session->msg("d", "Erro ao inserir Produto.");
            redirect('adicionarProduto.php', false);
        }
    } else {
        $session->msg("d", "Erro: Insira um nome válido.");
        redirect('adicionarProduto.php', false);
    }
}
?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>

<div class="container-fluid">
    <div class="content">
        <section class="section">
            <?php echo display_msg($msg); ?>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-default">
                        <div class="card-header clearfix">
                            <div class="header-block">
                                <p class="title"> Adicionar Produto </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Quantidade atual</label>
                                            <input type="number" class="form-control" name="atual" placeholder="Qtd" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Quantidade Mínima</label>
                                            <input type="number" class="form-control" name="minimo" placeholder="Qtd Mínima" required>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" name="add_Produto" class="btn btn-primary">Adicionar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>

<?php include_once('layout/footer.php'); ?>