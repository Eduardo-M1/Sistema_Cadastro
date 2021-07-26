<?php
session_start();
include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<title>Listar</title>		
	</head>
	<body>
		<h1>Listar cliente</h1>
		<a href="index.php">Cadastrar</a> <a href="listar_cliente.php">Listar</a><br>
		<br><br>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		
		//Receber o número da página
		$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);		
		$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
		
		//Setar a quantidade de itens por pagina
		$qnt_result_pg = 3;
		
		//calcular o inicio visualização
		$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
		
		$result_cliente = "SELECT * FROM clientes LIMIT $inicio, $qnt_result_pg";
		$resultado_cliente = mysqli_query($conn, $result_cliente);
		while($row_cliente = mysqli_fetch_assoc($resultado_cliente)){
			echo "ID: " . $row_cliente['id'] . "<br>";
			echo "Nome: " . $row_cliente['nome'] . "<br>";
			echo "CPF: " . $row_cliente['cpf'] . "<br>";
			echo "RG: " . $row_cliente['rg'] . "<br>";
			echo "Telefone: " . $row_cliente['telefone'] . "<br>";
			echo "E-mail: " . $row_cliente['email'] . "<br>";
			echo "Estado: " . $row_cliente['estado'] . "<br>";
			echo "Cidade: " . $row_cliente['cidade'] . "<br>";
			echo "Endereco: " . $row_cliente['endereco'] . "<br>";
			echo "<br><a href='edit_cliente.php?id=" . $row_cliente['id'] . "'>Editar</a><br>";
			echo "<a href='proc_apagar_cliente.php?id=" . $row_cliente['id'] . "'>Apagar</a><br><hr>";
		}		
		?>		
	</body>
</html>