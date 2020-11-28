<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2)); ?>
<?php
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$e = buscaId("entradas", $id);
	if ($e) {
		$sql = "DELETE FROM entradas WHERE id = " . $id;
		global $db;
		if ($db->query($sql)) {
			saidaEstoque($e['idProduto'], $e['qtdProduto']);
			$session->msg("s", "Entrada excluída");
			redirect("entradas.php?p=1", false);
		}
	}
} else {
	$session->msg("d", "Erro ao encontrar a entrada");
	redirect("entradas.php?p=1", false);
}


?>
