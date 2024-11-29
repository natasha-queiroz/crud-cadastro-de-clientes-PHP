<!-- TELA EDITAR -->

<?php
session_start();
require 'conexao.php';
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuário - Editar</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-image: linear-gradient( #49a09d, #5f2c82);
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      width: 100%;
      max-width: 600px;
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
    }

    .card-header {
      background: #34495e;
      color: #fff;
      padding: 10px 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .card-header h4 {
      margin: 0;
      font-size: 1.2rem;
    }

    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      color: #fff;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-danger {
      background: #e74c3c;
    }

    .btn-danger:hover {
      background: #c0392b;
    }

    .btn-primary {
      background: #3498db;
    }

    .btn-primary:hover {
      background: #2980b9;
    }

    .card-body {
      padding: 20px;
    }

    .mb-3 {
      margin-bottom: 15px;
    }

    .mb-3 label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #34495e;
    }

    .form-control {
      display: block;
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      background-color: #f9f9f9;
      font-size: 0.9rem;
      color: #333;
    }

    .form-control:focus {
      outline: none;
      border-color: #3498db;
    }
  </style>
</head>
<body>
  
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>Editar dados</h4>
        <a href="index.php" class="btn btn-danger">Voltar</a>
      </div>
      <div class="card-body">

        <?php
        if (isset($_GET['id'])) {
          $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
          $sql = "SELECT * FROM usuarios WHERE id='$usuario_id'";
          $query = mysqli_query($conexao, $sql);

          if (mysqli_num_rows($query) > 0) { //conta o número de registros retornados pela consulta. Se o valor for maior que zero, significa que o banco de dados encontrou um usuário com o id
            $usuario = mysqli_fetch_array($query); //esultados da consulta e a armazena na variável $usuario como um array.
        ?>

        <form action="acoes.php" method="POST">
          <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">
          
          <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" value="<?= $usuario['nome'] ?>" class="form-control">
          </div>

          <div class="mb-3">
            <label>CPF/CNPJ</label>
            <input type="number" name="cpfcnpj" value="<?= $usuario['cpfcnpj'] ?>" class="form-control">
          </div>

          <div class="mb-3">
            <label>Endereço</label>
            <input type="text" name="endereco" value="<?= $usuario['endereco'] ?>" class="form-control">
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="text" name="email" value="<?= $usuario['email'] ?>" class="form-control">
          </div>                 

          <div class="mb-3">
            <label>Data de Nascimento</label>
            <input type="date" name="data_nascimento" value="<?= $usuario['data_nascimento'] ?>" class="form-control">
          </div>

          <div class="mb-3">
            <button type="submit" name="update_usuario" class="btn btn-primary">Salvar</button>
          </div>
        </form>

        <?php
          } else {
            echo "<h5>Usuário não encontrado</h5>";
          }
        }
        ?>

      </div>
    </div>
  </div>

</body>
</html>
