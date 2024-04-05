<?php
include 'classes/contatos.class.php';
$contato = new Contatos();
if(!empty($_POST['email'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cidade = $_POST['cidade'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cep= $_POST['cep'];
    $profissao = $_POST['profissao'];
    $foto = $_POST['foto'];

    $contato->adicionar($email, $nome, $telefone, $cidade, $rua, $numero, $bairro, $cep, $profissao, $foto);
    header('Location: index.php');

}else{
    echo '<script type= "text/javascript">alert("Email já cadastrado!!");</script>';
}
?>