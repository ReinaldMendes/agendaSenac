<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes = isset($_POST['permissoes']) ? $_POST['permissoes'] : [];

    // Dados que serão enviados para a API
    $data = array(
        'id' => $id,
        'nome' => $nome,
        'email' => $email,
        'senha' => $senha,
        'permissoes' => implode(',', $permissoes)  // Convertendo array de permissões para string separada por vírgula
    );

    // Convertendo array para JSON
    $json_data = json_encode($data);

    // Iniciando a sessão cURL
    $ch = curl_init();

    // URL da API para atualizar usuário específico
    $url = "http://localhost/agendasenaccopia/classes/api.php/users/{$id}";

    // Configurando as opções do cURL para uma requisição PUT
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $json_data,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data)
        ),
    ));

    // Executando a requisição cURL
    $response = curl_exec($ch);

    // Verificando se houve algum erro
    if ($response === false) {
        echo "Erro ao acessar a API: " . curl_error($ch);
    } else {
        // Exibindo a resposta da API (pode ser necessário tratar como JSON dependendo da resposta esperada)
        echo "Resposta da API: " . $response;
    }

    // Fechando a sessão cURL
    curl_close($ch);

    // Redirecionando de volta para a página principal ou outra página após a atualização
    header("Location: gestaoUsuarioApi.php");
    exit;
} else {
    // Caso não seja uma requisição POST válida, redireciona para a página principal
    header("Location: index.php");
    exit;
}
?>
