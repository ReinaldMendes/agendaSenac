<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se todos os campos necessários foram enviados
    if (!isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['permissoes'])) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Dados do novo usuário
    $data = array(
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => $_POST['senha'],
        'permissoes' => $_POST['permissoes']
    );

    // Fazer requisição POST para a API para adicionar usuário
    $url = 'http://localhost/agendasenaccopia/classes/api.php/users';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($data)
    ));
    $response = curl_exec($curl);

    if ($response === false) {
        echo "Erro ao acessar a API: " . curl_error($curl);
    } else {
        $decoded = json_decode($response, true);
        if (isset($decoded['success']) && $decoded['success']) {
            echo "Usuário adicionado com sucesso.";
        } else {
            echo "Erro ao adicionar usuário: " . $decoded['message'];
        }
    }

    curl_close($curl);
}
?>
