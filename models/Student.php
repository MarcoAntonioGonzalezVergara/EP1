<?php
session_start();
require_once 'Database.php';

class Student
{
	public $usuario;
	public $contra;
	public $nombre;
	public $apellidoP;
	public $apellidoM;
	public function __construct($usuario, $contra, $nombre, $apellidoP, $apellidoM)
	{
		$this->usuario   = $usuario;
		$this->contra    = $contra;
		$this->nombre    = $nombre;
		$this->apellidoP = $apellidoP;
		$this->apellidoM = $apellidoM;
	}

	public static function get($usuario)
	{
		$sql = "SELECT
				*
			   FROM
				alumno
				WHERE
				usuario = '$usuario'";
		$db = new Database();
		if ($rows = $db->query($sql)) {
			$db->close();
			return $rows;
		}
		$db->close();
		return false;
	}
	public function save()
	{
		$sql = "INSERT INTO
						 alumno (
						 usuario, 
						 password, 
						 nombre, 
						 apellidoP,
						 apellidoM) 

		 		VALUES(
		 				'$this->usuario', 
		 				'$this->contra', 
		 				'$this->nombre', 
		 				'$this->apellidoP', 
		 				'$this->apellidoM'
		 		)";
		$db = new Database();
		if ($db->query($sql)) {
			echo "Registrado";
			$db->close();
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
			$db->close();
		}
	}
	public static function enter($usuario,$contra)
	{
		$sql = "SELECT
				*
			   FROM
				alumno 
				WHERE
				usuario='$usuario'
				and password='$contra'
				";
		$db = new Database();
		if ($rows = $db->query($sql) and !empty($rows)) {
			echo "Inicio de sesión correcto";
			$_SESSION['session_id']=$rows[0]['idAlumno'];
			$_SESSION['session_usuario']=$rows[0]['usuario'];
			$_SESSION['session_password']=$rows[0]['password'];
			$_SESSION['session_nombre']=$rows[0]['nombre'];
			$_SESSION['session_apellidoP']=$rows[0]['apellidoP'];
			$_SESSION['session_apellidoM']=$rows[0]['apellidoM'];
			$db->close();
		} else {
			echo "Contraseña incorrecta";
			session_destroy();
			$db->close();
		}
	}
}