<?php
session_start();

include 'inc/header.inc.php';

// Função para fazer requisição GET usando cURL para obter dados do usuário
function api_get_user($id) {
    $url = 'http://localhost/agendasenaccopia/classes/api.php/users/' . $id;
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

// Função para fazer requisição PUT usando cURL para editar usuário
function api_put_user($data) {
    $id = $data['id'];
    $url = 'http://localhost/agendasenaccopia/classes/api.php/users/' . $id;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => http_build_query($data)
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
    if (isset($decoded['success']) && $decoded['success']) {
        return true;
    } else {
        echo "Erro ao atualizar usuário: " . $decoded['message'];
        return false;
    }
}

// Verifica se o ID do usuário foi fornecido via GET
if (!isset($_GET['id'])) {
    echo "ID do usuário não fornecido.";
    exit;
}

// Obtém os dados do usuário da API
$id = $_GET['id'];
$user_data = api_get_user($id);

// Verifica se obteve os dados do usuário corretamente
if (!$user_data) {
    echo "Erro ao obter dados do usuário.";
    exit;
}

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se todos os campos necessários foram enviados
    if (!isset($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['permissoes'])) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Dados do usuário a serem atualizados
    $data = array(
        'id' => $_POST['id'],
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => $_POST['senha'],
        'permissoes' => implode(',', $_POST['permissoes']) // Converte array de permissões para string
    );

    // Faz a requisição PUT para a API para atualizar o usuário
    $update_success = api_put_user($data);

    if ($update_success) {
        echo "Usuário atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar usuário.";
    }
}
?>

<style type="text/css">
    .row {
        background-color: #ddc;
        padding: 10px;
    }
</style>

<main>
    <section class="jumbotron text-black-50 text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Editar Usuário</h1>
        </div>
    </section>

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <form method="POST" action="editarUsuarioApi.php">
                    <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">
                    <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label"><h5>Nome:</h5></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nome" value="<?php echo $user_data['nome']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label"><h5>Email:</h5></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="<?php echo $user_data['email']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="senha" class="col-sm-2 col-form-label"><h5>Senha:</h5></label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="senha" value="<?php echo $user_data['senha']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="permissoes" class="col-sm-2 col-form-label"><h5>Permissões:</h5></label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <input type="checkbox" name="permissoes[]" id="add" value="add" <?php echo in_array('add', explode(',', $user_data['permissoes'])) ? 'checked' : ''; ?>>
                                <label for="add"><h5>Adicionar</h5></label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="permissoes[]" id="edit" value="edit" <?php echo in_array('edit', explode(',', $user_data['permissoes'])) ? 'checked' : ''; ?>>
                                <label for="edit"><h5>Editar</h5></label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="permissoes[]" id="del" value="del" <?php echo in_array('del', explode(',', $user_data['permissoes'])) ? 'checked' : ''; ?>>
                                <label for="del"><h5>Deletar</h5></label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="permissoes[]" id="super" value="super" <?php echo in_array('super', explode(',', $user_data['permissoes'])) ? 'checked' : ''; ?>>
                                <label for="super"><h5>Super</h5></label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="btCadastrar" class="btn btn-primary" value="SALVAR"/>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include 'inc/footer.inc.php';
?>
