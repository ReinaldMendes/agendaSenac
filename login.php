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
<br> <br>
<link rel="stylesheet" href="css/style-login.css">
<head>
<div class="login-container">
    <h1>LOGIN</h1>

    <form method="POST">
        <div>
            <label for="email"> Usuário: </label>
            <input type="text" name="email" placeholder="Digite seu email">
        </div>
        <div>
            <label for="senha">Senha: </label>
            <input type="password"  name="senha" placeholder="Digite sua senha">
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>
</div>
</head>


<?php
include 'inc/footer.inc.php';
?>