<?php
  require_once('includes/load.php');
  
  if (isset($_COOKIE['persistID'])) {
    unset($_COOKIE['persistID']);
    setcookie('persistID', null, -1, '/');
}
  if(!$session->logout()) {redirect("index.php");}
?>
