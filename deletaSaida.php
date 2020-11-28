<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2)); ?>
<?php
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
	$s = buscaId("saidas", $id);
	if ($s) {
		$sql = "DELETE FROM saidas WHERE id = " . $id;
		global $db;
		if ($db->query($sql)) {
			entradaEstoque($s['idProduto'], $s['qtdProduto']);
			$session->msg("s", "Saída excluída");
			redirect("saidas.php?p=1", false);
		}
	}
} else {
	$session->msg("d", "Erro ao encontrar a saída");
	redirect("saidas.php?p=1", false);
}


?>
