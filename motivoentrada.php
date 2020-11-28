<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2)); ?>
<?php $titulo_pagina = 'Motivos Entrada'; ?>
<?php if (isset($_POST['add_motivo'])) {
    if ($_POST['nome'] != null) {
        $nome = limpaString($_POST['nome']);
        $sql = "INSERT INTO motivoentrada (nomeMotivo) VALUES ('" . $nome . "')";
        if ($db->query($sql)) {
            $session->msg("s", "Motivo inserido com sucesso.");
            redirect('motivoentrada.php', false);
        } else {
            $session->msg("d", "Erro ao inserir Motivo.");
            redirect('motivoentrada.php', false);
        }
    } else {
        $session->msg("d", "Erro: Insira um nome válido.");
        redirect('motivoentrada.php', false);
    }
}
?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<?php $motivoentrada = tabelaMotivoEntrada(); ?>

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
                                <p class="title"> Adicionar Motivo </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Nome" required>
                                </div>

                                <div class="form-group clearfix">
                                    <button type="submit" name="add_motivo" class="btn btn-primary">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-default">
                        <div class="card-header clearfix">
                            <div class="header-block">
                                <p class="title"> Todos os Motivoes </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Motivo</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($motivoentrada as $p) : ?>
                                        <tr>
                                            <td><?php echo $p['id']; ?></td>
                                            <td><?php echo $p['nomeMotivo']; ?></td>
                                            <td><a href="editaMotivoEntrada?id=<?php echo $p['id']; ?>" class="btn btn-info"><i class="fa fa-edit" style="color: white"></i></a></td>
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