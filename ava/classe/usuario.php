<?php
include('conexao/conexao.php');

$db = new Conexao();

class Usuario{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function cadastrar($nome,$email,$senha, $confSenha)
    {
        if($senha === $confSenha){
            $emailExistente = $this->verificarEmailExistente($email);
            $nomeExistente = $this->verificarNomeexistente($nome);
            if($emailExistente || $nomeExistente){
                print "<script> alert('Email e Nome já cadastrado')</script>";
                return false;
            }
            
        $SenhaCriptografada = password_hash($senha, PASSWORD_DEFAULT); 

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (? ,? ,? )";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1,$nome);
        $stmt->bindValue(2,$email);
        $stmt->bindValue(3,$SenhaCriptografada);

        $result = $stmt->execute();
        
        return $result;
    }else{
        return false;
    }
    }

    private function verificarNomeexistente($nome){
        $sql = "SELECT COUNT(*) FROM usuario WHERE nome = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,$nome);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    private function verificarEmailExistente($email){
        $sql = "SELECT COUNT(*) FROM usuario WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,$email);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function logar($nome, $senha){
        $sql = "SELECT * FROM usuario WHERE nome = :nome";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':nome',$nome);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha,$usuario['senha'])){
                return true;
            }
        }
        return false;
    }
}

?>