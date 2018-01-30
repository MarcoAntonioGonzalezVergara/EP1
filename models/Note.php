<?php
require_once 'Database.php';

class Note
{
	public $titulo;
	public $fechaEntrega;
	public $contenido;
	public $id;
	public function __construct($titulo,$fechaEntrega,$contenido,$id)
	{
		$this->titulo  = $titulo;
		$this->fechaEntrega    = $fechaEntrega;
		$this->contenido    = $contenido;
		$this->id = $id;
	}
	public static function getTitle($titulo)
	{
		$sql = "SELECT
				*
			   FROM
				nota
				WHERE
				titulo = '$titulo'";
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
				nota
				WHERE
				Materia_idMateria = '$id'";
		$db = new Database();
		if ($rows = $db->query($sql)) {
			$db->close();
			return $rows;
		}
		$db->close();
		return false;
	}
	public static function getNote($id)
	{
		$sql = "SELECT
				*
			   FROM
				nota
				WHERE
				idNota = '$id'";
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
						 nota (
						 titulo, 
						 fechaElaboracion,
						 contenido,
						 fechaEntrega,
						 Materia_idMateria) 

		 		VALUES(
		 				'$this->titulo', 
		 				date_format(now(),'%Y-%m-%d'), 
		 				'$this->contenido',
		 				'$this->fechaEntrega',
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
	public static function saveNull($titulo,$contenido,$id)
	{
		$sql = "INSERT INTO
						 nota (
						 titulo, 
						 fechaElaboracion,
						 contenido,
						 fechaEntrega,
						 Materia_idMateria) 

		 		VALUES(
		 				'$titulo', 
		 				date_format(now(),'%Y-%m-%d'), 
		 				'$contenido',
		 				null,
		 				'$id'
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
	public static function update($titulo,$contenido,$fechaEntrega,$id)
	{
		$sql = "UPDATE nota set titulo = '$titulo', fechaElaboracion = date_format(now(),'%Y-%m-%d'), contenido = '$contenido', fechaEntrega = '$fechaEntrega' WHERE idNota = '$id'";
		$db = new Database();
		if ($db->query($sql)) {
			echo "Modificado";
			$db->close();
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
			$db->close();
		}
	}
	public static function updateNull($titulo,$contenido,$id)
	{
		$sql = "UPDATE nota set titulo = '$titulo', fechaElaboracion = date_format(now(),'%Y-%m-%d'), contenido = '$contenido', fechaEntrega = null WHERE idNota = '$id'";
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
		$sql = "DELETE from nota WHERE idNota = '$id'";
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