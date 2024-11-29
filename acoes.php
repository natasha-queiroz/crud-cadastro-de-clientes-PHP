<?php
session_start(); //iniciar a sessao
require 'conexao.php';

//verificando se ta setado. TRIM=REMOVER ESPAÇO DA STRING. 
if (isset($_POST['create_usuario'])) { // código está verificando se esse botão foi clicado e, com isso, se o formulário foi submetido. armazenando na variavel

	// Essas linhas pegam os dados recebidos do formulário ($_POST['campo']), aplicam a função trim() 
	$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
	$cpfcnpj = mysqli_real_escape_string($conexao, trim($_POST['cpfcnpj']));
	$endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
	$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
	$data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));

	//consulta sql
	$sql = "INSERT INTO usuarios (nome, cpfcnpj, endereco, email, data_nascimento) VALUES ('$nome', '$cpfcnpj', '$endereco', '$email', '$data_nascimento')";

	mysqli_query($conexao, $sql); //envia a consulta para o banco de dados, usando a conexão $conexao.

	//A função mysqli_affected_rows() retorna o número de linhas afetadas pela última consulta. No caso de um INSERT, ela retorna 1 se a inserção foi bem-sucedida e 0 se não houve inserção (por exemplo, em caso de erro ou dados duplicados).
	if (mysqli_affected_rows($conexao) > 0) {
		$_SESSION['mensagem'] = 'Usuário criado com sucesso'; //$_SESSION armazenar a mensagem "Usuário criado com sucesso".
		header('Location: index.php');
		exit;
		
	} else {
		$_SESSION['mensagem'] = 'Usuário não foi criado'; 
		header('Location: index.php');
		exit;
	}
}

//  Verifica se o formulário foi enviado para atualizar os dados do usuário
if (isset($_POST['update_usuario'])) {
	$usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
	$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
	$cpfcnpj = mysqli_real_escape_string($conexao, trim($_POST['cpfcnpj']));
	$endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
	$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
	$data_nascimento = mysqli_real_escape_string($conexao, trim($_POST['data_nascimento']));

	// Cria uma consulta SQL para atualizar os dados de um usuário na tabela usuarios do banco de dados. O UPDATE indica que estamos alterando dados existentes na tabela. SET: Define os novos valores para as colunas 
	$sql = "UPDATE usuarios SET nome = '$nome', cpfcnpj = '$cpfcnpj', endereco = '$endereco', email = '$email',  data_nascimento = '$data_nascimento' ";
	
	// Adiciona a condição para especificar qual usuário será atualizado
	$sql .= " WHERE id = '$usuario_id'"; 
	mysqli_query($conexao, $sql); //Executa a consulta SQL no banco de dados

	// Verifica se a atualização foi bem-sucedida
	if (mysqli_affected_rows($conexao) > 0) {
		$_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
		header('Location: index.php');
		exit;

	} else {
		$_SESSION['mensagem'] = 'Usuário não foi atualizado';
		header('Location: index.php');
		exit;
	}
}


if (isset($_POST['delete_usuario'])) {
	$usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_usuario']);
	$sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";
	mysqli_query($conexao, $sql);

	if (mysqli_affected_rows($conexao) > 0) {
		$_SESSION['message'] = 'Usuário deletado com sucesso';
		header('Location: index.php');
		exit;

	} else {
		$_SESSION['message'] = 'Usuário não foi deletado';
		header('Location: index.php');
		exit;
	}
}
?>