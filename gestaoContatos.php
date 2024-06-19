<?php
session_start(); 
require 'classes/contatos.class.php';
include 'inc/header.inc.php';

$contato = new Contatos();



if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

?>

<style type="text/css">
    .row{
        background-color: #ddc;
        padding:10px;
    }
</style>
<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Contatos</h1>
        </div>
    </section>
     <a class="btn btn-primary" href="adicionarContato.php">Adicionar</a>  <br><br>
        <a class="btn btn-primary" href="index.php">Voltar</a>
        <br><br>
            <div class="container">
                <div class ="row align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-dark">
                            <thead class="thead-dark">
                                <tr>
                                      <!--<th>ID </th>-->
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>TELEFONE</th>
                                    <th>CIDADE</th>
                                    <th>RUA</th>
                                    <th>NÚMERO</th>
                                    <th>BAIRRO</th>
                                    <th>CEP</th>
                                    <th>PROFISSÃO</th>
                                    <!--<th>FOTO</th>-->
                                    <th>DATA NASC</th>
                                    <th>AÇÕES</th>
                                </tr>
                         </thead>
                            <tbody>
                                <?php
                                $lista = $contato->listar();
                                foreach ($lista as $item):
                                ?>
                                <tr>
                                     <!--<td><?php //echo $item['id']; ?> </td>-->
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['email']; ?></td>
                                    <td><?php echo $item['telefone']; ?></td>
                                    <td><?php echo $item['cidade']; ?></td>
                                    <td><?php echo $item['rua']; ?></td>
                                    <td><?php echo $item['numero']; ?></td>
                                    <td><?php echo $item['bairro']; ?></td>
                                    <td><?php echo $item['cep']; ?></td>
                                    <td><?php echo $item['profissao']; ?></td>
                                   <!-- <td><?php echo $item['foto']; ?></td>-->
                                    <td><?php echo implode ("/",array_reverse (explode("-",$item['data_nasc'])));?></td>
                                    <td>                                       
                                     <a href="editarContato.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">EDITAR</a>
                                    <a href="excluirContato.php?id=<?php echo $item['id']; ?>" class="btn btn-danger"
                                     onclick="return confirm('Tem certeza que quer excluir este contato?')">EXCLUIR</a>
                                     <a href="verContato.php?id=<?php echo $item['id']; ?>" class="btn btn-info">VER</a>
                                    </td>
                                    
                                </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div> 
            </div>           
</main>

<?php
include 'inc/footer.inc.php';
?>