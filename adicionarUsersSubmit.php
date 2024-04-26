<?php
include 'classes/users.class.php';
$users = new Users();
if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['senha'];
    $cidade = $_POST['permicoes'];


    $users->adicionar($email, $nome, $senha, $permicoes);
    header('Location: gestaoUsuario.php');

}else{
    echo '<script type= "text/javascript">alert("Email já cadastrado!!");</script>';
}
?>