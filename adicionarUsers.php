 <?php
 session_start(); 
 ?>
 
 
 <h1>ADICIONAR CONTATO</h1>
 <form method="POST" action="adicionarUsersSubmit.php">
    Nome: <br>
    <input type="text" name="nome"/><br><br>
    Email: <br>
    <input type="text" name="email"/><br><br>
    Senha: <br>
    <input type="password" name="senha"/><br><br>
    Permissoes: <br>
    <input type="text" name="permissoes"/><br><br>
   
    <input type="submit" name="btCadastrar" value="ADICIONAR"/>
 </form>
 
 