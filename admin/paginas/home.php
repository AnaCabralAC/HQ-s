<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["hqs"]["id"] ) ){
    exit;
  }
?>
<div class="container">
	<p class="text-center">Bem Vindo(a) <?=$_SESSION["hqs"]["nome"];?></p>
</div>