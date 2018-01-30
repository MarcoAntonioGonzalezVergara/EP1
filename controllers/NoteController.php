<?php
session_start();
include_once("../models/Note.php");
include_once("../models/Cleaner.php");

if(isset($_POST["action"])){
	switch ($_POST["action"]) {
		case 'register':
				$titulo = Cleaner::cleanInput($_POST["titulo"]);
				$fechaEntrega = $_POST["fechaEntrega"];
				$contenido = Cleaner::cleanInput($_POST["contenido"]);
				$id = $_POST["id"];

				if ($note = Note::getTitle($titulo) && Note::get($id)) {
					echo "La nota ya existe";
				}else{
					if ($fechaEntrega == "") {
						$note = Note::saveNull($titulo,$contenido,$id);
					}else{
						$note = new Note($titulo,$fechaEntrega,$contenido,$id);
						$note->save();
					}

				}
				
			break;

		case 'update':
				$titulo = Cleaner::cleanInput($_POST["titulo"]);
				$fechaEntrega = $_POST["fechaEntrega"];
				$contenido = Cleaner::cleanInput($_POST["contenido"]);
				$idM = $_POST["idM"];
				$id = $_POST["id"];

				if ($subject = Note::getTitle($titulo) && Note::get($idM)) {
					echo "La nota ya existe";
				}else{
					if ($fechaEntrega == "") {
						Note::updateNull($titulo,$contenido,$id);
					}else{
						Note::update($titulo,$contenido,$fechaEntrega,$id);
					}
					
				}
			break;

		case 'delete':
				$id = $_POST["id"];
				Note::delete($id);
			break;
		default:
				echo "No entra";
			break;
	}
} else {

	switch ($_GET["action"]) {
		case 'get':
				$notes = Note::get($_GET["id"]);

				$notes = json_encode($notes);

				echo $notes;
			break;

		case 'set':
				$notes = Note::getNote($_GET["id"]);

				$notes = json_encode($notes);

				echo $notes;
			break;

		case 'title':
				$notes = Note::getTitle($_GET["title"]);

				$notes = json_encode($notes);

				echo $notes;
			break;
		
		default:
			# code...
			break;
	}
	
}