<?php
session_start();

require_once('classe/usuario.php');
require_once('conexao/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$usuario = new Usuario($db);

if(isset($_POST['logar'])){
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if($usuario->logar($nome, $senha)){
        $_SESSION['nome'] = $nome;

        header("Location: dashboard.php");
        exit();
    }else{
        print "<script>alert('Login invalido')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        body{
            background: MediumSeaGreen;
        }
    </style>
</head>
<body>
<form method="POST">
<div class="mb-3">

  
  <label for="nome" class="col-md-3 offset-md-3">Nome</label>
  <input type="text" class="col-md-3 offset-md-3" name="nome" placeholder="Insira o Nome" > 
</div>
<div class="mb-3">
  <label for="senha" class="col-md-3 offset-md-3">Senha</label>
  <input type="password" class="col-md-3 offset-md-3" name="senha" placeholder="Insira a Senha">
</div>
    <button class="btn btn-primary col-md-3 offset-md-3"  type="submit" name="logar"  >Logar</button>
</form>
    <a class="btn btn-primary col-md-3 offset-md-3" href="cadastrar.php" role="button">Criar Conta</a>
</body>
</html>