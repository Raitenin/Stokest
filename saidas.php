<?php include_once('includes/load.php'); ?>
<?php verificaNivelAcesso(array(1, 2, 3, 4)); ?>
<?php $titulo_pagina = 'Saídas'; ?>
<?php $produtos = tabelaProdutos(); ?>
<?php $motivosaida = executaSql("SELECT * FROM motivosaida"); ?>
<?php
$pag = $_GET["p"];
$s = 30 * ($pag - 1);
$r = 30;
if ($pag == NULL)
	redirect('saidas.php?p=1', false);

?>
<?php
if (isset($_POST['adicionar_Saida'])) {
	$times = count($_POST['produto']);
	$sql = "INSERT INTO saidas ( `idMotivo`, `dataSaida`, `idProduto`, `qtdProduto`) VALUES";
	for ($i = 0; $i < $times; $i++) {
		$sql .= " ('{$_POST['motivo'][$i]}', NOW() , '{$_POST['produto'][$i]}','{$_POST['qtd'][$i]}'),";
		saidaEstoque($_POST['produto'][$i], (int)$_POST['qtd'][$i]);
	}
	$sql = substr($sql, 0, -1);
	$sql .= ";";
	global $db;
	$result = $db->query($sql);
	if ($result) {
		$session->msg('s', ' Saída Adicionada');
		redirect('saidas.php?p=1', false);
	} else {
		$session->msg('d', ' Falha ao adicionar');
		redirect('saidas.php?p=1', false);
	}
}
?>
<?php include_once('layout/header.php'); ?>
<?php include_once('layout/menu.php'); ?>
<div class="container-fluid">
	<div class="content">
		<section class="section">
			<?php echo display_msg($msg); ?>
			<?php //$s = buscaId("saidas", 117); var_dump($s); ?>
		</section>
		<div class="row">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-header bordered">
						<div class="header-block">
							<h3 class="title"> Adicionar Saída </h3>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
								<label for="Ref">Produto <span style="color:#f00;">*</span></label>
								<select class="form-control mb-2 mr-sm-2" id="produto" required>
									<option value="">Selecione o Produto</option>
									<?php
									foreach ($produtos as $p) : ?>
										<option value="<?php echo $p['id']; ?>">
											<?php echo $p['nomeProduto']; ?>
										</option>

									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-3">
								<label for="valor">Quantidade <span style="color:#f00;">*</span></label>
								<input type="number" class="form-control" id="qtd" placeholder="Quantidade" required>
							</div>
							<div class="col-md-3">
								<label for="Motivo">Motivo <span style="color:#f00;">*</span></label>
								<select class="form-control mb-2 mr-sm-2" id="motivo" required>
									<option value="">Selecione o Motivo</option>
									<?php
									foreach ($motivosaida as $m) : ?>
										<option value="<?php echo $m['id']; ?>">
											<?php echo $m['nomeMotivo']; ?>
										</option>

									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-3">
								<label for="add"> </label><br>
								<a onClick="addRowField()" class="btn btn-success" style="margin-top: 10px; color:white;"><span class="fa fa-plus"></span></a>
							</div>
						</div>
						<hr>
						<h3>Inseridos</h3>
						<form method="post">
							<div class="formulario"></div><br><br>


							<button type="submit" name="adicionar_Saida" class="btn btn-primary">Confirmar Saída</button>
						</form>

					</div>
				</div>
			</div>
		</div>
		</section>
		<section class="section">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-default">
						<div class="card-header bordered">
							<div class="header-block">
								<h3 class="title"> Saídas </h3>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered table-condensed">
								<thead>
									<tr>
										<th class="text-center" style="width: 50px;">ID</th>
										<th>Produto</th>
										<th>Qtd</th>
										<th>Motivo</th>
										<th>Data</th>
										<th>Excluir</th>
									</tr>
								</thead>
								<tbody>
									<?php $saidas = tabelaSaidas($s, $r); ?>
									<?php foreach ($saidas AS $sp) : ?>
										<tr>
											<td><?php echo $sp['idSaida']; ?></td>
											<td><?php echo $sp['nomeProduto']; ?></td>
											<td><?php echo $sp['qtdProduto']; ?></td>
											<td><?php echo $sp['nomeMotivo']; ?></td>
											<td><?php echo date("d/m/Y", strtotime($sp['dataSaida'])); ?></td>
											<td><a href="deletaSaida.php?id=<?php echo $sp['idSaida']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<div class="col-md-12 text-center">
			<nav aria-label="Page navigation">
				<ul class="pagination">
					<?php $paginacao = contaPaginacao($r,"saidas"); ?>
					<?php if((int)$pag>1): ?>
					<li class="page-item"><a class="page-link" href="saidas.php?p=1">1</a></li>
					<li class="page-item"><a class="page-link">...</a></a></li>
					<li class="page-item"><a class="page-link" href="saidas.php?p=<?php echo (int)$pag-1;?>"><?php echo (int)$pag-1;?></a></li>
					<?php endif;?>
					<li class="page-item active"><a  class="page-link"><?php echo (int)$pag;?></a></li>
					<?php if((int)$pag<=$paginacao): ?>
					<li class="page-item"><a class="page-link" href="saidas.php?p=<?php echo (int)$pag+1;?>"><?php echo (int)$pag+1;?></a></li>
					<li class="page-item"><a class="page-link">...</a></li>
					<li class="page-item"><a class="page-link" href="saidas.php?p=<?php echo (int)$paginacao+1;?>"><?php echo (int)$paginacao+1;?></a></li>
					<?php endif;?>
				</ul>
			</nav>
			</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<script>
	function addRowField() {
		var qtd = $('#qtd').val();
		var motivo = $('#motivo').val();
		var motivotxt = $('#motivo option:selected').text();
		var produto = $('#produto').val();
		var produtotxt = $('#produto option:selected').text();
		$('<div class="row"><div class="col-md-3"><select class="form-control" name="produto[]" readonly="true"><option value="' + produto + '">' + produtotxt + '</option></select></div><div class="col-md-3"><input type="text" value="' + qtd + '" name="qtd[]" class="form-control" /></div><div class="col-md-3"><select class="form-control" name="motivo[]" readonly="true"><option value="' + motivo + '">' + motivotxt + '</option></select></div><div class="col-md-3"><a onClick="$(this).closest(\'.row\').remove();" class="btn btn-danger" style="color:white;"><span class="fa fa-minus"></span></a></div></div>').appendTo('.formulario');

	}

	function removeRowField() {
		$(this).closest('div').remove();
	}
</script>
<?php include 'layout/footer.php' ?>