 <?php
 session_start(); 
 require_once 'inc/header.inc.php';
 if(!isset($_SESSION['logado'])){
   header("Location: login.php");
   exit;
}
 ?>
 
 
 <br><br>
        <div class="container">
            <h1 class="jumbotron-heading">Adicionar Usuario</h1>
        </div>
<br> <br>
 
 <form method="POST" action="adicionarUsersSubmit.php">
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
    <label for="nome" class="col-sm-2 col-form-label"><h5>Senha: </h5></label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="senha" placeholder="digite sua senha">
    </div>
  </div>
  <div class="form-group row">
    <label for="permissoes" class="col-sm-2 col-form-label"><h5> Permissoes: </h5></label>
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="permissoes" value="add">
  <label class="form-check-label" for="inlineCheckbox2">Add</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="permissoes" value="edit">
  <label class="form-check-label" for="inlineCheckbox2">Editar</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="permissoes" value="del" >
  <label class="form-check-label" for="inlineCheckbox3">deletar</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="permissoes" value="super">
  <label class="form-check-label" for="inlineCheckbox2">Super</label>
</div>
</div>
  <br> <br>
  <input type="submit" name="btCadastrar" class="btn btn-primary"  value="Adicionar"/>
</form>
 
