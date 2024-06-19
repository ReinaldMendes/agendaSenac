<?php
header('Content-Type: application/json');

$host = 'localhost'; // endereço do servidor do banco de dados
$db = 'agenda'; // nome do banco de dados
$user = 'root'; // nome de usuário do banco de dados
$pass = ''; // senha do banco de dados

// Conectar ao banco de dados
$mysqli = new mysqli($host, $user, $pass, $db);

// Verificar a conexão
if ($mysqli->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Falha na conexão com o banco de dados']));
}

// Verificar o método da solicitação
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Consultar a tabela de usuários
    $result = $mysqli->query("SELECT id, nome, email, permissoes FROM usuarios");

    if ($result->num_rows > 0) {
        $users = [];

        // Obter os dados dos usuários
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        // Retornar os dados em formato JSON
        echo json_encode(['success' => true, 'data' => $users]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nenhum usuário encontrado']);
    }
} else {
    // Método não permitido
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>
