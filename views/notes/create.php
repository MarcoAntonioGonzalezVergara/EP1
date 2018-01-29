<?php
if(!empty($_GET['name'])){
	$name = $_REQUEST['name'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Notas</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" href="../img/ant.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="background" style="background-image: url(../img/back3.jpg);">

	<main>
		<?php include("../partials/header.php") ?>
		<section>
			<h1><?php echo $name;?></h1>
			<div class="row">
		        <div class="col s12 m6">
		          <div class="card grey lighten-4" style="height: 200px; width: 250px;">
		            <div class="card-content black-text">
		              	<a class=" waves-effect waves-light btn-floating modal-trigger red" href="#modal1"><i class="material-icons">add</i></a>
		              	<div id="modal1" class="modal">
						    <div class="modal-content">
						      	<h4>Agregar Nota</h4>
						      	<form class="col s12">
				            		<div class='row'>
				              			<div class='input-field col s12'>
				                			<input class='validate' type='text' name='titulo' id='titulo' />
				                			<label for='titulo'>Ingresa el titulo de la nota</label>
				              			</div>
				            		</div>

				            		<div class='row'>

				              			<div class='input-field col s12'>
				                			<input type='text' name='profesor' id='profesor' />
				                			<label for='profesor'>Ingresa el nombre del profesor de la materia</label>
				              			</div>
				              			
				            		</div>

				            		<div class='row'>
				              			<div class='input-field col s12'>
				                			<textarea id="descripcion" class="materialize-textarea"></textarea>
          									<label for="descripcion">Ingresa la descripción de la materia</label>
				              			</div>
				            		</div>

						            <br />
				          		</form>
						    </div>
						    <div class="modal-footer">
						      	<button class="modal-action modal-close waves-effect waves-light btn-flat green" onclick="save(); removeSubjects(); getSubjects();">Agregar</button>
						      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cancelar</button>
						    </div>
						</div>
		            </div>
		          </div>
		        </div>
		    </div>
		</section>

	</main>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../js/materialize.min.js"></script>

</body>
</html>