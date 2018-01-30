<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<title>Materias</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="shortcut icon" href="../img/ant.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body class="background" style="background-image: url(../img/back4.jpg);" onload="getSubjects();">

	<main>
		<?php include("../partials/header.php") ?>
		<section>
			<div class="row" id="cards">
		        <div id="base" class="col s12 m6 l4">
		          <div class="card grey lighten-4" style="height: 300px; width: 300px;">
		            <div class="card-content black-text center-align">
		              	<a class=" waves-effect waves-light btn-floating modal-trigger red" href="#modal1"><i class="material-icons">add</i></a>
		              	<div id="modal1" class="modal">
						    <div class="modal-content">
						      	<h4>Registro de Materia</h4>
						      	<form class="col s12">
				            		<div class='row'>
				              			<div class='input-field col s12'>
				                			<input class='validate' type='text' name='nombre' id='nombre' />
				                			<label for='nombre'>Ingresa el nombre de la materia</label>
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
		    <div id="modal2" class="modal">
			    <div class="modal-content">
			      	<h4>Modificación de Materia</h4>
			      	<form class="col s12">
	            		<div class='row'>
	              			<div class='input-field col s12'>
	                			<input class='validate' type='text' name='nombreM' id='nombreM' />
	                			<label for='nombreM'>Ingresa el nuevo nombre de la materia</label>
	              			</div>
	            		</div>

	            		<div class='row'>

	              			<div class='input-field col s12'>
	                			<input type='text' name='profesorM' id='profesorM' />
	                			<label for='profesorM'>Ingresa el nuevo nombre del profesor de la materia</label>
	              			</div>
	              			
	            		</div>

	            		<div class='row'>
	              			<div class='input-field col s12'>
	                			<textarea id="descripcionM" class="materialize-textarea"></textarea>
									<label for="descripcionM">Ingresa la nueva descripción de la materia</label>
	              			</div>
	            		</div>

	            		<p hidden id="idMateria"></p>
			            <br />
	          		</form>
			    </div>
			    <div class="modal-footer">
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat green" onclick="update(); removeSubjects(); getSubjects();">Modificar</button>
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cancelar</button>
			    </div>
			</div>
			<div id="modal3" class="modal">
			    <div class="modal-content">
			      	<h4>Eliminar Materia</h4>
			      	<p hidden id="idMateria2"></p>
			    </div>
			    <div class="modal-footer">
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat green" onclick="del(); removeSubjects(); getSubjects();">Eliminar</button>
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cancelar</button>
			    </div>
			</div>
		</section>
	</main>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../js/materialize.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.modal').modal();
		});

		function save(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/SubjectController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var nombre    = document.querySelector('#nombre').value;
	  		var profesor = document.querySelector('#profesor').value;
	  		var descripcion = document.querySelector('#descripcion').value;

	  		if(nombre == ""){
	  			alert("El nombre es obligatorio");
	  		}else{
	  			if (profesor == "") {
		  			profesor = "No se registro profesor";
		  		}

		  		if (descripcion == "") {
		  			descripcion = "No se hay descripcion";
		  		}

		  		data.append('nombre', nombre);
		  		data.append('profesor', profesor);
		  		data.append('descripcion', descripcion);
		  		data.append('action', "register");

		  		xhr.addEventListener('loadend',function(){
		  			
			        document.querySelector("#nombre").value = "";
			        document.querySelector("#profesor").value = "";
			        document.querySelector("#descripcion").value = "";
		  		});
		  		xhr.send(data);
	  		}

	  	}
	  	function update(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/SubjectController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var nombre    = document.querySelector('#nombreM').value;
	  		var profesor = document.querySelector('#profesorM').value;
	  		var descripcion = document.querySelector('#descripcionM').value;
	  		var id = document.querySelector('#idMateria').innerHTML;

	  		if(nombre == ""){
	  			alert("El nombre es obligatorio");
	  		}else{

		  		if (profesor == "") {
		  			profesor = "No se registro profesor";
		  		}

		  		if (descripcion == "") {
		  			descripcion = "No se hay descripcion";
		  		}

		  		data.append('nombre', nombre);
		  		data.append('profesor', profesor);
		  		data.append('descripcion', descripcion);
		  		data.append('id', id);
		  		data.append('action', "update");

		  		xhr.addEventListener('loadend',function(){
		  			
		  		});
		  		xhr.send(data);
		  	}
	  	}
	  	function del(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/SubjectController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var id = document.querySelector('#idMateria2').innerHTML;

	  		data.append('id', id);
	  		data.append('action', "delete");

	  		xhr.addEventListener('loadend',function(){
	  			
	  		});
	  		xhr.send(data);
	  	}
	  	function logOut(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/StudentController.php';
	  		xhr.open('POST',url,true);

	  		var data = new FormData();

	  		data.append('action', "close");

	  		xhr.addEventListener('loadend',function(){
	  			
	  		});
	  		xhr.send(data);
	  	}
	  	function removeSubjects(){
	  		var parent = document.getElementById("cards");
			while (!(parent.firstChild == parent.lastChild) && !(parent.lastChild.id == "base")) {
			    parent.removeChild(parent.lastChild);
			}
	  	}
	  	function getSubjects(){
	  		var xhr = new XMLHttpRequest();
  			var url = 'http://localhost/EP1/controllers/SubjectController.php?action=get';
  			xhr.open('GET',url,true);
  			xhr.addEventListener('loadend',function(){
	          subjects = eval(xhr.responseText);
	          subjects.forEach(function(subject){
	            container = document.createElement("div");
	            card = document.createElement("div");
	            content = document.createElement("div");
	            title = document.createElement("h3");
	            titleText = document.createElement("a");
	            subtitle = document.createElement("h5");
	            description = document.createElement("p");
	            actions = document.createElement("div");
	            button1 = document.createElement("a");
	            icon1 = document.createElement("i");
	            button2 = document.createElement("a");
	            icon2 = document.createElement("i");

	            container.className = "col s12 m6 l4";
	            card.className = "card grey lighten-4";
	            card.style.height = "300px";
	            card.style.width = "300px";
	            content.className = "card-content black-text center-align";
	            titleText.innerHTML=subject.nombre;
	            titleText.className = "title";
	            titleText.onclick = send();
	            subtitle.innerHTML=subject.profesor;
	            description.innerHTML=subject.descripcion;
	            actions.className = "card-action center-align";
	            button1.className = "id waves-effect waves-light btn modal-trigger red";
	            button1.href = "#modal2";
	            button1.id = subject.idMateria;
	            button1.onclick = set();
	            icon1.className = "large material-icons";
	            icon1.innerHTML = "mode_edit";
	            button2.className = "id waves-effect waves-light btn modal-trigger red";
	            button2.href = "#modal3";
	            button2.id = subject.idMateria;
	            button2.onclick = set();
	            icon2.className = "large material-icons";
	            icon2.innerHTML = "clear";

	            // Agregar hijos a la fila
	            container.appendChild(card);
	            card.appendChild(content);
	            card.appendChild(actions);
	            content.appendChild(title);
	            content.appendChild(subtitle);
	            content.appendChild(description);
	            actions.appendChild(button1);
	            actions.appendChild(button2);
	            button1.appendChild(icon1);
	            button2.appendChild(icon2);
	            title.appendChild(titleText);

	            document.querySelector("#cards").appendChild(container);
	          });
	  		});
  			xhr.send();
	  	}
	  	function set(){
	  		$(document).ready(function() {
			    $('a.id').click(function() { 
			        var id = $(this).attr('id');
			        var xhr = new XMLHttpRequest();
		  			var url = 'http://localhost/EP1/controllers/SubjectController.php?action=set&id='+id;
		  			xhr.open('GET',url,true);
		  			xhr.addEventListener('loadend',function(){
			          subjects = eval(xhr.responseText);
			          subjects.forEach(function(subject){
			          	document.querySelector("#nombreM").value = subject.nombre;
				        document.querySelector("#profesorM").value = subject.profesor;
				        document.querySelector("#descripcionM").value = subject.descripcion;
				        document.querySelector("#idMateria").innerHTML= id;
				        document.querySelector("#idMateria2").innerHTML= id;
			          });
			  		});
		  			xhr.send();
			    }); 
			});
        	
        }
        function send(){
        	$(document).ready(function() {
			    $('a.title').click(function() { 
			        var name = this.innerHTML;
			        window.location.href = '../notes/create.php?name='+name;
			    }); 
			});
        }
	</script>

</body>
</html>