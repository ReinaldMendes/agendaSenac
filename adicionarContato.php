<?php
session_start();

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

// Função para fazer requisições POST usando cURL
function api_post($data) {
    $url = 'http://localhost/agendasenac/classes/rest_basico.php';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        )
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'nome' => $_POST['nome'],
        'email' => filter_var($_POST['email'], FILTER_VALIDATE_EMAIL),
        'telefone' => preg_match('/^\(\d{2}\) \d{4,5}-\d{4}$/', $_POST['telefone']) ? $_POST['telefone'] : null,
        'cidade' => $_POST['cidade'],
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'bairro' => $_POST['bairro'],
        'cep' => preg_match('/^\d{5}-\d{3}$/', $_POST['cep']) ? $_POST['cep'] : null,
        'profissao' => $_POST['profissao'],
        'data_nasc' => $_POST['data_nasc'],
        'foto' => filter_var($_POST['foto'], FILTER_VALIDATE_URL)
    ];

    // Verificando se todos os campos estão válidos
    if (in_array(null, $data, true)) {
        echo "Erro ao adicionar o contato: Verifique os campos.";
    } else {
        $result = api_post($data);
        if ($result !== false && isset($result['id'])) {
            header("Location: gestaoContatos.php");
            exit;
        } else {
            echo "Erro ao adicionar o contato.";
        }
    }
}

include 'inc/header.inc.php';
?>

<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Adicionar Contato</h1>
        </div>
    </section>

    <div class="container">
        <form method="POST" action="adicionarContato.php">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" pattern="\(\d{2}\) \d{4,5}-\d{4}" required>
                <small>Formato: (xx) xxxx-xxxx ou (xx) xxxxx-xxxx</small>
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" required>
            </div>
            <div class="form-group">
                <label for="rua">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" required>
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" pattern="\d{5}-\d{3}" required>
                <small>Formato: xxxxx-xxx</small>
            </div>
            <div class="form-group">
                <label for="profissao">Profissão</label>
                <input type="text" class="form-control" id="profissao" name="profissao" required>
            </div>
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento</label>
                <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto (URL)</label>
                <input type="url" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a class="btn btn-secondary" href="gestaoContatos.php">Voltar</a>
        </form>
    </div>
</main>

<?php
include 'inc/footer.inc.php';
?>
