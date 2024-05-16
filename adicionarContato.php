<?php

require_once 'inc/header.inc.php';
session_start(); 
if(!isset($_SESSION['logado'])){
  header("Location: login.php");
  exit;
}
?>

 <br><br>
        <div class="container">
            <h1 class="jumbotron-heading">Adicionar Contato</h1>
        </div>
<br> <br>
 <form method="POST" action="adicionarContatoSubmit.php">
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label"><h5>Nome: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" placeholder="Nome">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label"><h5>Email: </h5></label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="profissao" class="col-sm-2 col-form-label"><h5>Profissão: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="profissao" placeholder="Profissão">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefone" class="col-sm-2 col-form-label"><h5>Telefone: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone" placeholder="telefone">
    </div>
  </div>
  <div class="form-group row">
    <label for="numero" class="col-sm-2 col-form-label"><h5>Número: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="numero" placeholder="Número">
    </div>
  </div>
  <div class="form-group row">
    <label for="rua" class="col-sm-2 col-form-label"><h5>Rua: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="rua" placeholder="Rua">
    </div>
  </div>
  <div class="form-group row">
    <label for="bairro" class="col-sm-2 col-form-label"><h5>Bairro: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="bairro" placeholder="Bairro">
    </div>
  </div>
  <div class="form-group row">
    <label for="cep" class="col-sm-2 col-form-label"><h5>Cep: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cep" placeholder="Cep">
    </div>
  </div>
  <div class="form-group row">
    <label for="cidade" class="col-sm-2 col-form-label"><h5>Cidade: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cidade" placeholder="Cidade">
    </div>
  </div>
  <div class="form-group row">
    <label for="foto" class="col-sm-2 col-form-label"><h5>Foto: </h5></label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="foto" placeholder="Salve sua foto">
    </div>
  </div>
  <div class="form-group row">
    <label for="data_nasc" class="col-sm-2 col-form-label"><h5>Data Nasc: </h5></label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="data_nasc" placeholder="Data Nasc">
    </div>
  </div>
  <br> <br>
  <input type="submit" name="btCadastrar" class="btn btn-primary"  value="Adicionar"/>
</form>