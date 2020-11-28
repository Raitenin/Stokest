<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1,2)); ?>
<?php $titulo_pagina = 'Editar Usuário'; ?>
<?php if (isset($_GET['id'])) {
    $id = limpaString($_GET['id']);
} else {
    $session->msg("d","Falha ao buscar usuário");
    redirect('usuários.php', false);
} ?>
<?php $usuario = buscaId('usuarios', $id); ?>
<?php $atual = usuarioAtual(); ?>
<?php if($usuario['nivelAcesso'] < $atual['nivelAcesso']) {
  $session->msg("d","Não tem permissão para alterar este usuário");
  redirect("usuarios.php", false);
} ?>
<?php if (isset($_POST['edita_Usuario'])) {
  $campos_req = array('nome', 'username', 'nivel');
  validaCampos($campos_req);
  $nome = $db->escape($_POST['nome']);
  $username = $db->escape($_POST['username']);
  $nivel = $db->escape($_POST['nivel']);
  $status = $db->escape($_POST['status']);
  $sql = "UPDATE usuarios SET nome = '" . $nome . "', username = '" . $username . "', nivelAcesso = " . $nivel . ", status = " . $status . " WHERE id = " . $id;
  if ($db->query($sql)) {
    $session->msg("s", "Usuário atualizado com sucesso.");
    redirect('editarUsuario.php?id=' . $id, false);
  } else {
    $session->msg("d", "Erro ao atualizar usuário.");
    redirect('editarUsuario.php?id=' . $id, false);
  }
}
?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<?php $grupos = executaSql("SELECT * FROM usuarios__grupos"); ?>

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
                <p class="title"> Adicionar Usuário </p>
              </div>
            </div>
            <div class="card-body">
              <div class="col-md-6">
                <form method="post">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="nome" placeholder="Full Name" value="<?php echo $usuario['nome']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $usuario['username']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="nivel">Grupo</label>
                    <select class="form-control" name="nivel">
                      <?php foreach ($grupos as $g) : ?>
                        <?php if($atual['nivelAcesso']<=$g['nivelGrupo']): ?>
                        <option value="<?php echo $g['nivelGrupo']; ?>" <?php if($usuario['nivelAcesso'] ==$g['nivelGrupo']){ echo " selected";} ?>><?php echo ucwords($g['nomeGrupo']); ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                      <option value="1" <?php if($usuario['status'] ==1){ echo " selected";} ?>>Ativo</option>
                      <option value="0" <?php if($usuario['status'] ==0){ echo " selected";} ?>>Inativo</option>
                    </select>
                  </div>
                  <div class="form-group clearfix">
                    <button type="submit" name="edita_Usuario" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<?php include_once('layout/footer.php'); ?>