<?php
include 'classes/contatos.class.php';
$contato = new Contatos();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $contato->excluir($id);
    header("Location: /agendaSenac");
}else{
    echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
    header("Location: /agendaSenac");
}