<?php

require_once 'inc/header.inc.php';

?>
 
 <h1>ADICIONAR CONTATO</h1>

 <form method="POST" action="adicionarContatoSubmit.php">
  <div class="form-group row">
    <label for="nome" class="col-sm-2 col-form-label">Nome</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nome" placeholder="Nome">
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="telefone" placeholder="Senha">
    </div>
  </div>
  <div class="form-group row">
    <label for="numero" class="col-sm-2 col-form-label">Número</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="numero" placeholder="Número">
    </div>
  </div>
  <div class="form-group row">
    <label for="bairro" class="col-sm-2 col-form-label">Bairro</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="bairro" placeholder="Bairro">
    </div>
  </div>
  <div class="form-group row">
    <label for="cep" class="col-sm-2 col-form-label">Cep</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="cep" placeholder="Cep">
    </div>
  </div>
  <div class="form-group row">
    <label for="profissao" class="col-sm-2 col-form-label">Profissão</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="profissao" placeholder="Profissão">
    </div>
  </div>
  <div class="form-group row">
    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="foto" placeholder="Salvar Foto">
    </div>
  </div>
  <div class="form-group row">
    <label for="data_nasc" class="col-sm-2 col-form-label">Data Nasc</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="data_nasc" placeholder="Data Nasc">
    </div>
  </div>
  <input type="submit" name="btCadastrar" value="ADICIONAR"/>
</form>