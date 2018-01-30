<?php
require_once 'Database.php';

class Subject
{
	public $nombre;
	public $profesor;
	public $descripcion;
	public $id;
	public function __construct($nombre,$profesor,$descripcion,$id)
	{
		$this->nombre   = $nombre;
		$this->profesor    = $profesor;
		$this->descripcion    = $descripcion;
		$this->id = $id;
	}
	public static function getName($nombre,$id)
	{
		$sql = "SELECT
				*
			   FROM
				materia
				WHERE
				nombre = '$nombre'
				and Alumno_idAlumno = '$id'";
		$db = new Database();
		if ($rows = $db->query($sql)) {
			$db->close();
			return $rows;
		}
		$db->close();
		return false;
	}

	public static function get($id)
	{
		$sql = "SELECT
				*
			   FROM
				materia
				WHERE
				Alumno_idAlumno = '$id'";
		$db = new Database();
		if ($rows = $db->query($sql)) {
			$db->close();
			return $rows;
		}
		$db->close();
		return false;
	}
	public static function getSubject($id)
	{
		$sql = "SELECT
				*
			   FROM
				materia
				WHERE
				idMateria = '$id'";
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
						 materia (
						 nombre, 
						 profesor,
						 descripcion,
						 Alumno_idAlumno) 

		 		VALUES(
		 				'$this->nombre', 
		 				'$this->profesor', 
		 				'$this->descripcion',
		 				'$this->id'
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
	public static function update($nombre,$profesor,$descripcion,$id)
	{
		$sql = "UPDATE materia set nombre = '$nombre', profesor = '$profesor', descripcion = '$descripcion' WHERE idMateria = '$id'";
		$db = new Database();
		if ($db->query($sql)) {
			echo "Modificado";
			$db->close();
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
			$db->close();
		}
	}
	public static function delete($id)
	{
		$sql = "DELETE from materia WHERE idMateria = '$id'";
		$db = new Database();
		if ($db->query($sql)) {
			echo "Modificado";
			$db->close();
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
			$db->close();
		}
	}
}