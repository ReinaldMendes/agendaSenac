
<?php
session_start(); 
require_once 'inc/header.inc.php';
include 'classes/users.class.php';
$users = new Users();

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $users->buscar($id);
    if (empty($info['email'])) {
        header("Location: /agendaSenac");
        exit;
    }

    $arrayperm = explode(",", $info['permissoes']);
} else {
    header("Location: /agendaSenac");
    exit;
}

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
?>

<br><br>
<div class="container">
    <h1 class="jumbotron-heading">Editar Contato</h1>
</div>
<br><br>

<form method="POST" action="editarUsersSubmit.php">
    <input type="hidden" name="id" value="<?php echo $info['id']; ?>">

    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label"><h5>Nome: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nome" value="<?php echo $info['nome']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><h5>Email: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" value="<?php echo $info['email']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label"><h5>Senha: </h5></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="senha" value="<?php echo $info['senha']; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="permissoes" class="col-sm-2 col-form-label"><h5>Permissões: </h5></label><br>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="add" value="add" <?php if ($users->buscaPermissaoAdd($arrayperm)) echo 'checked'; ?>/>
            <label for="add"><h5>Adicionar: </h5></label>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="edit" value="edit" <?php if ($users->buscaPermissaoEdit($arrayperm)) echo 'checked'; ?>/>
            <label for="edit"><h5>Editar: </h5></label>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="del" value="del" <?php if ($users->buscaPermissaoDel($arrayperm)) echo 'checked'; ?>/>
            <label for="del"><h5>Deletar: </h5></label>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="super" value="super" <?php if ($users->buscaPermissaoSuper($arrayperm)) echo 'checked'; ?>/>
            <label for="super"><h5>Super: </h5></label>
        </div>
    </div>

    <br><br>
    <input type="submit" name="btCadastrar" class="btn btn-primary" value="SALVAR"/>
</form>
