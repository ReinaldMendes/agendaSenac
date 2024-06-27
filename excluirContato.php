<?php
session_start();

if (!isset($_SESSION['logado'])) {
    header("Location: login.php");
    exit;
}

// Função para fazer requisições DELETE usando cURL
function api_delete($id) {
    $url = 'http://localhost/agendasenac/classes/rest_basico.php';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_POSTFIELDS => json_encode(['id' => $id]),
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = api_delete($id);

    if ($result !== false && isset($result['success'])) {
        header("Location: gestaoContatos.php");
        exit;
    } else {
        echo "Erro ao excluir o contato.";
    }
} else {
    echo "ID do contato não fornecido.";
}
?>
