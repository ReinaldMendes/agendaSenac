<?php
session_start();

include 'inc/header.inc.php';

// Função para buscar informações do usuário pelo ID na API
function api_get_user($id) {
    $url = 'http://localhost/agendasenaccopia/classes/api.php/users/' . $id; // Endpoint para obter usuário por ID
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
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

// Verificar se o método da requisição é GET e se foi passado um ID válido
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar informações do usuário da API
    $api_response = api_get_user($id);

    if ($api_response !== false && isset($api_response['data'])) {
        $info = $api_response['data'];
        $arrayperm = isset($info['permissoes']) ? explode(",", $info['permissoes']) : array();
    } else {
        echo "Erro ao obter informações do usuário da API.";
        exit;
    }

    ?>
    
    <br><br>
    <div class="container">
        <h1 class="jumbotron-heading">Editar Usuário</h1>
    </div>
    <br><br>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo isset($info['id']) ? $info['id'] : ''; ?>">
    
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label"><h5>Nome: </h5></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nome" value="<?php echo isset($info['nome']) ? htmlspecialchars($info['nome']) : ''; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label"><h5>Email: </h5></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="<?php echo isset($info['email']) ? htmlspecialchars($info['email']) : ''; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="senha" class="col-sm-2 col-form-label"><h5>Senha: </h5></label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="senha" value="<?php echo isset($info['senha']) ? htmlspecialchars($info['senha']) : ''; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="permissoes" class="col-sm-2 col-form-label"><h5>Permissões: </h5></label><br>
            <div class="checkbox">
                <input type="checkbox" name="permissoes[]" id="add" value="add" <?php if (in_array('add', $arrayperm)) echo 'checked'; ?>>
                <label for="add"><h5>Adicionar</h5></label>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="permissoes[]" id="edit" value="edit" <?php if (in_array('edit', $arrayperm)) echo 'checked'; ?>>
                <label for="edit"><h5>Editar</h5></label>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="permissoes[]" id="del" value="del" <?php if (in_array('del', $arrayperm)) echo 'checked'; ?>>
                <label for="del"><h5>Deletar</h5></label>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="permissoes[]" id="super" value="super" <?php if (in_array('super', $arrayperm)) echo 'checked'; ?>>
                <label for="super"><h5>Super</h5></label>
            </div>
        </div>
    
        <br><br>
        <input type="submit" name="btSalvar" class="btn btn-primary" value="Salvar"/>
    </form>

    <?php
    include 'inc/footer.inc.php';
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se foram recebidos dados via POST
    if (isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['permissoes'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $permissoes = implode(",", $_POST['permissoes']);
        
        // Dados a serem atualizados na API
        $data = array(
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'permissoes' => $permissoes
        );
        
        // Função para atualizar usuário na API
        $api_response = api_update_user($data);
        
        if ($api_response !== false && isset($api_response['status']) && $api_response['status'] === 'success') {
            // Atualização bem-sucedida
            echo "<div class='container'><br><br><div class='alert alert-success' role='alert'>Usuário atualizado com sucesso.</div></div>";
        } else {
            // Erro ao atualizar usuário
            echo "<div class='container'><br><br><div class='alert alert-danger' role='alert'>Erro ao atualizar usuário.</div></div>";
        }
        
        include 'inc/footer.inc.php';
        exit;
    } else {
        // Campos não foram preenchidos corretamente
        echo "<div class='container'><br><br><div class='alert alert-danger' role='alert'>Por favor, preencha todos os campos.</div></div>";
        include 'inc/footer.inc.php';
        exit;
    }
} else {
    // Redirecionar para página inicial se não foi enviado ID via GET e não é um POST válido
    header("Location: index.php");
    exit;
}
?>
