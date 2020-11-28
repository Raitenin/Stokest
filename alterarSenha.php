<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1,2,3,4)); ?>
<?php $titulo_pagina = 'Editar Usuário'; ?>
<?php $user = usuarioAtual(); ?>
<?php if (isset($_POST['edita_Senha'])) {
  $password = $_POST['password'];
  $password = sha1($password);
  $sql = "UPDATE usuarios SET password = '" . $password . "' WHERE id = " . $user['id'];
  if ($db->query($sql)) {
    $session->msg("s", "Usuário atualizado com sucesso.");
    redirect('alterarSenha.php', false);
  } else {
    $session->msg("d", "Erro ao atualizar usuário.");
    redirect('alterarSenha.php', false);
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
                <p class="title"> Adicionar Usuário </p>
              </div>
            </div>
            <div class="card-body">
              <div class="col-md-6">
                <form method="post">
                  <div class="form-group">
                    <label for="password">Nova Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="Nova Senha">
                  </div>
                  <div class="form-group clearfix">
                    <button type="submit" name="edita_Senha" class="btn btn-primary">Salvar</button>
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