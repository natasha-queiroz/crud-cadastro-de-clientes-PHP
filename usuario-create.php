<?php
session_start();
require 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Usuário</title>
  <link rel="stylesheet" href="styles.css">
  <style>
   
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-image: linear-gradient(#49a09d, #5f2c82);
  color: #333;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 20px;
}

/* Container principal */
.container {
  width: 100%;
  max-width: 400px;
}

/* Card */
.card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 50px;
}

.titulo {
  text-align: center;
  font-size: 1.5rem;
  margin-bottom: 20px;
  /* color: #333; */
}

/* Mensagem de alerta */
.alert {
  background-color: #f8d7da;
  color: #721c24;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 15px;
  font-size: 0.9rem;
}

/* Formulário */
.form-group {
  margin-bottom: 15px;
}

label {
  font-size: 1rem;
  margin-bottom: 5px;
  display: block;
  /* color: #555; */
}

input {
  width: 100%;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

input:focus {
  outline: none;
  border-color: #49a09d;
  box-shadow: 0 0 5px rgba(73, 160, 157, 0.5);
}

/* Botões */
.botoes {
  display: flex;
  justify-content: space-between;
  gap: 10px;
  margin-top: 20px;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  background-color: #49a09d;
  color: #fff;
  font-size: 1rem;
  cursor: pointer;
  text-decoration: none;
  text-align: center;
}

.btn:hover {
  background-color: #3e8986;
}

.btn-secundario {
  background-color: #ccc;
  color: #333;
}

.btn-secundario:hover {
  background-color: #b3b3b3;
}

  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h1 class="titulo">Cadastrar Usuário</h1>
      <form id="userForm" action="acoes.php" method="POST">
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" id="nome" placeholder="Digite seu nome">
        </div>

        <div class="form-group">
          <label for="cpfcnpj">CPF/CNPJ</label>
          <input type="text" name="cpfcnpj" id="cpfcnpj" placeholder="Digite seu CPF/CNPJ">
        </div>

        <div class="form-group">
          <label for="endereco">Endereço</label>
          <input type="text" name="endereco" id="endereco" placeholder="Digite seu endereço">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Digite seu email">
        </div>

        <div class="form-group">
          <label for="data_nascimento">Data de Nascimento</label>
          <input type="date" name="data_nascimento" id="data_nascimento">
        </div>

        <div class="botoes">
          <button type="submit" name="create_usuario" class="btn">Salvar</button> <!--saber se o usuario quer ser criado-->
          <a href="index.php" class="btn btn-secundario">Voltar</a>
        </div>
      </form>
    </div>
  </div>

  <!--
  VERIFICA SE TODOS OS CAMPOS FORAM PREENCHIDOS 
  encontra o elemento do formulário com o id="userForm" usando document.getElementById('userForm')/ addEventListener - PARA ADICIONAR UM EVENTO QUANDO O FORMULARIO FOR ENVIADO/ SUBMIT - É ACIONADO QUANDO O USUARIO TENTA ENVIAR O FORMULARIO. QUANDO O EVENTO SUBMIT ACONTECE, ELE CHAMA A FUNÇÃO QUE ESTA DENTRO DO ADDEventListener-->
  <script>
    document.getElementById('userForm').addEventListener('submit', function(event) {
      const requiredFields = ['nome', 'cpfcnpj', 'endereco', 'email', 'data_nascimento']; //cria um ARRAY QUE CONTEM OS NOMES DO ID
      let isValid = true; // ISVALID - COMEÇA COM TRUE, SIGNIFICA QUE POR PADRAO O FORM É VALIDO


      // O FOREACH É USADO PARA PERCORRER OS CAMPOS LISTADOS/ VERIFICA SE O CAMPO ESTA VAZIO, SE ESTIVER MOSTRA MENSAGEM
      requiredFields.forEach(field => {
        const input = document.getElementById(field);
        if (!input.value) {
          alert(`Por favor, preencha o campo ${input.previousElementSibling.textContent}`);
          isValid = false;
        }
      });

      if (!isValid) {
        event.preventDefault(); // Impede o envio do formulário se houver campos vazios
      }
    });
  </script>
</body>
</html>
