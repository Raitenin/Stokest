<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1)); ?>
<?php $titulo_pagina = 'Adicionar Usuário'; ?>
<?php if (isset($_POST['add_Usuario'])) {
  $campos_req = array('nome', 'username', 'password', 'nivel');
  validaCampos($campos_req);
  $nome = $db->escape($_POST['nome']);
  $username = $db->escape($_POST['username']);
  $nivel = $db->escape($_POST['nivel']);
  $password = $_POST['password'];
  $password = sha1($password);
  $sql = "INSERT INTO usuarios (nome, username, password, nivelAcesso, status) VALUES ('" . $nome . "','" . $username . "','" . $password . "','" . $nivel . "', 1)";
  if ($db->query($sql)) {
    $session->msg("s", "Usuário inserido com sucesso.");
    redirect('adicionarUsuario.php', false);
  } else {
    $session->msg("d", "Erro ao inserir usuário.");
    redirect('adicionarUsuario.php', false);
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
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome Completo">
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="nivel">Grupo</label>
                    <select class="form-control" name="nivel">
                      <?php foreach ($grupos as $g) : ?>
                        <option value="<?php echo $g['nivelGrupo']; ?>"><?php echo ucwords($g['nomeGrupo']); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group clearfix">
                    <button type="submit" name="add_Usuario" class="btn btn-primary">Adicionar</button>
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