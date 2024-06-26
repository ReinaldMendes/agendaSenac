<?php
session_start();

// Função para fazer requisições DELETE usando cURL
function api_delete($endpoint) {
    $url = 'http://localhost/agendasenac/classes/rest_basico.php' . $endpoint;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
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

// Verifica se foi passado o ID do contato para exclusão
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Endpoint da API para excluir contato
    $endpoint = '/contatos?id=' . $id;

    // Realiza a requisição DELETE na API
    $api_response = api_delete($endpoint);

    if ($api_response !== false && isset($api_response['success']) && $api_response['success']) {
        // Redireciona para a página de gestão de contatos após exclusão
        header("Location: /agendaSenac/gestaoContatos.php");
    } else {
        echo '<script type="text/javascript">alert("Erro ao excluir contato!");</script>';
        header("Location: /agendaSenac/gestaoContatos.php");
    }
} else {
    echo '<script type="text/javascript">alert("ID do contato não especificado!");</script>';
    header("Location: /agendaSenac/gestaoContatos.php");
}
?>
