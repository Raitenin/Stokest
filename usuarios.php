<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2)); ?>
<?php $titulo_pagina = 'Usuarios'; ?>
<?php if (isset($_POST['add_Usuarios'])) {
    if ($_POST['nome'] != null) {
        $nome = limpaString($_POST['nome']);
        $sql = "INSERT INTO usuarios (nome, username, password, nivelAcesso, imagem, status) VALUES ('" . $nome . "')";
        if ($db->query($sql)) {
            $session->msg("s", "Marketplace inserido com sucesso.");
            redirect('Usuarios.php', false);
        } else {
            $session->msg("d", "Erro ao inserir Marketplace.");
            redirect('Usuarios.php', false);
        }
    } else {
        $session->msg("d", "Erro: Insira um nome válido.");
        redirect('Usuarios.php', false);
    }
}
?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<?php $Usuarios = tabelaUsuarios(); ?>
<?php $user = usuarioAtual(); ?>

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
                                <p class="title"> Todos os Usuarios </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Usuário</th>
                                        <th>Grupo</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($Usuarios as $p) : ?>
                                        <?php if ($user['nivelAcesso'] <= $p['nivelAcesso']) : ?>
                                        <tr>
                                            <td><?php echo $p['idUser']; ?></td>
                                            <td><?php echo $p['nome']; ?></td>
                                            <td><?php echo $p['username']; ?></td>
                                            <td><?php echo $p['nomeGrupo']; ?></td>
                                            <td><a href="editarUsuario.php?id=<?php echo $p['idUser']; ?>" class="btn btn-info"><i class="fa fa-edit" style="color: white"></i></a></td>
                                        </tr>
                                        <?php endif; ?>
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