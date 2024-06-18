<?php
header('Content-Type: application/json');

require_once 'conexao.class.php';

try {
    $conexao = new Conexao();
    $pdo = $conexao->conectar();

    $stmt = $pdo->query('SELECT * FROM users');
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
