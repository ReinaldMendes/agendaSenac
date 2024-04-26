<?php
include 'classes/users.class.php';
include 'inc/header.inc.php';
$users = new Users();
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
            <h1 class="jumbotron-heading">Usuarios</h1>
        </div>
    </section>
        <a class="btn btn-primary" href="adicionarUsers.php">Adicionar</a>
        <br><br>
            <div class="container">
                <div class ="row align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-dark">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>EMAIL</th>
                                    <th>SENHA</th>
                                    <th>PERMICOES</th>
                                    <th>AÇÕES</th>
                                </tr>
                         </thead>
                            <tbody>
                                <?php
                                $lista = $users->listar();
                                foreach ($lista as $item):
                                ?>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['email']; ?></td>
                                    <td><?php echo $item['senha']; ?></td>
                                    <td><?php echo $item['permicoes']; ?></td>
                                    <td>
                                        <a href="editarUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">EDITAR</a>
                                        <a href="excluirUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este contato?')">EXCLUIR</a>
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