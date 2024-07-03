<?php
session_start();
require 'classes/contatos.class.php';
include 'inc/header.inc.php';

$contato = new Contatos();
if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $info = $contato->buscar($id);
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
    <h1 class="jumbotron-heading">Detalhes de Contato</h1>
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
            <th>Telefone</th>
            <td><?php echo $info['telefone']; ?></td>
        </tr>
        <tr>
            <th>Cidade</th>
            <td><?php echo $info['cidade']; ?></td>
        </tr>
        <tr>
            <th>Rua</th>
            <td><?php echo $info['rua']; ?></td>
        </tr>

        <tr>
            <th>Numero</th>
            <td><?php echo $info['numero']; ?></td>
        </tr>
        <tr>
            <th>Bairro</th>
            <td><?php echo $info['bairro']; ?></td>
        </tr>
        <tr>
            <th>Cep</th>
            <td><?php echo $info['cep']; ?></td>
        </tr>
        <tr>
            <th>Profissao</th>
            <td><?php echo $info['profissao']; ?></td>
        </tr>
        <tr>
            <th>Foto</th>
            <td><?php echo $info['foto']; ?></td>
        </tr>
        <tr>
            <th>Data Nascimento</th>
            <td><?php echo $info['data_nasc']; ?></td>
        </tr>
    </table>
    <a class="btn btn-primary" href="gestaoContatos.php">Voltar</a>
</div>

<?php
include 'inc/footer.inc.php';
?>
                                      