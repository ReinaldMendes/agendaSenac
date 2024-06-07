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
<div class="checkbox">
    <label><input type="checkbox" name="permissoes[]" id="ADD" value="add" /> Add </label>
</div>
<div class="checkbox">
    <label><input type="checkbox" name="permissoes[]" id="EDIT" value="edit" />Editar</label>
</div>
<div class="checkbox">
    <label><input type="checkbox" name="permissoes[]" id="DEL" value="del" />Deletar</label>
</div>
<div class="checkbox">
    <label><input type="checkbox" name="permissoes[]" id="SUPER" value="super" />Super</label>
</div>

</div>
  <br> <br>
  <input type="submit" name="btCadastrar" class="btn btn-primary"  value="Adicionar"/>
</form>

