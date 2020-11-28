<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2, 3, 4)); ?>
<?php $titulo_pagina = 'Dashboard'; ?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<?php $mes = date('m', time());
$ano = date('Y', time());
$produtos = maisVendidos($mes,$ano); ?>
<?php $estoqueBaixo = estoqueBaixo(); ?>
<div class="container-fluid">
    <div class="content">
        <section class="section">
            <?php echo display_msg($msg); ?>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-primary">
                        <div class="card-header clearfix">
                            <div class="header-block">
                                <p class="title" style="color: white;"> Itens mais consumidos no mês </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produtos as $p) : ?>
                                        <tr>
                                            <td><?php echo $p['nomeProduto']; ?></td>
                                            <td><?php echo $p['total']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-danger">
                        <div class="card-header clearfix">
                            <div class="header-block">
                                <i class="fa fa-exclamation-triangle" style="color: white;"></i>
                                <p class="title" style="color: white;"> Estoque Baixo! </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th>Produto</th>
                                        <th>Qtd</th>
                                        <th>Mínimo</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($estoqueBaixo as $p) : ?>
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
                            <a href="estoque.php" class="btn btn-primary">Ver tudo</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include_once('layout/footer.php'); ?>