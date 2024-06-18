<?php
session_start();
require 'classes/client.php';
include 'inc/header.inc.php';

// Função para fazer requisições GET usando cURL

// Função para fazer requisições GET usando cURL
function api_get($endpoint) {
    $url = 'http://localhost/agendasenaccopia/classes/api.php' . $endpoint;
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
        // Exibir resposta da API para debug
        echo "Resposta da API: " . $response;
        return false;
    }
    
    curl_close($curl);
    
    // Verificar se a resposta é um JSON válido
    $decoded = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Erro ao decodificar JSON: " . json_last_error_msg();
        echo "Resposta da API: " . $response;
        return false;
    }
    
    return $decoded;
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
            <h1 class="jumbotron-heading">Usuários</h1>
        </div>
    </section>

    
        <a class="btn btn-primary" href="adicionarUsers.php">Adicionar</a>
    
    <br><br>
    <a class="btn btn-primary" href="index.php">Voltar</a>
    <br><br>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>EMAIL</th>
                                <th>PERMISSÕES</th>
                                <th>AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Obter lista de usuários da API
                            $api_response = api_get('/users');
                            if (isset($api_response['success']) && $api_response['success'] && isset($api_response['data'])) {
                                $lista = $api_response['data'];
                                foreach ($lista as $item):
                            ?>
                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><?php echo $item['nome']; ?></td>
                                    <td><?php echo $item['email']; ?></td>
                                    <td><?php echo $item['permissoes']; ?></td>
                                    <td>
                                       
                                            <a href="editarUsers.php?id=" class="btn btn-warning">EDITAR</a>
                                        
                                        
                                            <a href="excluirUsers.php?id=<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que quer excluir este usuário?')">EXCLUIR</a>
                                     
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            } else {
                                echo '<tr><td colspan="5">Erro ao obter usuários da API.</td></tr>';
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
