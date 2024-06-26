<?php
session_start();

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

// Função para fazer requisições POST usando cURL
function api_post($endpoint, $data) {
    $url = 'http://localhost/agendasenac/classes/rest_basico.php' . $endpoint;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array('Content-Type: application/json')
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
        'email' => $_POST['email'],
        'profissao' => $_POST['profissao'],
        'telefone' => $_POST['telefone'],
        'numero' => $_POST['numero'],
        'rua' => $_POST['rua'],
        'bairro' => $_POST['bairro'],
        'cep' => $_POST['cep'],
        'cidade' => $_POST['cidade'],
        'foto' => $_POST['foto'],
        'datanasc' => $_POST['data_nasc']
    ];
    
    $api_response = api_post('', $data);
    
    if ($api_response !== false) {
        header("Location: gestaoContatos.php");
        exit;
    } else {
        echo "Erro ao adicionar contato.";
    }
}
?>
