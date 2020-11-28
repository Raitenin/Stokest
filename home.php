<?php
  require_once('includes/load.php');
  $user = usuarioAtual();
  if (!$session->checaLogado(true)) { redirect('index.php', false);}
?>
<?php if($user['status'] === '0') { redirect('index.php', false);} ?>
<?php if($user['nivelAcesso'] >= 1) { redirect('dashboard.php', false);} ?>

