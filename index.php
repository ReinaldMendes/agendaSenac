<?php
session_start(); 
include 'inc/header.inc.php';
require 'classes/contatos.class.php';
require 'classes/users.class.php';


if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}
$contato = new Contatos();
$users = new Users();
//$users->setUsers($_SESSION['logado']);
?>
<style>
body {
    background-color: #ccc;
    
  }

  h1 {
    text-align: center; /* Centraliza o conteúdo na horizontal */
  }
</style>
<h1>AGENDA SENAC</h1>

<br><br>
<div class="container-fluid">
  <div class="jumbotron"> 
    <h1> SEJA BEM VINDO A PARTE ADMINISTRATIVA </h1>
    <h1> ESCOLHA UMA DAS OPÇÕES </h1>
</div>
<ul>
    <li> <button><a href="gestaoUsuario.php">Gestão de Usuário</a></button> </li>
    <li> <button><a href="gestaoContatos.php">Gestão de Contatos</a> </button></li>
    <li><button> <a href="#">Gestão de Sub-Área</a> </button></li>
    <li><button><a href="#">Gestão de Conteúdos</a> </button></li>
  </ul>
    
  </div>
</div>

<?php
include 'inc/footer.inc.php';
?>