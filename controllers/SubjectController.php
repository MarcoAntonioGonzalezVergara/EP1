<?php
session_start();
include_once("../models/Subject.php");
include_once("../models/Cleaner.php");

if(isset($_POST["action"])){
	switch ($_POST["action"]) {
		case 'register':
				$nombre = Cleaner::cleanInput($_POST["nombre"]);
				$profesor = Cleaner::cleanInput($_POST["profesor"]);
				$descripcion = Cleaner::cleanInput($_POST["descripcion"]);

				if ($subject = Subject::getName($nombre)) {
					echo "La materia ya existe";
				}else{
					$subject = new Subject($nombre,$profesor,$descripcion,$_SESSION['session_id']);

					$subject->save();
				}
				
			break;

		case 'update':
				$nombre = Cleaner::cleanInput($_POST["nombre"]);
				$profesor = Cleaner::cleanInput($_POST["profesor"]);
				$descripcion = Cleaner::cleanInput($_POST["descripcion"]);
				$id = $_POST["id"];

				if ($subject = Subject::getName($nombre)) {
					echo "La materia ya existe";
				}else{
					Subject::update($nombre,$profesor,$descripcion,$id);
				}
			break;

		case 'delete':
				$id = $_POST["id"];
				Subject::delete($id);
			break;
		default:
				echo "No entra";
			break;
	}
} else {

	switch ($_GET["action"]) {
		case 'get':
				$subjects = Subject::get($_SESSION['session_id']);

				$subjects = json_encode($subjects);

				echo $subjects;
			break;

		case 'set':
				$subjects = Subject::getSubject($_GET["id"]);

				$subjects = json_encode($subjects);

				echo $subjects;
			break;
		
		default:
			# code...
			break;
	}
	
}