<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<h1 class="float-left">Listar Tipo de Quadrinho</h1>
	<div class="float-right">
		<a href="cadastro/tipo" class="btn btn-success">Novo Registro</a>
		<a href="listar/tipo" class="btn btn-info">Listar Registros</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover" id="tabela">
		<thead>
			<tr>
				<td>ID</td>
				<td>Tipo de Quadrinho</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php
				//buscar as editoras alfabeticamente
				$sql = "select * from tipo 
				order by tipo";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
					//separar os dados
					$id 	= $dados->id;
					$tipo 	= $dados->tipo;

					//mostrar na tela
					echo '<tr>
						<td>'.$id.'</td>
						<td>'.$tipo.'</td>
						<td>
							<a href="cadastro/tipo/'.$id.'" class="btn btn-success btn-sm">
								<i class="fas fa-edit"></i>
							</a>

							<a href="javascript:excluir('.$id.')" class="btn btn-danger btn-sm">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>';
				}
			?>
		</tbody>
	</table>
</div>

<script>
	//Perguntar se deseja mesmo excluir o Tipo de Quadrinho
	//Se desejar, sera direcionado para o enreço de exclusão
	function excluir(id){
		if (confirm("Deseja mesmo excluir?")) {
			//endereço de exclusãõ
			location.href="excluir/tipo/"+id;
		}
	}

	$(document).ready(function(){
		$('#tabela').DataTable({
			"language": {
	            "lengthMenu": "Mostrando _MENU_ registros por páginas",
	            "zeroRecords": "Nenhum registro encontrado",
	            "info": "Mostrando páginas _PAGE_ de _PAGES_",
	            "infoEmpty": "No records available",
	            "infoFiltered": "(filtered from _MAX_ total records)",
	            "search": "Busca"
        	}
		});
	})
</script>