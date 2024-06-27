<?php
session_start();
require 'classes/users.class.php';
include 'inc/header.inc.php';

$users = new Users();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $users->buscar($id);
    if (empty($info['email'])) {
        header("Location: /agendaSenac");
        exit;
    }
} else {
    header("Location: /agendaSenac");
    exit;
}
?>

<div class="container">
    <h1 class="jumbotron-heading">Detalhes do Usuário</h1>
    <table class="table table-bordered table-light">
        <tr>
            <th>ID</th>
            <td><?php echo $info['id']; ?></td>
        </tr>
        <tr>
            <th>Nome</th>
            <td><?php echo $info['nome']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $info['email']; ?></td>
        </tr>
        <tr>
            <th>Senha</th>
            <td><?php echo $info['senha']; ?></td>
        </tr>
        <tr>
            <th>Permissões</th>
            <td><?php echo $info['permissoes']; ?></td>
        </tr>
    </table>
    <a class="btn btn-primary" href="gestaoUsuario.php">Voltar</a>
</div>

<?php
include 'inc/footer.inc.php';
?>