<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
    exit;
  }

	//iniciar as variaveis
	$id = $titulo = $data = $numero = $valor = $resumo = $tipo_id = $editora_id = $capa = "";
?>
<div class="container">
	<h1 class="float-left">Cadastro de Quadrinho</h1>
	<div class="float-right">
		<a href="cadastro/quadrinho" class="btn btn-success">Novo Registro</a>
		<a href="listar/quadrinho" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<form name="formCadastro" method="post"
	action="salvar/quadrinho" data-parsley-validate enctype="multipart/form-data">
		<div class="row">
			<div class="col-12 col-md-6">
				<label for="id">ID</label>
				<input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
			</div>

			<div class="col-12 col-md-6">
				<label for="titulo">Título do Quadrinho</label>
				<input type="text" name="titulo" 
				id="titulo" class="form-control"
				required data-parsley-required-message="Por favor, preencha este campo" value="<?=$titulo;?>">
			</div>

			<div class="col-12 col-md-6">
				<label for="tipo_id">Tipo de Quadrinho</label>
				<select name="tipo_id" id="tipo_id"
				class="form-control" required 
				data-parsley-required-message="Selecione uma opção">
					<option value=""></option>
					<?php
					$sql = "select id, tipo from tipo
					order by tipo";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();

					while ( $d = $consulta->fetch(PDO::FETCH_OBJ) ){
						//separar os dados
						$idt 	= $d->id;
						$tipo 	= $d->tipo;

						echo '<option value="'.$idt.'">'.$tipo.'</option>';
					}

					?>
				</select>
			</div>
				
			<div class="col-12 col-md-6"> 
				<label for="editora_id">Editora:</label>
				<select name="editora_id" id="editora_id" class="form-control" required data-parsley-required-message="Selecione um Editora">
					<option value=""></option>
					<?php  
						$sql = "select id, nome from editora order by nome";
						$consulta = $pdo->prepare($sql);
						$consulta->execute();

						while ($d = $consulta->fetch(PDO::FETCH_OBJ)) {
							$ide  = $d->id;
							$nome = $d->nome;

							echo '<option value="'.$ide.'">'.$nome.'</option>';
						}
					?>
				</select>
			</div>

			<div class="col-12 col-md-6">
				<label for="capa">Capa do Quadrinho</label>
				<input type="file" name="capa" id="capa"
				class="form-control" accept=".jpg">
			</div>

			<div class="col-12 col-md-6">
				<label for="numero">Número</label>
				<input type="text" name="numero" id="numero"
				required data-parsley-required-message="Preencha este campo" class="form-control">
			</div>
				
			<div class="col-12 col-md-6">
				<label for="data">Data de Lançamento</label>
				<input type="text" name="data" id="data"
				required data-parsley-required-message="Preencha este campo" class="form-control">
			</div>

			<div class="col-12 col-md-6">
				<label for="valor">Valor</label>
				<input type="text" name="valor" id="valor"
				required data-parsley-required-message="Preencha este campo" class="form-control">
			</div>

			<div class="col-12">
				<label for="resumo">Resumo/Descrição</label>
				<textarea name="resumo" id="resumo" required 
				data-parsley-required-message="Preencha este campo" class="form-control"></textarea>
			</div>	
		</div>
		<button type="submit" class="btn btn-success margin">
			<i class="fas fa-check">Gravar Dados</i> 
		</button>
	</form>

	<hr>

	<?php  
		//verificar se esta sendo editado
		if (!empty($id)) include "cadastro/formQuadrinho.php";
	?>

</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#resumo').summernote();
		$('#valor').maskMoney({
			thousands: ".",
			decimal: ","
		});
		$('#data').inputmask("99/99/9999");
		$('#numero').inputmask("9999");
	});
</script>