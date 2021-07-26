<?php
session_start();
include_once("conexao.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_EMAIL);
$rg = filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_STRING);
$telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_EMAIL);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_EMAIL);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
$endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_EMAIL);

$result_cliente = "UPDATE clientes SET nome='$nome', cpf='$cpf', rg='$rg', telefone='$telefone', email='$email', estado='$estado', cidade='$cidade', endereco='$endereco' WHERE id='$id'";
$resultado_cliente = mysqli_query($conn, $result_cliente);

if(mysqli_affected_rows($conn)){
	$_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso</p>";
	header("Location: index.php");
}else{
	$_SESSION['msg'] = "<p style='color:red;'>Usuário não foi editado com sucesso</p>";
	header("Location: listar_cliente.php?id=$id");
}
