<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2, 3, 4)); ?>
<?php $titulo_pagina = 'Estoque'; ?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<?php $produtos = tabelaProdutos(); ?>
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
                                <p class="title"> Todos os Produtos </p>
                            </div>
                            <div class="header-block pull-right">
					   <a href="adicionarProduto.php" class="btn btn-primary btn-sm rounded"> Adicionar Produto </a>
                    </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Mínimo</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produtos as $p) : ?>
                                        <tr>
                                            <td><?php echo $p['id']; ?></td>
                                            <td><?php echo $p['nomeProduto']; ?></td>
                                            <td><?php echo $p['estoqueAtual']; ?></td>
                                            <td><?php echo $p['estoqueMinimo']; ?></td>
                                            <td><a href="editarProduto.php?id=<?php echo $p['id']; ?>" class="btn btn-info"><i class="fa fa-edit" style="color: white"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include_once('layout/footer.php'); ?>