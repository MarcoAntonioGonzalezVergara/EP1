<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Registrar Usuario</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" href="../img/ant.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="background">

	<main>
		<center style="margin-bottom: 2%;">

	      	<h2 class="white-text">
	      		<img src="../img/Ant.png" style="float: left; margin-right: -300px;">
	      		Registro de Usuario
	      	</h2>

	      	<div class="container">
	        	<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

	          		<form class="col s12">
	            		<div class='row'>
	              			<div class='input-field col s12'>
	                			<input class='validate' type='text' name='usuario' id='usuario' />
	                			<label for='usuario'>Ingresa un nombre de usuario</label>
	              			</div>
	            		</div>

	            		<div class='row'>

	              			<div class='input-field col s12'>
	                			<input class='validate' type='password' name='password' id='password' />
	                			<label for='password'>Ingresa tu contraseña</label>
	              			</div>

	              			<div class='input-field col s12'>
	                			<input class='validate' type='password' name='passwordVal' id='passwordVal' />
	                			<label for='passwordVal'>Vuelve a ingresar la contraseña</label>
	              			</div>
	              			
	            		</div>

	            		<div class='row'>
	              			<div class='input-field col s12'>
	                			<input class='validate' type='text' name='nombre' id='nombre' />
	                			<label for='name'>Nombre(s)</label>
	              			</div>

	              			<div class='input-field col s12'>
	                			<input class='validate' type='text' name='apellidoP' id='apellidoP' />
	                			<label for='apellidoP'>Apellido Paterno</label>
	              			</div>

	              			<div class='input-field col s12'>
	                			<input class='validate' type='text' name='apellidoM' id='apellidoM' />
	                			<label for='apellidoM'>Apellido Materno</label>
	              			</div>
	            		</div>

			            <br />

			            <center>
			              	<div class='row'>
			                	<button type='button' name='btn_login' class='col s12 btn btn-large waves-effect indigo' onclick="save();">Registrar</button>
			              	</div>
			            </center>
	          		</form>
	        	</div>
	      	</div>
	      	<a class="white-text" href="../index.php">¿Ya tienes cuenta? </a>
	    </center>
	</main>

	<script>
		function save(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/StudentController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var usuario   = document.querySelector('#usuario').value;
	  		var contra    = document.querySelector('#password').value;
	  		var contraVal = document.querySelector('#passwordVal').value;
	  		var nombre    = document.querySelector('#nombre').value;
	  		var apellidoP = document.querySelector('#apellidoP').value;
	  		var apellidoM = document.querySelector('#apellidoM').value;

	  		if(usuario=="" || contra=="" || contraVal=="" || nombre=="" || apellidoP=="" || apellidoM==""){
	  			alert("Llena los campos");
	  		}else{
	  			if (contra == contraVal) {
		  			if (valid(nombre) && valid(apellidoP) && valid(apellidoM)) {
		  				data.append('usuario', usuario);
				  		data.append('contra', contra);
				  		data.append('nombre', nombre);
				  		data.append('apellidoP', apellidoP);
				  		data.append('apellidoM', apellidoM);
				  		data.append('action', "register");

				  		xhr.addEventListener('loadend',function(){
				  			alert("Operación realizada con exito");
					        document.querySelector("#usuario").value = "";
					        document.querySelector("#password").value = "";
					        document.querySelector("#passwordVal").value = "";
					        document.querySelector("#nombre").value = "";
					        document.querySelector("#apellidoP").value = "";
					        document.querySelector("#apellidoM").value = "";
				            window.location.href = '../index.php';
				  		});
				  		xhr.send(data);
		  			}
		  			
		  		}else{
		  			alert("Las contraseñas no coinciden");
		  		}
	  		}
	  			
	  	}
	  	function valid($chain){

	  		return /^[A-Za-z\s]+$/.test($chain);
	  	}
	</script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../js/materialize.min.js"></script>
</body>
</html>