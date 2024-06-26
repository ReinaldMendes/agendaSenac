<?php

require 'database.php';

// Rota para buscar todos os contatos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (empty($_GET)) {
        try {
            $stmt = $conn->query('SELECT * FROM contatos');
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        $data = json_decode(file_get_contents('php://input'), true);
        try {
            $stmt = $conn->query('SELECT * FROM contatos WHERE id=' . $data['id']);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (PDOException $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

// Rota para adicionar um novo contato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $requiredFields = ['nome', 'email', 'telefone', 'cidade', 'rua', 'numero', 'bairro', 'cep', 'profissao', 'datanasc', 'foto'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            echo json_encode(['error' => "O campo $field é obrigatório"]);
            exit;
        }
    }

    $nome = $data['nome'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $cidade = $data['cidade'];
    $rua = $data['rua'];
    $numero = $data['numero'];
    $bairro = $data['bairro'];
    $cep = $data['cep'];
    $profissao = $data['profissao'];
    $datanasc = $data['datanasc'];
    $foto = $data['foto'];

    try {
        $stmt = $conn->prepare('INSERT INTO contatos (nome, telefone, email, cidade, rua, numero, bairro, cep, profissao, datanasc, foto) VALUES (:nome, :telefone, :email, :cidade, :rua, :numero, :bairro, :cep, :profissao, :datanasc, :foto)');
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':profissao', $profissao);
        $stmt->bindParam(':datanasc', $datanasc);
        $stmt->bindParam(':foto', $foto);
        
        $stmt->execute();
        $taskId = $conn->lastInsertId();
        echo json_encode(['id' => $taskId, 'nome' => $nome, 'telefone' => $telefone, 'email' => $email, 'cidade' => $cidade, 'rua' => $rua, 'numero' => $numero, 'bairro' => $bairro, 'cep' => $cep, 'profissao' => $profissao, 'datanasc' => $datanasc, 'foto' => $foto]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// Rota para atualizar um contato
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
        echo json_encode(['error' => 'O ID do contato é obrigatório']);
        exit;
    }

    // tratar campos nulos
    $id = $data['id'];
    $nome = $data['nome'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $cidade = $data['cidade'];
    $rua = $data['rua'];
    $numero = $data['numero'];
    $bairro = $data['bairro'];
    $cep = $data['cep'];
    $profissao = $data['profissao'];
    $datanasc = $data['datanasc'];
    $foto = $data['foto'];

    try {
        $stmt = $conn->prepare('UPDATE contatos SET nome= :nome, telefone= :telefone, email= :email, cidade= :cidade, rua= :rua, numero= :numero, bairro= :bairro, cep= :cep, profissao= :profissao, datanasc= :datanasc, foto= :foto WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':profissao', $profissao);
        $stmt->bindParam(':datanasc', $datanasc);
        $stmt->bindParam(':foto', $foto);

        $stmt->execute();
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

// Rota para deletar um contato
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
        echo json_encode(['error' => 'O ID do contato é obrigatório']);
        exit;
    }

    $id = $data['id'];

    try {
        $stmt = $conn->prepare('DELETE FROM contatos WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
