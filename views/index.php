<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Principal</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link rel="shortcut icon" href="./img/ant.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body class="orange lighten-3">

	<main>
		<div class="video-container flex-container">

			<video autoplay loop>
				<source src="./videos/Ants.mp4" type="video/mp4">
			</video>

			<center class="front">
				<img src="./img/ANTnameextend.png">
		      	<h2 class="white-text">Inicio de Sesión</h2>

		      	<div class="container">
		        	<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

		          		<form class="col s12">
		            		<div class='row'>
		              			<div class='input-field col s12'>
		                			<input class='validate' type='text' name='usuario' id='usuario' />
		                			<label for='usuario'>Nombre de Usuario</label>
		              			</div>
		            		</div>

		            		<div class='row'>
		              			<div class='input-field col s12'>
		                			<input class='validate' type='password' name='password' id='password' />
		                			<label for='password'>Ingresa tu contraseña</label>
		              			</div>
		            		</div>

				            <br />

				            <center>
				              	<div class='row'>
				                	<button type='button' name='btn_login' class='col s12 btn btn-large waves-effect indigo' onclick="login();">Login</button>
				              	</div>
				            </center>
		          		</form>
		        	</div>
		        	<img src="./img/Ant2.png" style="float: left; margin-right: -250px;">
		      	</div>
		      	<a class="white-text" href="../views/students/register.php">Crear Cuenta </a>
		    </center>
		</div>
	</main>

	<script>
		function login(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/StudentController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var usuario   = document.querySelector('#usuario').value;
	  		var contra    = document.querySelector('#password').value;

	  		data.append('usuario', usuario);
	  		data.append('contra', contra);
	  		data.append('action', "enter");
	  		
  			xhr.addEventListener('loadend',function(){
	  			alert("Bienvenido");
		        document.querySelector("#usuario").value = "";
		        document.querySelector("#password").value = "";
	            window.location.href = '../views/subjects/home.php';
	  		});
	  		xhr.send(data);

	  	}
	</script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../js/materialize.min.js"></script>

</body>
</html>