<?php
    include 'classes/contatos.class.php';
    $contato = new Contatos();

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        $info = $contato->buscar($id);
        if(empty($info['email'])){
            header("Location: /agendaSenac");
            exit;
        }
    }else{
        header("Location: /agendaSenac");
            exit;
    }
?>


<h1>EDITAR CONTATO</h1>
 <form method="POST" action="editarContatoSubmit.php">
    <input type ="hidden" name="id" value="<?php echo $info ['id']?>">
    Nome: <br>
    <input type="text" name="nome" value="<?php echo $info ['nome']?>"/><br><br>
    Email: <br>
    <input type="text" name="email" value="<?php echo $info ['email']?>"/><br><br>
    Telefone: <br>
    <input type="text" name="telefone" value="<?php echo $info ['telefone']?>"/><br><br>
    Cidade: <br>
    <input type="text" name="cidade" value="<?php echo $info ['cidade']?>"/><br><br>
    Rua: <br>
    <input type="text" name="rua" value="<?php echo $info ['rua']?>"/><br><br>
    Número: <br>
    <input type="text" name="numero" value="<?php echo $info ['numero']?>"/><br><br>
    Bairro: <br>
    <input type="text" name="bairro" value="<?php echo $info ['bairro']?>"/><br><br>
    Cep: <br>
    <input type="text" name="cep" value="<?php echo $info ['cep']?>"/><br><br>
    Profissão: <br>
    <input type="text" name="profissao" value="<?php echo $info ['profissao']?>"/><br><br>
    Foto: <br>
    <input type="text" name="foto" value="<?php echo $info ['foto']?>"/><br><br>
    Data Nasc: <br>
    <input type="date" name="data_nasc" value="<?php echo $info ['data_nasc']?>"/><br><br>

    <input type="submit" name="btCadastrar" value="SALVAR"/>
 </form>
 
 