<?php session_start();

class Session {

 public $msg;
 private $usuarioLogado = false;

 function __construct(){
   $this->flash_msg();
   $this->userLoginSetup();
 }

  public function checaLogado(){
    return $this->usuarioLogado;
  }
  public function login($user_id){
    $_SESSION['user_id'] = $user_id;
  }
  private function userLoginSetup()
  {
    if(isset($_COOKIE['persistID']))
    {
		if($_COOKIE['persistID']==null){
		$this->usuarioLogado = false;}
		else {
			session_start();
      $this->usuarioLogado = true;
		}
    } else {
      $this->usuarioLogado = false;
    }

  }
  public function logout(){
    unset($_SESSION['user_id']);
  }

  public function msg($type ='', $msg =''){
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }

  private function flash_msg(){

    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
}

$session = new Session();
$msg = $session->msg();

?>
