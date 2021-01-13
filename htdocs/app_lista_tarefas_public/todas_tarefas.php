<?php
	$acao ="recuperar";
	require('tarefas_controller.php');
	

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<!-- Envento de Edição e exclusão de tarefas -->
		<script>

			/****************************************************/
			/*			Criação de um form de edição 			*/
			/****************************************************/
			function editaTarefa(idTarefa, textTarefa){
				//criar um form  para enviar o dado editado

				let form = document.createElement('form')
				form.action = 'tarefas_controller.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row'


				//cria um input para entrada do novo texto
				let inputTarefa  = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefaAtualizada' 
				inputTarefa.className = ' col-9 form-control'
				inputTarefa.value = textTarefa
				

				//cria um input para armazenar o id da tarefa que fica escondida na tela
				let inputTarefaId = document.createElement('input')
				inputTarefaId.type = 'hidden'
				inputTarefaId.name = 'idTarefa'
				inputTarefaId.value  = idTarefa
	
				//cria um botão para realizar a requisição do post do formulario
				let buttonTarefa = document.createElement('button')
				buttonTarefa.type	 = 'submit' 
				buttonTarefa.className = 'col-3 btn btn-info'
				buttonTarefa.innerHTML = 'Atualizar'

				//inclui o input e o button tarefa na arvoré do form
				form.appendChild(inputTarefa)
				form.appendChild(inputTarefaId)
				form.appendChild(buttonTarefa)
				
				//cria variavel para receber a div que estamos clicando no botão alterar, selecionando a div
				let indiceDivTarefa = document.getElementById(idTarefa)
				
				//limpa os dados da div que estamo alterando para colocar o form de atualizacao
				indiceDivTarefa.innerHTML = ''
				
				//inclui o form de atualização na página
				indiceDivTarefa.insertBefore(form, indiceDivTarefa[0]) //insertBefore é nativo do Dom e permite que inclua scripts em uma página ja renderizada, tendo 2 parametros: script a ser incluido e em que posição

			}

			/****************************************************/
			/*			FIM(Criação de um form de edição) 	    */
			/****************************************************/

			/****************************************************/
			/*			        Deleta tarefa			        */
			/****************************************************/
			function deletaTarefa(id){

				location.href = 'tarefas_controller.php?acao=deletar&id='+id
				
			}
			/****************************************************/
			/*			FIM (Deleta tarefa)		         	    */
			/****************************************************/

			
			/****************************************************/
			/*	       Marcar como tarefa Finalizada	        */
			/****************************************************/
			function finalizarTarefa(id){

				location.href = 'tarefas_controller.php?acao=finalizar&id='+id

			}
			/****************************************************/
			/*			FIM (Marcar como tarefa Finalizada)		 */
			/****************************************************/

		</script>
		<!--Fim edição e exclução tarefas-->


	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
								<!-- o foreach vai percorrer por cada indice que apelidei de "indice" e depois uso sinal de "=>" para acessar o conteudo da posição, dando um apelido para linha-->
								<?php foreach($arrayTarefasCadastradas as $indice => $dadosTarefas) { ?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div  id = <?php echo $dadosTarefas->id; ?> class="col-sm-9"><?php echo $dadosTarefas->tarefa; ?> ( <?php echo $dadosTarefas->status; ?>) </div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
									
										<i class="fas fa-trash-alt fa-lg text-danger "onclick="deletaTarefa(<?php echo $dadosTarefas->id; ?>)"></i>
										<i class="fas fa-edit fa-lg text-info" onclick="editaTarefa(<?php echo $dadosTarefas->id; ?> , '<?php echo $dadosTarefas->tarefa; ?>' )"></i>
										<i class="fas fa-check-square fa-lg text-success"onclick="finalizarTarefa(<?php echo $dadosTarefas->id; ?>)"></i>
									</div>
								</div>
							<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>