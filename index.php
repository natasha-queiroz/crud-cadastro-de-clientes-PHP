<!-- arquivo de conexão -->
<?php
require 'conexao.php';
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Usuários</title>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  h2 {
    margin: 10px;
    text-align: center;
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
    max-width: 1200px;
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  .card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
  }

  .card-header {
    background: #34495e;
    color: #fff;
    padding: 10px 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
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

  .btn-primary {
    background: #3498db;
  }

  .btn-primary:hover {
    background: #2980b9;
  }

  .btn-danger {
    background: #e74c3c;
  }

  .btn-danger:hover {
    background: #c0392b;
  }

  .btn-secondary {
    background: #7f8c8d;
  }

  .btn-secondary:hover {
    background: #606b70;
  }

  .btn-success {
    background: #2ecc71;
  }

  .btn-success:hover {
    background: #27ae60;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  table, th, td {
    border: 1px solid #ddd;
  }

  th, td {
    padding: 10px;
    text-align: left;
  }

  th {
    background: #f4f4f4;
  }

  tr:nth-child(even) {
    background: #f9f9f9;
  }

  tr:hover {
    background: #f1f1f1;
  }

  .d-inline {
    display: inline;
  }
</style>
</head>
<body>

<div class="container">
<a href="usuario-create.php" class="btn btn-primary">Cadastre-se aqui</a>
<h2>Cadastro de Clientes</h2>
  <div class="card">
    <div class="card-header">
      <h4>Lista de Clientes</h4>
      
    </div>
    <div class="card-body">
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF/CNPJ</th>
            <th>Endereço</th>
            <th>Email</th>
            <th>Data Nascimento</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>

          <!-- CONSULTA/ dados dos usuários
           traz todos os usuários cadastrados. A variável $usuarios vai conter essa lista de usuários.-->
          <?php
          $sql = 'SELECT * FROM usuarios';
          $usuarios = mysqli_query($conexao, $sql);
          if (mysqli_num_rows($usuarios) > 0) {
            foreach ($usuarios as $usuario) { // PERCORRE OS USUARIOS
          ?>

          <!-- Preenchendo a tabela com os dados dos usuários
           *COMEÇA A PERCORRER OS USUARIOS, PARA CADA USUARIO ELE PREENCHE AS LINHAS DA TABELA  -->
          <tr>
            <!--  -->
            <td><?= $usuario['id'] ?></td> <!--está inserindo o valor da chave 'id' do array $usuario (que contém os dados do usuário -->
            <td><?= $usuario['nome'] ?></td> <!-- MOSTRA O NOME, VALOR É RETIRADO DO ARRAY $USUARIO-->
            <td><?= $usuario['cpfcnpj'] ?></td>
            <td><?= $usuario['endereco'] ?></td>
            <td><?= $usuario['email'] ?></td>
            <td><?= date('d/m/Y', strtotime($usuario['data_nascimento'])) ?></td> <!-- STRTORIME - CONVERTE A DATA QUE ESTA NO BD-->
            <td>
              <a href="usuario-view.php?id=<?= $usuario['id'] ?>" class="btn btn-secondary btn-sm">Visualizar</a> <!--LEVA PRA PROXIMA PAGINA-->
              <a href="usuario-edit.php?id=<?= $usuario['id'] ?>" class="btn btn-success btn-sm">Editar</a>

            <!--envia uma requisição POST para o arquivo acoes.php para excluir o usuário. -->
              <form action="acoes.php" method="POST" class="d-inline">
                <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?= $usuario['id'] ?>" class="btn btn-danger btn-sm">Excluir</button>
              </form>
            </td>
          </tr>
          <?php
            }
          } else {
            echo '<tr><td colspan="7">Nenhum cliente encontrado</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
