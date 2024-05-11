<?php
session_start(); 
    include 'classes/users.class.php';
    $users = new Users();

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $info = $users->buscar($id);
        if(empty($info['email'])){
            header("Location: /agendaSenac");
            exit;
        }
    }else{
        header("Location: /agendaSenac");
            exit;
    }

    if(!isset($_SESSION['logado'])){
        header("Location: login.php");
        exit;
    }
?>


<h1>EDITAR CONTATO</h1>
 <form method="POST" action="editarUsersSubmit.php">
    <input type ="hidden" name="id" value="<?php echo $info ['id']?>">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info ['nome']?>"/><br><br>
    Email: <br>
    <input type="text" name="email" value="<?php echo $info ['email']?>"/><br><br>
    Senha: <br>
    <input type="text" name="senha" value="<?php echo $info ['senha']?>"/><br><br>
    Pemicoes: <br>
    <input type="text" name="permissoes" value="<?php echo $info ['permissoes']?>"/><br><br>
   
    <input type="submit" name="btCadastrar" value="SALVAR"/>
 </form>
 
 