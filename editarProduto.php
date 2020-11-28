<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2)); ?>
<?php $titulo_pagina = 'Editar Produto'; ?>
<?php if (isset($_GET['id'])) {
    $id = limpaString($_GET['id']);
} else {
    $session->msg("d","Falha ao buscar produto");
    redirect('estoque.php', false);
} ?>
<?php if (isset($_POST['edita_Produto'])) {
    if ($_POST['nome'] != null) {

        $nome = limpaString($_POST['nome']);
        $atual = (int)limpaString($_POST['atual']);
        $minimo = (int)limpaString($_POST['minimo']);
        $sql = "UPDATE produtos SET nomeProduto = '" . $nome . "', estoqueAtual = " . $atual . ", estoqueMinimo = " . $minimo . " WHERE id=" . $_GET['id'];
        if ($db->query($sql)) {
            $session->msg("s", "Produto atualizado com sucesso.");
            redirect('editarProduto.php?id='.$id, false);
        } else {
            $session->msg("d", "Erro ao atualizar Produto.");
            redirect('editarProduto.php?id='.$id, false);
        }
    } else {
        $session->msg("d", "Erro: Insira um nome válido.");
        redirect('editarProduto.php?id='.$id, false);
    }
}
?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<?php $produto = buscaId('produtos', $id); ?>

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
                                <p class="title"> Editar Produto </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $produto['nomeProduto']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Quantidade atual</label>
                                            <input type="number" class="form-control" name="atual" placeholder="Qtd" value="<?php echo $produto['estoqueAtual']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Quantidade Mínima</label>
                                            <input type="number" class="form-control" name="minimo" placeholder="Qtd Mínima" value="<?php echo $produto['estoqueMinimo']; ?>" required>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" name="edita_Produto" class="btn btn-primary">Salvar</button>
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