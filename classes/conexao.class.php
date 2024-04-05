<?php   //não precisa fechar o php porque não terá html nem css, por isso não precisa fecha a tag do PHP
//Fabrica de conexões(connection factory)

class Conexao {  //no php a classe é criada com letra maíuscula por padrão
    private $usuario;
    private $senha;
    private $banco;
    private $servidor;
    private static $pdo; //é static porque não pode ser alterado
    
    public function __construct(){
        $this->servidor = "localhost";  //o this está chamando os atributos definidos na classe
        $this->banco = "agendasenac";
        $this->usuario = "root";
        $this->senha = "";

    }
    public function conectar(){
        try{
            if(is_null(self::$pdo)){
        self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
            }
       //echo "conectou!!";
        return self::$pdo;
        } catch(PDOException $ex){
            echo $ex->getMessage();
        }


    }

}