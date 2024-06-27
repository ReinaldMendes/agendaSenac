<?php
include 'classes/users.class.php';
$users = new Users();

if (!empty($_POST['id'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id = $_POST['id'];

    // Verifique se "permissoes" está definido e é um array
    if (isset($_POST['permissoes']) && is_array($_POST['permissoes'])) {
        $permissoes = implode(',', $_POST['permissoes']);
    } else {
        $permissoes = ''; // Defina um valor padrão se "permissoes" não estiver definido ou não for um array
    }

    // Se a senha não estiver vazia, criptografe-a usando MD5
    if (empty($senha)) {
        $senha = md5($senha);
    } else {
        // Caso a senha esteja vazia, mantenha a senha existente no banco de dados
        $currentInfo = $users->buscar($id);
        $senha = $currentInfo['senha'];
    }

    if (!empty($email)) {
        $users->editar($nome, $email, $senha, $permissoes, $id);
    }

    header('Location:/agendaSenac/gestaoUsuario.php');
    exit; // Certifique-se de chamar exit após o redirecionamento para parar a execução do script
} else {
    echo '<script type="text/javascript">alert("ID do usuário não fornecido!");</script>';
}
?>