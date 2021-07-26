<?php
session_start();
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>CRUD - Listar</title>		
	</head>
	<body>
		<a href="index.php">Cadastrar</a><br>
		<a href="listar_cliente.php">Listar</a><br>
		<h1>Listar Usuário</h1>
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
			echo "<a href='edit_cliente.php?id=" . $row_cliente['id'] . "'>Editar</a><br>";
			echo "<a href='proc_apagar_cliente.php?id=" . $row_cliente['id'] . "'>Apagar</a><br><hr>";
		}
		
		//Paginção - Somar a quantidade de usuários
		$result_pg = "SELECT COUNT(id) AS num_result FROM cliente";
		$resultado_pg = mysqli_query($conn, $result_pg);
		$row_pg = mysqli_fetch_assoc($resultado_pg);
		//echo $row_pg['num_result'];
		//Quantidade de pagina 
		$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
		
		//Limitar os link antes depois
		$max_links = 2;
		echo "<a href='listar_cliente.php?pagina=1'>Primeira</a> ";
		
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				echo "<a href='listar_cliente.php?pagina=$pag_ant'>$pag_ant</a> ";
			}
		}
			
		echo "$pagina ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				echo "<a href='listar_cliente.php?pagina=$pag_dep'>$pag_dep</a> ";
			}
		}
		
		echo "<a href='listar_cliente.php?pagina=$quantidade_pg'>Ultima</a>";
		
		?>		
	</body>
</html>