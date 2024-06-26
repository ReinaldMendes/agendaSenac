<?php
session_start();

include 'inc/header.inc.php';

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

function api_update_user($id, $data) {
    $url = 'http://localhost/agendasenaccopia/classes/api.php/users/' . $id; // Endpoint para atualizar usuário por ID
    $data_string = json_encode($data);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ),
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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar informações do usuário da API
    $api_response = api_get_user($id);

    if ($api_response !== false && isset($api_response['data'])) {
        $info = $api_response['data'];
        $arrayperm = isset($info['permissoes']) ? explode(",", $info['permissoes']) : [];
    } else {
        echo "Erro ao obter informações do usuário da API.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $permissoes = implode(",", $_POST['permissoes']);

    // Preparar os dados para atualização
    $data = array(
        'nome' => $nome,
        'email' => $email,
        'senha' => $senha,
        'permissoes' => $permissoes
    );

    // Atualizar as informações do usuário na API
    $api_response = api_update_user($id, $data);

    if ($api_response !== false && isset($api_response['success']) && $api_response['success']) {
        echo "<div class='alert alert-success'>Usuário atualizado com sucesso.</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar usuário.</div>";
    }
}

?>

<br><br>
<div class="container">
    <h1 class="jumbotron-heading">Editar Usuário</h1>
</div>
<br><br>

<form method="POST" action="editarUsuarioApi.php">
    <input type="hidden" name="id" value="<?php echo isset($info['id']) ? $info['id'] : ''; ?>">

    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label"><h5>Nome: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nome" value="<?php echo isset($info['nome']) ? $info['nome'] : ''; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label"><h5>Email: </h5></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" value="<?php echo isset($info['email']) ? $info['email'] : ''; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="senha" class="col-sm-2 col-form-label"><h5>Senha: </h5></label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="senha" value="<?php echo isset($info['senha']) ? $info['senha'] : ''; ?>"/>
        </div>
    </div>
    <div class="form-group row">
        <label for="permissoes" class="col-sm-2 col-form-label"><h5>Permissões: </h5></label><br>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="add" value="add" <?php if (isset($arrayperm) && in_array('add', $arrayperm)) echo 'checked'; ?>>
            <label for="add"><h5>Adicionar</h5></label>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="edit" value="edit" <?php if (isset($arrayperm) && in_array('edit', $arrayperm)) echo 'checked'; ?>>
            <label for="edit"><h5>Editar</h5></label>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="del" value="del" <?php if (isset($arrayperm) && in_array('del', $arrayperm)) echo 'checked'; ?>>
            <label for="del"><h5>Deletar</h5></label>
        </div>
        <div class="checkbox">
            <input type="checkbox" name="permissoes[]" id="super" value="super" <?php if (isset($arrayperm) && in_array('super', $arrayperm)) echo 'checked'; ?>>
            <label for="super"><h5>Super</h5></label>
        </div>
    </div>

    <br><br>
    <input type="submit" name="btSalvar" class="btn btn-primary" value="Salvar"/>
</form>

<?php
include 'inc/footer.inc.php';
?>
