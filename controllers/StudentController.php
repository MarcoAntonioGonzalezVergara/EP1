<?php
include_once("../models/Student.php");
include_once("../models/Cleaner.php");

if(isset($_POST["action"])){
	switch ($_POST["action"]) {
		case 'register':
				$usuario = Cleaner::cleanInput($_POST["usuario"]);
				$contra = Cleaner::cleanInput($_POST["contra"]);
				$nombre = Cleaner::cleanInput($_POST["nombre"]);
				$apellidoP = Cleaner::cleanInput($_POST["apellidoP"]);
				$apellidoM = Cleaner::cleanInput($_POST["apellidoM"]);

				if ($student = Student::get($usuario)) {
					echo "Nombre de Usuario ya esta tomado";
				}else{
					$student = new Student($usuario,$contra,$nombre,$apellidoP,$apellidoM);

					$student->save();
				}

				
			break;

		case 'enter':
				$usuario = Cleaner::cleanInput($_POST["usuario"]);
				$contra = Cleaner::cleanInput($_POST["contra"]);

				if ($student = Student::get($usuario)) {
					session_start();
					Student::enter($usuario,$contra);
				}else{
					echo "Usuario no existe";
				}

			break;

		case 'close':
				session_start();
				unset($_SESSION['session_id']);
				unset($_SESSION['session_usuario']);
				unset($_SESSION['session_password']);
				unset($_SESSION['session_nombre']);
				unset($_SESSION['session_apellidoP']);
				unset($_SESSION['session_apellidoM']);
				session_destroy();
			break;

		default:
				echo "No entra";
			break;
	}
} else {
	$students = Student::get();

	$students = json_encode($students);

	echo $students;
}