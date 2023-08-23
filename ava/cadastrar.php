<?php
require_once('classe/usuario.php');
require_once('conexao/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$usuario = new Usuario($db);

    if(isset($_POST['cadastrar'])){
        $nome = $_POST['nome'];
        $email =  $_POST['email'];
        $senha =  $_POST['senha'];
        $confSenha =  $_POST['confSenha'];

        if($usuario->cadastrar($nome,$email,$senha,$confSenha)){
            print "<script>alert ('Cadastro realizado com sucesso')</script>";
        }else{
            print "<script>alert ('Erro ao cadastrar!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
  <label for="Nome" class="form-label ">Nome de Usuario</label>
  <input type="text" class="form-control "  name="nome" placeholder="Insira o Nome">
</div>

<div class="mb-3">
  <label for="email" class="form-label ">Email</label>
  <input type="email" class="form-control "  name="email" placeholder="Insira o E-mail">
</div>

<div class="mb-3">
  <label for="senha" class="form-label ">Senha</label>
  <input type="password" class="form-control "  name="senha" placeholder="deve conter caracteres especiais,letras e numeros" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" required />
</div>

<div class="mb-3">
  <label for="confSenha" class="form-labe ">Confirmar senha</label>
  <input type="password" class="form-control "  name="confSenha">
</div>
<button class="btn btn-primary " type="submit" name="cadastrar">Cadastrar</button>
    </form>
    <a class="btn btn-primary " href="index.php" role="button">Voltar para tela de login</a>
</body>
</html>