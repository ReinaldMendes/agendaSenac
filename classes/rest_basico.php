<?php

require 'database.php';

header('Content-Type: application/json');

// Função para enviar resposta JSON
function sendResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

// Função para validar campos obrigatórios
function validateRequiredFields($data, $fields) {
    foreach ($fields as $field) {
        if (empty($data[$field])) {
            sendResponse(['error' => "O campo $field é obrigatório"], 400);
        }
    }
}

// Rota para buscar todos os contatos ou um contato específico
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    try {
        if ($id) {
            $stmt = $conn->prepare('SELECT * FROM contatos WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $conn->query('SELECT * FROM contatos');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        sendResponse($result);
    } catch (PDOException $e) {
        sendResponse(['error' => $e->getMessage()], 500);
    }
}

// Rota para adicionar um novo contato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $requiredFields = ['nome', 'email', 'telefone', 'cidade', 'rua', 'numero', 'bairro', 'cep', 'profissao', 'data_nasc', 'foto'];
    validateRequiredFields($data, $requiredFields);

    try {
        $stmt = $conn->prepare('INSERT INTO contatos (nome, telefone, email, cidade, rua, numero, bairro, cep, profissao, data_nasc, foto) VALUES (:nome, :telefone, :email, :cidade, :rua, :numero, :bairro, :cep, :profissao, :data_nasc, :foto)');
        foreach ($requiredFields as $field) {
            $stmt->bindParam(":$field", $data[$field]);
        }
        $stmt->execute();
        $taskId = $conn->lastInsertId();
        sendResponse(['id' => $taskId] + $data);
    } catch (PDOException $e) {
        sendResponse(['error' => $e->getMessage()], 500);
    }
}

// Rota para atualizar um contato
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
        sendResponse(['error' => 'O ID do contato é obrigatório'], 400);
    }

    $requiredFields = ['nome', 'email', 'telefone', 'cidade', 'rua', 'numero', 'bairro', 'cep', 'profissao', 'data_nasc', 'foto'];

    try {
        $stmt = $conn->prepare('UPDATE contatos SET nome= :nome, telefone= :telefone, email= :email, cidade= :cidade, rua= :rua, numero= :numero, bairro= :bairro, cep= :cep, profissao= :profissao, data_nasc= :data_nasc, foto= :foto WHERE id = :id');
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        foreach ($requiredFields as $field) {
            $stmt->bindParam(":$field", $data[$field]);
        }
        $stmt->execute();
        sendResponse(['success' => true]);
    } catch (PDOException $e) {
        sendResponse(['error' => $e->getMessage()], 500);
    }
}

// Rota para deletar um contato
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
        sendResponse(['error' => 'O ID do contato é obrigatório'], 400);
    }

    try {
        $stmt = $conn->prepare('DELETE FROM contatos WHERE id = :id');
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->execute();
        sendResponse(['success' => true]);
    } catch (PDOException $e) {
        sendResponse(['error' => $e->getMessage()], 500);
    }
}
