<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
    exit;
  }

  //verificar se o id esta vazio
  if ( empty ( $id ) ) {
  	echo "<script>alert('Não foi possível excluir o registro');history.back();</script>";
  	exit;
  }


  
  //verificar se existe um quadrinho cadastrado com esta editora
  $sql = "select id from tipo where editora_id = ? limit 1";
  //prepare sql para executar
  $consulta = $pdo->prepare($sql);
  //passar o id do parametro
  $consulta->bindParam(1, $id);
  //executar o sql
  $consulta->execute();
  //recuperar os dados selecionados
  $dados = $consulta->fetch(PDO::FETCH_OBJ);
  
  //var_dump($consulta);

  //se existir avisar e voltar
  if ( !empty ( $dados->id ) ) {
  	//se o id não está vazio, não posso excluir
  	echo "<script>alert('Não é possível excluir este registro, pois existe um quadrinho relacionado');history.back();</script>";
  	exit;
  }

  //excluir tipo quadrinho
  $sql = "delete from tipo where id = ? limit 1";
  $consulta = $pdo->prepare($sql);
  $consulta->bindParam(1, $id);
  //verificar se não executou
  if ( !$consulta->execute() ) {

  	//capturar os erros e mostra a mensagem na tela
  	echo $consulta->errorInfo()[2];

  	echo "<script>alert('Erro ao excluir');javascript:history.back();</script>";
  	exit;
  } 

  //redirecionar para a listagem de editoras
  echo '<script>alert("Tipo de quadrinho excluido com sucesso");location.href="listar/tipo";</script>';
