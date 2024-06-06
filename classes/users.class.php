<?php
require 'conexao.class.php';  //para poder usar a classe conexao pelo banco de dados
class Users {
	//id	nome	email	senha	permicoes
    private $id;
    private $nome ;
    private $email; 
	private $senha; 
	private	$permissoes; 
	

    private $con;

    public function __construct(){  // underline duplo considerado um comando mágico, ou seja, tem uma carta na manga pra facilitar a programação
        $this->con = new Conexao();
    }

    public function __set($atributo,$valor){
        $this->atributo = $valor;
    }
    public function __get($atributo){
        return $this->atributo;
    }
    
    //vamos fazer uma validação pelo email, que é um atributo único, assim evitamos que haja duplicidade no cadastro de usuário
    private function existeEmail($email){
        $sql = $this->con->conectar()->prepare("SELECT id FROM users WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();  //comando fetch retorna o valor que está no banco de dados, email no caso

        }else{
            $array = array();
        }
        return $array;
    }  //	id	nome	email	senha	permicoes
    public function adicionar($email, $nome, $senha, $permissoes){
        $emailExistente = $this->existeEmail($email);
        if(count($emailExistente) == 0){
            try{
                $this->nome = $nome;
                $this->email = $email;
                $this->senha = $senha;
                $this->permissoes = $permissoes;
                
                $sql = $this->con->conectar()->prepare("INSERT INTO users(nome, email, senha, permissoes)
                    VALUES(:nome, :email, :senha, :permissoes)");
                    $sql->bindParam(":nome", $this->nome, PDO::PARAM_STR);
                    $sql->bindParam(":email", $this->email, PDO::PARAM_STR);
                    $sql->bindParam(":senha", $this->senha, PDO::PARAM_STR);
                    $sql->bindParam(":permissoes", $this->permissoes, PDO::PARAM_STR);

                    $sql->execute();
                return TRUE;

            }catch(PDOException $ex){
                return 'ERRO: '.$ex->getMessage();
            }

            
        }else{
            return FALSE;
        }

    }  
    public function listar(){
        try{
            $sql = $this->con->conectar()->prepare("SELECT id, nome, email, senha, permissoes FROM users");
            $sql->execute(); 
            return $sql->fetchAll();           

        }catch(PDOException $ex){
            return 'ERRO: '.$ex->getMessage();
        }
    }
    public function buscar ($id){
        try{
            $sql = $this->con->conectar()->prepare("SELECT * FROM users WHERE id = :id");
            $sql->bindValue(':id',$id);
            $sql->execute(); 
            if($sql->rowCount()>0){
                return $sql->fetch(); 
            }else{
                return array();
            }            

        }catch(PDOException $ex){
            echo"ERRO";
        }
    }
    public function editar( $nome,$email, $senha, $permissoes, $id){
        $emailExistente = $this->existeEmail($email);
        if(count ($emailExistente )> 0 && $emailExistente['id']!=$id){
            return FALSE;
        }else{
            try{
                $sql = $this->con->conectar()->prepare("UPDATE users SET nome = :nome, email= :email, senha = :senha, 
                permissoes = :permissoes WHERE id = :id ");
                $sql->bindValue(':nome', $nome); 
                $sql->bindValue(':email', $email); 
                $sql->bindValue(':senha', $senha); 
                $sql->bindValue(':permissoes', $permissoes);  
                $sql->bindValue(':id', $id); 
                $sql->execute();
                return TRUE;           
    
            }catch(PDOException $ex){
                echo'ERRO: '.$ex->getMessage();
            }
        }

    }
    public function excluir($id){
        $sql = $this->con->conectar()->prepare("DELETE FROM users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }
    public function fazerLogin($email,$senha){
        $sql = $this->con->conectar()->prepare("SELECT * FROM users WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if ($sql->rowCount () > 0){
            $sql = $sql->fetch();
            $_SESSION["logado"]= $sql['id'];

            return TRUE;
        }
        return FALSE;
    }
    public function setUsers($id){
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM users WHERE id = :id");
        $sql ->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount()>0){
            $sql = $sql->fetch();
            $this->permissoes = explode(',',$sql['permissoes']);//transforma em array (add,edit,del,super)
        }
    }
    public function getPermissoes(){
        return $this->permissoes;

    }
    public function temPermissoes($p){
         if(in_array($p, $this->permissoes)){
            return TRUE;
         }else{
                return FALSE;
            }
    }
    public function buscaPermissaoAdd($arrayperm){
        foreach($arrayperm as $item){
            if($item ==  "ADD"){
                return TRUE;
            }
        }
    }
    public function buscaPermissaoEdit($arrayperm){
        foreach($arrayperm as $item){
            if($item ==  "EDIT"){
                return TRUE;
            }
        }
    }
    public function buscaPermissaoDel($arrayperm){
        foreach($arrayperm as $item){
            if($item ==  "DEL"){
                return TRUE;
            }
        }
    }
    public function buscaPermissaoSuper($arrayperm){
        foreach($arrayperm as $item){
            if($item == "SUPER"){
                return TRUE;
            }
        }
    }

}
