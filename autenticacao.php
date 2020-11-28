<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username', 'password');
validaCampos($req_fields);
$username = limpaString($_POST['username']);
$password = limpaString($_POST['password']);

if (empty($errors)) {

  $user = autenticaUser($username, $password);



  if ($user) :
    setcookie('persistID', (int)$user['id'], time() + (30 * 24 * 60 * 60), '/');
    $session->msg("s", "Olá " . $user['username']);
    redirect('dashboard.php', false);


  else :
    $session->msg("d", "Usuário ou senha inválidos.");
    redirect('index.php', false);
  endif;
} else {

  $session->msg("d", $errors);
  redirect('index.php', false);
}

?>
