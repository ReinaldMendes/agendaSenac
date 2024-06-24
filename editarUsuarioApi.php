<?php
session_start();

include 'inc/header.inc.php';

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

// Função para fazer requisições PUT usando cURL
function api_put($endpoint, $data) {
    $url = 'http://localhost/agendasenaccopia/classes/api.php' . $endpoint;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => http_build_query($data),
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

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $user_data = api_get('/users/' . $user_id);

    if ($user_data === false) {
        echo "Erro ao obter dados do usuário.";
        exit;
    }
} else {
    echo "ID do usuário não fornecido.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $permissoes = $_POST['permissoes'];

    $update_data = [
        'nome' => $nome,
        'email' => $email,
        'permissoes' => $permissoes
    ];

    $update_response = api_put('/users/' . $user_id, $update_data);

    if ($update_response !== false) {
        echo "Usuário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar usuário.";
    }
}
?>

<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Editar Usuário</h1>
        </div>
    </section>

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <a class="btn btn-primary" href="index.php">Voltar</a>
                <br><br>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo isset($user_data['data']['nome']) ? htmlspecialchars($user_data['data']['nome']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user_data['data']['email']) ? htmlspecialchars($user_data['data']['email']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="permissoes">Permissões</label>
                        <input type="text" class="form-control" id="permissoes" name="permissoes" value="<?php echo isset($user_data['data']['permissoes']) ? htmlspecialchars($user_data['data']['permissoes']) : ''; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include 'inc/footer.inc.php';
?>
