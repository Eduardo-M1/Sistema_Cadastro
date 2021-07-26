<?php
session_start();
include_once("conexao.php");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$result_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$resultado_cliente = mysqli_query($conn, $result_cliente);
$row_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<!--É feito o link do bootstrap-->	
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<title>CRUD - Editar</title>		 
	</head>
	<body>
		<a href="index.php">Cadastrar</a><br>
		<a href="listar_cliente.php">Listar</a><br>
		<h1>Editar Usuário</h1>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<!--Foi criado o formulario usando o bootstrap-->	
		<form method="POST" action="proc_edit_cliente.php">
			<input type="hidden" name="id" value="<?php echo $row_cliente['id']; ?>">
			<div class="row g-3">
		<div class="col">
			<input type="text" class="form-control" placeholder="Nome completo" name="nome" value="<?php echo $row_cliente['nome']; ?>">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="CPF" name="cpf" value="<?php echo $row_cliente['cpf']; ?>">
		</div>
		</div>
		<div class="row g-3">
		<div class="col">
			<input type="text" class="form-control" placeholder="RG" name="rg" value="<?php echo $row_cliente['rg']; ?>">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="Telefone" name="telefone" value="<?php echo $row_cliente['telefone']; ?>">
		</div>
		</div>
		<div class="row g-3">
		<div class="col">
			<input type="email" class="form-control" placeholder="Email" name="email"value="<?php echo $row_cliente['email']; ?>">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="Estado" name="estado"value="<?php echo $row_cliente['estado']; ?>">
		</div>
		</div>
		<div class="row g-3">
		<div class="col">
			<input type="text" class="form-control" placeholder="Cidade" name="cidade" value="<?php echo $row_cliente['cidade']; ?>">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="Endereço" name="endereco" value="<?php echo $row_cliente['endereco']; ?>">
		</div>
		</div>	
			
			<input type="submit" value="Editar">
		</form>
	</body>
</html>