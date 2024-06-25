<?php
header('Content-Type: application/json');

$host = 'localhost'; // endereço do servidor do banco de dados
$db = 'agendasenac'; // nome do banco de dados
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
    $result = $mysqli->query("SELECT id, nome, email, permissoes FROM users");

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
} elseif ($method == 'DELETE') {
    // Método DELETE para excluir um usuário
    parse_str(file_get_contents("php://input"), $delete_vars); // obter dados enviados no corpo da requisição DELETE

    if (isset($delete_vars['id'])) {
        $id = $delete_vars['id'];

        // Executar a exclusão do usuário no banco de dados
        $delete_query = "DELETE FROM users WHERE id = ?";
        $stmt = $mysqli->prepare($delete_query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Usuário excluído com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir usuário.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID do usuário não fornecido para exclusão.']);
    }
} else {
    // Método não permitido para outros métodos além de GET e DELETE
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
}

// Fechar a conexão com o banco de dados
$mysqli->close();
?>
