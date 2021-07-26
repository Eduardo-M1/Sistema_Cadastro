<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<!--Faz o link do bootstrap-->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<title>CRUD - Cadastrar</title>		
	</head>
	<body>
		<a href="index.php">Cadastrar</a><br>
		<a href="listar_cliente.php">Listar</a><br>
		<h1>Cadastrar Usuário</h1>
		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<!--É criado o formulário para cadastro utilizando o bootstrap-->
		<form method="POST" action="proc_cad_cliente.php">
		<div class="row g-3">
		<div class="col">
			<input type="text" class="form-control" placeholder="Nome completo" name="nome">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="CPF" name="cpf">
		</div>
		</div>
		<br>
		<div class="row g-3">
		<div class="col">
			<input type="text" class="form-control" placeholder="RG" name="rg">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="Telefone" name="telefone" >
		</div>
		</div>
		<br>
		<div class="row g-3">
		<div class="col">
			<input type="email" class="form-control" placeholder="Email" name="email">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="Endereço(Logradouro, número, bairro)" name="endereco">
		</div>
		</div>
		<br>
		<div class="row g-3">
		<div class="col">
		<select class="form-select" name="estado" id="estado">
		<option selected>Selecionar estado</option>
		</select>
		<br>
		<input type="submit" value="Cadastrar">
		</div>
		<div class="col">
		<select class="form-select" name="cidade" id="cidade">
		<option selected>Selecionar cidade</option>
		</select>
		</div>
		</div>
<!--		<div class="col">
			<input type="text" class="form-control" placeholder="cidade" name="cidade">
		</div>
		<div class="col">
			<input type="text" class="form-control" placeholder="estado" name="estado">
		</div>
		<input type="submit" value="Cadastrar">-->
		</form>
		
	</body>
</html>

<script>
	$(document).ready(function(){
		carregar_json('estado');
		function carregar_json(id, cidade_id){
			var html = '';

			$.getJSON('https://gist.githubusercontent.com/letanure/3012978/raw/36fc21d9e2fc45c078e0e0e07cce3c81965db8f9/estados-cidades.json', function(data){
				html += '<option>Selecionar '+ id +'</option>';
				console.log(data);
				if(id == 'estado' && cidade_id == null){
					for(var i = 0; i < data.estados.length; i++){
						html += '<option value='+ data.estados[i].sigla +'>'+ data.estados[i].nome+'</option>';
					}
				}else{
					for(var i = 0; i < data.estados.length; i++){
						if(data.estados[i].sigla == cidade_id){
							for(var j = 0; j < data.estados[i].cidades.length; j++){
								html += '<option value='+ data.estados[i].sigla +'>'+data.estados[i].cidades[j]+ '</option>';
							}
						}
					}
				}

				$('#'+id).html(html);
			});
			
		}

		$(document).on('change', '#estado', function(){
			var cidade_id = $(this).val();
			console.log(cidade_id);
			if(cidade_id != null){
				carregar_json('cidade', cidade_id);
			}
		});

	});
</script>