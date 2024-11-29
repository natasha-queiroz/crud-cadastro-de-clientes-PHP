<!-- TELA DE VISUALIZAR CLIENTES -->

<?php
require 'conexao.php';
?>
<!doctype html>
<html lang="pt-bt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuário - Visualizar</title>

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
        <h4>Visualização de dados</h4>
        <a href="index.php" class="btn btn-danger">Voltar</a>
      </div>
      <div class="card-body">

        <?php
        // Realiza a visualização do cliente/ SE O ID FOI PASSADO E VISUALIZA O USUARIO ESPECIFICO NO BD/ FUNÇÃO ISSET($_GET['ID']) SE O ID ESTA PRESENTE
        if (isset($_GET['id'])) {
          $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']); //O ID É RECUPERADO USANDO ISSET($_GET['ID']). mysqli_real_escape_stri - PARA SEGURANÇA QUANDO DIGITA OS DADOS COM CARACTERES ESPECIAIS. EVITA ATAQUES
          $sql = "SELECT * FROM usuarios WHERE id='$usuario_id'"; //SELECIONA DADOS DA TABELA/ ARMAZENADA NA VARIAVEL $SQL
          $query = mysqli_query($conexao, $sql); //EXECUTA A CONSULTA SQL NO BANCO E O RESULTADO DA CONSULTA É ARMAZENADA NA VARIAVEL $QUERY
        
         
          if (mysqli_num_rows($query) > 0) {  // Verifica se há registros
            $usuario = mysqli_fetch_array($query); //SE RETORNOU REGISTROS 
        ?>

        <div class="mb-3">
          <label>Nome</label>
          <p class="form-control">
            <?= $usuario['nome']; ?>
          </p>
        </div>

        <div class="mb-3">
          <label>CPF/CNPJ</label>
          <p class="form-control">
            <?= $usuario['cpfcnpj']; ?>
          </p>
        </div>

        <div class="mb-3">
          <label>Endereço</label>
          <p class="form-control">
            <?= $usuario['endereco']; ?>
          </p>
        </div>

        <div class="mb-3">
          <label>Email</label>
          <p class="form-control">
            <?= $usuario['email']; ?>
          </p>
        </div>

        <div class="mb-3">
          <label>Data de Nascimento</label>
          <p class="form-control">
            <?= date('d/m/Y', strtotime($usuario['data_nascimento'])); ?>
          </p>
        </div>

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
