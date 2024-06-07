<?php
include 'classes/users.class.php';
$users = new Users();
if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $permissoes = implode(",", $_POST['permissoes']);


    $users->adicionar($email, $nome, $senha, $permissoes);
    header('Location: gestaoUsuario.php');

}else{
    echo '<script type= "text/javascript">alert("Email já cadastrado!!");</script>';
}
?>