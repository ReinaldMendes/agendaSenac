<?php
session_start(); 
    require_once 'inc/header.inc.php';
    include 'classes/contatos.class.php';
    $contato = new Contatos();

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $info = $contato->buscar($id);
        if(empty($info['email'])){
            header("Location: /agendaSenac");
            exit;
        }
    }else{
        header("Location: /agendaSenac");
            exit;
    }

    if(!isset($_SESSION['logado'])){
        header("Location: login.php");
        exit;
    }
?>


<br><br>
        <div class="container">
            <h1 class="jumbotron-heading">Editar Contato</h1>
        </div>
<br> <br>

 <form method="POST" action="editarContatoSubmit.php">
    <input type ="hidden" name="id" value="<?php echo $info ['id']?>">

    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label"><h5>Nome: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control"  name="nome" value="<?php echo $info ['nome']?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><h5>Email: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="email" value="<?php echo $info ['email']?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="profissao" class="col-sm-2 col-form-label"><h5>Profissão: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="profissao" value="<?php echo $info ['profissao']?>"/>    
        </div>
    </div>
    <div class="form-group row">
        <label for="telefone" class="col-sm-2 col-form-label"><h5>Telefone: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="telefone" value="<?php echo $info ['telefone']?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="numero" class="col-sm-2 col-form-label"><h5>Numero: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control"  name="numero" value="<?php echo $info ['numero']?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="rua" class="col-sm-2 col-form-label"><h5>Rua: </h5></label>
        <div class="col-sm-10">
         <input type="text"class="form-control" name="rua" value="<?php echo $info ['rua']?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="bairro" class="col-sm-2 col-form-label"><h5>Bairro: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="bairro" value="<?php echo $info ['bairro']?>"/>
        </div>
    </div>    
    <div class="form-group row">
        <label for="cep" class="col-sm-2 col-form-label"><h5>Cep: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="cep" value="<?php echo $info ['cep']?>"/>
        </div>
    </div>      
    <div class="form-group row">
        <label for="cidade" class="col-sm-2 col-form-label"><h5>Cidade: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="cidade" value="<?php echo $info ['cidade']?>"/>
        </div>
    </div>     
    <div class="form-group row">
        <label for="foto" class="col-sm-2 col-form-label"><h5>Foto: </h5></label>
        <div class="col-sm-10">
         <input type="text" class="form-control" name="foto" value="<?php echo $info ['foto']?>"/>
        </div>
    </div>      
    <div class="form-group row">
        <label for="data_nasc" class="col-sm-2 col-form-label"><h5> Data Nasc: </h5></label>
        <div class="col-sm-10">
         <input type="date" class="form-control" name="data_nasc" value="<?php echo $info ['data_nasc']?>"/>
        </div>
    </div>
    <br> <br>        
  
    <input type="submit" name="btCadastrar" class="btn btn-primary" value="SALVAR"/>
 </form>
 
 