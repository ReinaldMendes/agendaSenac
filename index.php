<?php
session_start(); 
include 'inc/header.inc.php';



if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

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
    <li> <a class="btn btn-primary" href="gestaoUsuario.php">Gestão de Usuário</a>  </li><br>
    <li> <a class="btn btn-primary" href="gestaoContatos.php">Gestão de Contatos</a> </li><br>
</ul>
    </div>
</div>

<?php
include 'inc/footer.inc.php';
?>