<?php
session_start();

include 'inc/header.inc.php';

// Função para fazer requisições GET usando cURL
function api_get($endpoint) {
    $url = 'http://localhost/agendasenac/classes/rest_basico.php' . $endpoint;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    
    if ($response === false) {
        echo "Erro ao acessar a API: " . curl_error($curl);
        return false;
    }
    
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_code >= 400) {
        echo "Erro HTTP $http_code ao acessar a API.";
        echo "Resposta da API: " . $response;
        return false;
    }
    
    curl_close($curl);
    
    $decoded = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Erro ao decodificar JSON: " . json_last_error_msg();
        echo "Resposta da API: " . $response;
        return false;
    }
    
    return $decoded;
}

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}
?>

<style type="text/css">
    .row {
        background-color: #ddc;
        padding: 10px;
    }
</style>

<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Contatos</h1>
        </div>
    </section>

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <a class="btn btn-primary" href="adicionarContato.php">Adicionar</a><br><br>
                <a class="btn btn-primary" href="index.php">Voltar</a><br><br>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>NOME</th>
                                <th>EMAIL</th>
                                <th>TELEFONE</th>
                                <th>CIDADE</th>
                                <th>RUA</th>
                                <th>NÚMERO</th>
                                <th>BAIRRO</th>
                                <th>CEP</th>
                                <th>PROFISSÃO</th>
                                <th>FOTO</th>
                                <th>DATA NASC</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $api_response = api_get('');
                            if ($api_response !== false && is_array($api_response)) {
                                foreach ($api_response as $item):
                            ?>
                                <tr>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['email']; ?></td>
                                    <td><?php echo $item['telefone']; ?></td>
                                    <td><?php echo $item['cidade']; ?></td>
                                    <td><?php echo $item['rua']; ?></td>
                                    <td><?php echo $item['numero']; ?></td>
                                    <td><?php echo $item['bairro']; ?></td>
                                    <td><?php echo $item['cep']; ?></td>
                                    <td><?php echo $item['profissao']; ?></td>
                                    <td><img src="<?php echo $item['foto']; ?>" alt="<?php echo $item['nome']; ?>" width="50" height="50"></td>
                                    <td><?php echo implode("/", array_reverse(explode("-", $item['data_nasc']))); ?></td>
                                    <td>
                                        <a href="editarContato.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">EDITAR</a>
                                        <a href="excluirContato.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este contato?')">EXCLUIR</a>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            } else {
                                echo '<tr><td colspan="12">Erro ao obter contatos da API.</td></tr>';
                            }
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
