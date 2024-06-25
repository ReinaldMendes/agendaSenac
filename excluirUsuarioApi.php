<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // ID do usuário a ser excluído
    $id = $_GET['id'];

    // Fazer requisição DELETE para a API para excluir usuário
    $url = 'http://localhost/agendasenaccopia/classes/api.php/users/' . $id;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE'
    ));
    $response = curl_exec($curl);

    if ($response === false) {
        echo "Erro ao acessar a API: " . curl_error($curl);
    } else {
        $decoded = json_decode($response, true);
        if (isset($decoded['success']) && $decoded['success']) {
            echo "Usuário excluído com sucesso.";
            // Redirecionar para a página GestaoUsuarioapi após a exclusão
            header("Location: gestaoUsuarioApi.php");
            exit;
        } else {
            echo "Erro ao excluir usuário: " . $decoded['message'];
        }
    }

    curl_close($curl);
} else {
    echo "ID do usuário não fornecido.";
}
?>
