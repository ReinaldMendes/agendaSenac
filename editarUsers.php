<?php
session_start(); 
    require_once 'inc/header.inc.php';
    include 'classes/users.class.php';
    $users = new Users();

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $info = $users->buscar($id);
        if(empty($info['email'])){
            header("Location: /agendaSenac");
            exit;
        }

        $arrayperm = explode(",", $info['permissoes']);

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

 <form method="POST" action="editarUsersSubmit.php">
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
        <label for="senha" class="col-sm-2 col-form-label"><h5>Senha: </h5></label>
        <div class="col-sm-10">
         <input type="password" class="form-control" name="senha" value="<?php echo $info ['senha']?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for ="permissoes" class="col-sm-2 col-form-label"><h5> Permissões: </h5> </label><br>
        <div class="checkbox">
        <?php if($users->buscaPermissaoAdd($arrayperm)):?>
        <input type="checkbox" name="pemissoes[]" id="add" value="add" checked/>
        <label for="add" ><h5>Adicionar: </h5></label>
        <?php endif;?>
        </div>
        <div class="checkbox">
        <?php if(empty($users->buscaPermissaoAdd($arrayperm))):?>
        <input type="checkbox" name="pemissoes[]" id="add" value="add"/>
        <label for="add" ><h5>Adicionar: </h5></label>
        <?php endif;?>        
        </div>
        <div class="checkbox">
        <?php if($users->buscaPermissaoEdit($arrayperm)):?>
        <input type="checkbox" name="pemissoes[]" id="edit" value="edit" checked/>
        <label for="edit" ><h5>Editar: </h5></label>
        <?php endif;?>
        </div>
        <div class="checkbox">
        <?php if(empty($users->buscaPermissaoEdit($arrayperm))):?>
        <input type="checkbox" name="pemissoes[]" id="edit" value="edit"/>
        <label for="edit" ><h5>Editar: </h5></label>
        <?php endif;?>
        <div>
        
        
        <div class="checkbox">
        <?php if($users->buscaPermissaoDel($arrayperm)):?>
        <input type="checkbox" name="pemissoes[]" id="del" value="del" checked/>
        <label for="del"><h5>Deletar: </h5></label>
        <?php endif;?>
        </div>
        <div class="checkbox">
        <?php if(empty($users->buscaPermissaoDel($arrayperm))):?>
        <input type="checkbox" name="pemissoes[]" id="del" value="del"/>
        <label for="del"><h5>Deletar: </h5></label>
        <?php endif;?>
        </div>
       
        <div class="checkbox">
        <?php if($users->buscaPermissaoSuper($arrayperm)):?>
        <input type="checkbox" name="pemissoes[]" id="super" value="super" checked/>
        <label for="super" ><h5>Super: </h5></label>
        <?php endif;?>
        </div>
        <div class="checkbox">
        <?php if(empty($users->buscaPermissaoSuper($arrayperm))):?>
        <input type="checkbox" name="pemissoes[]" id="super" value="super"/>
        <label for="super" ><h5>Super: </h5></label>
        <?php endif;?>
        </div>
       
    </div>
    
  <br> <br>
    <input type="submit" name="btCadastrar" class="btn btn-primary" value="SALVAR"/>
 </form>