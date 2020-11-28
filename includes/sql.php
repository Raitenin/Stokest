<?php
require_once('includes/load.php');

/*--------------------------------------------------------------*/
/* Função para query geral
/*--------------------------------------------------------------*/
function executaSql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}

/*--------------------------------------------------------------*/
/* Busca linha por ID
/*--------------------------------------------------------------*/
function buscaId($table, $id)
{
  global $db;
  $id = (int) $id;
  if (verificaTabela($table)) {
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");

    if ($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

/*--------------------------------------------------------------*/
/* Conta as linhas da tabela
/*--------------------------------------------------------------*/

function contaId($table)
{
  global $db;
  if (verificaTabela($table)) {
    $sql    = "SELECT COUNT(id) AS total FROM " . $db->escape($table);
    $result = $db->query($sql);
    return ($db->fetch_assoc($result));
  }
}

/*--------------------------------------------------------------*/
/* Determina se a tabela existe
/*--------------------------------------------------------------*/
function verificaTabela($table)
{
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM ' . DB_NAME . ' LIKE "' . $db->escape($table) . '"');
  if ($table_exit) {
    if ($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}

/*--------------------------------------------------------------*/
/* Login a partir de index.php com POST
/*--------------------------------------------------------------*/
function autenticaUser($username = '', $password = '')
{
  global $db;
  $username = $db->escape($username);
  $password = $db->escape($password);
  $sql  = sprintf("SELECT id,username,password,nivelAcesso FROM usuarios WHERE username ='%s' LIMIT 1", $username);
  $result = $db->query($sql);
  if ($db->num_rows($result)) {
    $user = $db->fetch_assoc($result);
    $password_request = sha1($password);
    if ($password_request === $user['password']) {
      return $user;
    }
  }
  return false;
}


/*--------------------------------------------------------------*/
/* Retorna as informações do usuário atual
/*--------------------------------------------------------------*/
function usuarioAtual()
{
  static $usuarioAtual;
  global $db;
  if (isset($_COOKIE['persistID'])) {
    $user_id = intval($_COOKIE['persistID']);
    $usuarioAtual = buscaId('usuarios', $user_id);
  }

  return $usuarioAtual;
}

/*--------------------------------------------------------------*/
/* Função para checagem de nível de acesso para cada página
/*--------------------------------------------------------------*/
function verificaNivelAcesso($nivel)
{
  global $session;
  $usuarioAtual = usuarioAtual();
  $status = $usuarioAtual['status'];
  $i = 0;
  foreach ($nivel as $n) {
    if ($n == $usuarioAtual['nivelAcesso']) {
      $i++;
    }
  }
  if (!$session->checaLogado(true)) {
    $session->msg('d', 'Faça Login...');
    redirect('index.php', false);
  } elseif ($status === '0') {
    $session->msg('d', 'Este usuário foi banido');
    $_COOKIE['persistID'] = null;
    redirect('index.php', false);
  } elseif ($i >= 1) {
    return true;
  } else {
    $session->msg("d", "Você não tem permissão para acessar esta página.");
    redirect('dashboard.php', false);
  }
}

/*--------------------------------------------------------------*/
/* Função para retorno da tabela de produtos
/*--------------------------------------------------------------*/
function tabelaProdutos(){
  $sql = "SELECT * FROM produtos";
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para retorno da tabela de motivoentrada
/*--------------------------------------------------------------*/
function tabelaMotivoEntrada(){
  $sql = "SELECT * FROM motivoentrada";
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para retorno da tabela de marketplaces
/*--------------------------------------------------------------*/
function tabelaMotivoSaida(){
  $sql = "SELECT * FROM motivosaida";
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para retorno da tabela de usuarios
/*--------------------------------------------------------------*/
function tabelaUsuarios(){
  $sql = "SELECT *, u.id AS idUser FROM usuarios u INNER JOIN usuarios__grupos g ON g.nivelGrupo = u.nivelAcesso";
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para retorno da tabela de estoque abaixo do mínimo
/*--------------------------------------------------------------*/
function estoqueBaixo(){
  $sql = "SELECT * FROM produtos WHERE estoqueAtual < estoqueMinimo";
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para saída de itens do estoque
/*--------------------------------------------------------------*/
function saidaEstoque($p,$q){
  global $db;
  $sql = "UPDATE produtos SET estoqueAtual=(estoqueAtual -{$q}) WHERE id = {$p}"; 
  $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Função para entrada de itens do estoque
/*--------------------------------------------------------------*/
function entradaEstoque($p,$q){
  global $db;
  $sql = "UPDATE produtos SET estoqueAtual=(estoqueAtual +{$q}) WHERE id = {$p}"; 
  $db->query($sql);
}

/*--------------------------------------------------------------*/
/* Função para gerar a tabela de saídas com 30 itens por página
/*--------------------------------------------------------------*/
function tabelaSaidas($s,$r){
  $sql  = "SELECT s.id AS idSaida, p.nomeProduto, s.qtdProduto, m.nomeMotivo, s.dataSaida  FROM saidas s";
  $sql .= " INNER JOIN produtos p ON s.idProduto = p.id";
  $sql .= " INNER JOIN motivosaida m ON s.idMotivo = m.id";
  $sql .= " ORDER BY s.id DESC LIMIT " . $r . " OFFSET " . $s;
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para gerar a tabela de entradas com 30 itens por página
/*--------------------------------------------------------------*/
function tabelaEntradas($s,$r){
  $sql  = "SELECT e.id AS idEntrada, p.nomeProduto, e.qtdProduto, f.nomeMotivo, e.dataEntrada  FROM entradas e";
  $sql .= " INNER JOIN produtos p ON e.idProduto = p.id";
  $sql .= " INNER JOIN motivoentrada f ON e.idMotivo = f.id";
  $sql .= " ORDER BY e.id DESC LIMIT " . $r . " OFFSET " . $s;
  $resultado = executaSql($sql);
  return $resultado;
}

/*--------------------------------------------------------------*/
/* Função para contar o número de páginas necessárias
/*--------------------------------------------------------------*/
function contaPaginacao($rows, $table)
{
  global $db;
  $sql  = "SELECT COUNT(*)";
  $sql .= " FROM " . $table;
  $numrows = executaSql($sql);
  foreach ($numrows as $numrow) {
    $numpag = $numrow[0] / $rows;
  }
  return $numpag;
}

/*--------------------------------------------------------------*/
/* Função para retorno da tabela dos mais vendidos no mês atual
/*--------------------------------------------------------------*/
function maisVendidos($mes,$ano){
  $sql = "SELECT SUM(s.qtdProduto) AS total,p.nomeProduto  FROM saidas s INNER JOIN produtos p ON s.idProduto = p.id WHERE MONTH(s.dataSaida) = " . $mes . " AND YEAR(s.dataSaida) = " . $ano . " GROUP BY s.idProduto ORDER BY  SUM(s.qtdProduto) DESC LIMIT 5";
  $resultado = executaSql($sql);
  return $resultado;
}