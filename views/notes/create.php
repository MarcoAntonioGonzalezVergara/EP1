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
<body class="background" style="background-image: url(../img/back3.jpg);"onload="getSubjectId();">

	<main>
		
		<?php include("../partials/header.php") ?>
		
		<section>
			<h1 id="title"><?php echo $name;?></h1>
			<div class="row" id="cards">
		        <div class="col s12 m6 l4" id="base">
		          <div class="card grey lighten-4" style="height: 300px; width: 300px;">
		            <div class="card-content black-text">
		              	<a class=" waves-effect waves-light btn-floating modal-trigger red" href="#modal1" onclick=""><i class="material-icons">add</i></a>
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
				                			<input type='date' name='fechaEntrega' id='fechaEntrega' style="padding: 20px;" />
				                			<label for='fechaEntrega'>Selecciona la fecha de entrega</label>
				              			</div>
				              			
				            		</div>

				            		<div class='row'>
				              			<div class='input-field col s12'>
				                			<textarea id="contenido" class="materialize-textarea"></textarea>
          									<label for="contenido">Haz tu apunte</label>
				              			</div>
				            		</div>

				            		<p hidden id="idMateria"></p>
						            <br />
				          		</form>
						    </div>
						    <div class="modal-footer">
						      	<button class="modal-action modal-close waves-effect waves-light btn-flat green" onclick="save(); removeNotes(); getSubjectId();">Agregar</button>
						      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cancelar</button>
						    </div>
						</div>
		            </div>
		          </div>
		        </div>
		    </div>
		    <div id="modal2" class="modal">
			    <div class="modal-content">
			      	<h4>Modificación de Nota</h4>
			      	<form class="col s12">
	            		<div class='row'>
	              			<div class='input-field col s12'>
	                			<input class='validate' type='text' name='tituloM' id='tituloM' />
	                			<label for='tituloM'>Ingresa el nuevo titulo de la nota</label>
	              			</div>
	            		</div>

	            		<div class='row'>

	              			<div class='input-field col s12'>
	                			<input type='date' name='fechaEntregaM' id='fechaEntregaM' style="padding: 20px;" />
	                			<label for='fechaEntregaM'>Selecciona la fecha de entrega</label>
	              			</div>
	              			
	            		</div>

	            		<div class='row'>
	              			<div class='input-field col s12'>
	                			<textarea id="contenidoM" class="materialize-textarea"></textarea>
								<label for="contenidoM">Modifica tu apunte</label>
	              			</div>
	            		</div>

	            		<p hidden id="idNota"></p>
			            <br />
	          		</form>
			    </div>
			    <div class="modal-footer">
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat green" onclick="update(); removeNotes(); getSubjectId();">Modificar</button>
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cancelar</button>
			    </div>
			</div>
			<div id="modal3" class="modal">
			    <div class="modal-content">
			      	<h4>Eliminar Materia</h4>
			      	<p hidden id="idNota2"></p>
			    </div>
			    <div class="modal-footer">
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat green" onclick="del(); removeNotes(); getSubjectId();">Eliminar</button>
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cancelar</button>
			    </div>
			</div>
			<div id="modal4" class="modal">
			    <div class="modal-content">
			      	<h4>Nota</h4>
			      	<p id="nota"></p>
			    </div>
			    <div class="modal-footer">
			      	<button class="modal-action modal-close waves-effect waves-light btn-flat red">Cerrar</button>
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
		function getSubjectId(){
	        var name = "<?php echo $name;?>";
	        var xhr = new XMLHttpRequest();
  			var url = 'http://localhost/EP1/controllers/SubjectController.php?action=name&name='+name;
  			xhr.open('GET',url,true);
  			xhr.addEventListener('loadend',function(){
	          subjects = eval(xhr.responseText);
	          subjects.forEach(function(subject){
	          	getNotes(subject.idMateria);
		        document.querySelector("#idMateria").innerHTML= subject.idMateria;
	          });
	  		});
  			xhr.send();
        }
		function save(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/NoteController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var titulo    = document.querySelector('#titulo').value;
	  		var fechaEntrega = document.querySelector('#fechaEntrega').value;
	  		var contenido = document.querySelector('#contenido').value;
	  		var id = document.querySelector("#idMateria").innerHTML;

	  		if(titulo == ""){
	  			alert("La nota debe llevar titulo");
	  		}else{

		  		if (contenido == "") {
		  			contenido = "No se hay descripcion";
		  		}

		  		data.append('titulo', titulo);
		  		data.append('fechaEntrega', fechaEntrega);
		  		data.append('contenido', contenido);
		  		data.append('id', id);
		  		data.append('action', "register");

		  		xhr.addEventListener('loadend',function(){
		  			
			        document.querySelector("#titulo").value = "";
			        document.querySelector("#fechaEntrega").value = "";
			        document.querySelector("#contenido").value = "";
		  		});
		  		xhr.send(data);
		  	}
	  	}
	  	function update(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/NoteController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var titulo   = document.querySelector('#tituloM').value;
	  		var fechaEntrega = document.querySelector('#fechaEntregaM').value;
	  		var contenido = document.querySelector('#contenidoM').value;
	  		var idM = document.querySelector("#idMateria").innerHTML;
	  		var id = document.querySelector("#idNota").innerHTML;

	  		if(titulo == ""){
	  			alert("La nota debe llevar titulo");
	  		}else{

		  		if (contenido == "") {
		  			contenido = "No se hay descripcion";
		  		}

		  		data.append('titulo', titulo);
		  		data.append('fechaEntrega', fechaEntrega);
		  		data.append('contenido', contenido);
		  		data.append('id', id);
		  		data.append('idM',idM);
		  		data.append('action', "update");

		  		xhr.addEventListener('loadend',function(){
		  			
		  		});
		  		xhr.send(data);
		  	}
	  	}
	  	function del(){
	  		var xhr = new XMLHttpRequest();
	  		var url = 'http://localhost/EP1/controllers/NoteController.php';
	  		xhr.open('POST',url,true);

	  		var data      = new FormData();
	  		var id = document.querySelector('#idNota2').innerHTML;

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
	  	function removeNotes(){
	  		var parent = document.getElementById("cards");
			while (!(parent.firstChild == parent.lastChild) && !(parent.lastChild.id == "base")) {
			    parent.removeChild(parent.lastChild);
			}
	  	}
	  	function getNotes($id){
	  		var id = $id;
	  		var xhr = new XMLHttpRequest();
  			var url = 'http://localhost/EP1/controllers/NoteController.php?action=get&id='+id;
  			xhr.open('GET',url,true);
  			xhr.addEventListener('loadend',function(){
	          notes = eval(xhr.responseText);
	          notes.forEach(function(note){
	            container = document.createElement("div");
	            card = document.createElement("div");
	            content = document.createElement("div");
	            title = document.createElement("h3");
	            titleText = document.createElement("a");
	            dueDate = document.createElement("h5");
	            creation = document.createElement("p");
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
	            titleText.innerHTML=note.titulo;
	            titleText.className = "nota modal-trigger";
	            titleText.href = "#modal4";
	            titleText.onclick = setName();
	            if (note.fechaEntrega == null) {
	            	dueDate.innerHTML="No hay fecha de entrega";
	            }else{
	            	dueDate.innerHTML="Fecha de entrega: "+note.fechaEntrega;
	            }
	            creation.innerHTML="Fecha de elaboración: "+note.fechaElaboracion;
	            actions.className = "card-action center-align";
	            button1.className = "id waves-effect waves-light btn modal-trigger red";
	            button1.href = "#modal2";
	            button1.id = note.idNota;
	            button1.onclick = set();
	            icon1.className = "large material-icons";
	            icon1.innerHTML = "mode_edit";
	            button2.className = "id waves-effect waves-light btn modal-trigger red";
	            button2.href = "#modal3";
	            button2.id = note.idNota;
	            button2.onclick = set();
	            icon2.className = "large material-icons";
	            icon2.innerHTML = "clear";

	            // Agregar hijos a la fila
	            container.appendChild(card);
	            card.appendChild(content);
	            card.appendChild(actions);
	            content.appendChild(title);
	            content.appendChild(dueDate);
	            content.appendChild(creation);
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
		  			var url = 'http://localhost/EP1/controllers/NoteController.php?action=set&id='+id;
		  			xhr.open('GET',url,true);
		  			xhr.addEventListener('loadend',function(){
			          notes = eval(xhr.responseText);
			          notes.forEach(function(note){
			          	document.querySelector("#tituloM").value = note.titulo;
			          	if (note.fechaEntrega == null) {
			          		document.querySelector("#fechaEntregaM").value = "";
			          	}else{
			          		document.querySelector("#fechaEntregaM").value = note.fechaEntrega;
			          	}
			          	document.querySelector("#nota").innerHTML= note.contenido;
				        document.querySelector("#contenidoM").value = note.contenido;
				        document.querySelector("#idNota").innerHTML= id;
				        document.querySelector("#idNota2").innerHTML= id;

			          });
			  		});
		  			xhr.send();
			    }); 
			});
        	
        }
        function setName(){
	  		$(document).ready(function() {
			    $('a.nota').click(function() { 
			        var title = this.innerHTML;
			        var xhr = new XMLHttpRequest();
		  			var url = 'http://localhost/EP1/controllers/NoteController.php?action=title&title='+title;
		  			xhr.open('GET',url,true);
		  			xhr.addEventListener('loadend',function(){
			          notes = eval(xhr.responseText);
			          notes.forEach(function(note){
			          	document.querySelector("#tituloM").value = note.titulo;
			          	if (note.fechaEntrega == null) {
			          		document.querySelector("#fechaEntregaM").value = "";
			          	}else{
			          		document.querySelector("#fechaEntregaM").value = note.fechaEntrega;
			          	}
			          	document.querySelector("#nota").innerHTML= note.contenido;
				        document.querySelector("#contenidoM").value = note.contenido;
				        document.querySelector("#idNota").innerHTML= note.idNota;
				        document.querySelector("#idNota2").innerHTML= note.idNota;

			          });
			  		});
		  			xhr.send();
			    }); 
			});
        	
        }
        
	</script>

</body>
</html>