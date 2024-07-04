<?php
session_start(); 
require_once 'classes/users.class.php';
$users = new Users();
if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}
$users->setUsers($_SESSION['logado']);
$nomeUsuario = $users->getNomeUsuario();

include 'inc/header.inc.php';
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
    <h1> SEJA BEM VINDO <?php echo htmlspecialchars($nomeUsuario); ?>, À PARTE ADMINISTRATIVA </h1>
    <h1> ESCOLHA UMA DAS OPÇÕES </h1>
  </div>
<ul>
<?php if ($users->temPermissoes('super') || $users->temPermissoes('del') ):?> <li> <a class="btn btn-primary" href="gestaoUsuario.php">Gestão de Usuário</a></li><?php endif;?><br>
<?php if ($users->temPermissoes('add')):?><li> <a class="btn btn-primary" href="gestaoContatos.php">Gestão de Contatos</a></li><?php endif;?><br>
</ul>
    </div>
</div>

<?php
include 'inc/footer.inc.php';
?>