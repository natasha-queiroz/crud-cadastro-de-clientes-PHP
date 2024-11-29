
<?php
define('HOST', '127.0.0.1'); //armazena endereço do bd
define('USUARIO', 'root');
define('SENHA', 'admin');
define('DB', 'cadastrousuarios');
 
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
?>