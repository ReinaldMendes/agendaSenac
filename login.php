<?php
session_start(); 
require_once 'inc/header.inc.php';
require 'classes/users.class.php';

if(!empty($_POST ['email'])){
    $email = addslashes($_POST ['email']);
    $senha = md5($_POST['senha']);

    $users = new Users ();

    if($users->fazerLogin($email,$senha)){
        header("Location: index.php");
        exit;
    }else{
        echo '<span style="color: green">'."Usuário e/ou senha incorretos!".'</span>';
    }

}
?>
<h1>LOGIN</h1>
<form method="POST"> 
    Email: <br>
    <input type="email" name="email" placeholder="Digite seu email"> <br> <br>
    Senha: <br>
    <input type="password" name="senha" placeholder="Digite sua senha"> <br> <br>
    <input type="submit" value ="Entrar">

<?php
include 'inc/footer.inc.php';
?>