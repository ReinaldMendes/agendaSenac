<?php
require 'classes/contatos.class.php';
$contato = new Contatos();

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id_contato = $contato->excluirFoto($_GET['id']);
}
if(isset($id_contato)){
    header("Location: editarcontato.php?id=".$id_contato);
}else{
    header("Location: index.php");
}