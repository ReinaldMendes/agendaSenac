<?php
include 'classes/users.class.php';
$users = new Users();
if(!empty($_POST['id'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes = implode(',', $_POST['permissoes']);
    $id = $_POST['id'];
    if(!empty($email)){
        $users->editar( $nome, $email, $senha, $permissoes, $id);
    }

    header('Location: /agendaSenac/gestaoUsuario.php');

}

?>