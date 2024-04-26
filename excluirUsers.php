<?php
include 'classes/users.class.php';
$users = new Users();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $users->excluir($id);
    header("Location: /agendaSenac/gestaoUsuario.php");
}else{
    echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /agendaSenac");
}