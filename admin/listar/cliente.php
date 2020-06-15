<?php  
	//verificar se esta logado
	if (!isset($_SESSION["hqs"]["id"])) {
		exit;
	}
?>

<div class="container">
	<h1 class="float-left">Lista de Cliente</h1>
	<div class="float-right">
		<a href="cadastro/cliente" class="btn btn-success">Novo Registro</a>
		<a href="listar/cliente" class="btn btn-info">Listar Registro</a>
	</div>

	<div class="clearfix"></div>

	<table class="table table-striped table-bordered table-hover" id="tabela">
		<thead>
			<tr>
				<td>ID</td>
				<td>Foto</td>
				<td>Nome</td>
				<td>Data Nascimento</td>
				<td>E-mail</td>
				<td>Celular</td>
				<td>Opções</td>
			</tr>
		</thead>
		<tbody>
			<?php 
				$sql = "select id, nome, date_format(datanascimento, '%d/%m/%Y') as datanascimento, email, foto, celular from cliente";
				$consulta = $pdo->prepare($sql);
				$consulta->execute();

				while ($dados = $consulta->fetch(PDO::FETCH_OBJ)) {
					$id         = $dados->id;
                	$nome       = $dados->nome;
                	$email      = $dados->email;
                	$foto       = $dados->foto;
                	$nascimento = $dados->datanascimento;
                	$celular    = $dados->celular; 

                	echo '<tr>
                		  	<td>'.$id.'</td>
                		  	<td><img src="../fotos/'.$foto.'p.jpg" 
                		  		alt="'.$nome.'" width="70px"></td>
                		  	<td>'.$nome.'</td>
                		  	<td>'.$nascimento.'</td>
		                    <td>'.$email.'</td>
		                    <td>'.$celular.'</td>

		                    <td>
		                    	<a href="cadastro/cliente/'.$id.'" class="btn btn-success btn-sm">
									<i class="fas fa-edit"></i>
								</a>
		                    </td>
                		  </tr>
                	';
				}
			?>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function() {
		$('#tabela').DataTable();
	})
</script>