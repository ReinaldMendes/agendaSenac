<?php
include 'classes/users.class.php';
$users = new Users();
if(!empty($_POST['id'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permicoes = $_POST['permicoes'];
    $id = $_POST['id'];
    if(!empty($email)){
        $users->editar( $nome, $email, $senha, $permicoes, $id);
    }

    header('Location: /agendaSenac/gestaoUsuario.php');

}

?>