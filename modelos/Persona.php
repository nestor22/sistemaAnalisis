<?php
	require "../config/conexion.php";

	Class Persona
	{
		//Implementamos nuestro constructor
		public function __construct()
		{

		}

		//Implementamos un método para insertar registros
		public function insertar($tipopersona, $nombre, $tipodocumento, $numdocumento, $direccion, $telefono, $email)
		{
			$sql = "INSERT INTO persona(tipo_persona, nombre, tipo_documento, num_documento, direccion, telefono, email) VALUES ('$tipopersona', '$nombre', '$tipodocumento', '$numdocumento', '$direccion', '$telefono', '$email')";
			return ejecutarConsulta($sql);
		}

		//implementamos un método para editar registros
		public function editar($idpersona, $tipopersona, $nombre, $tipodocumento, $numdocumento, $direccion, $telefono, $email)
		{
			$sql="UPDATE persona SET tipo_persona='$tipopersona' nombre='$nombre', tipo_documento='$tipodocumento', num_documento='$numdocumento', direccion='$direccion', telefono='$telefono=', email='$email' WHERE idpersona='$idpersona'";
			return ejecutarConsulta($sql);
		}

		//Implementamos un método para desactivar categorías
		public function eliminar($idcategoria)
		{
			$sql="DELETE FROM persona WHERE idpersona='$idpersona'";
			return ejecutarConsulta($sql);
		}
		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar($idcategoria)
		{
			$sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
			return ejecutarConsultaSimpleFila($sql);
		}

		//Implementar un método para listar los registros
		public function listarp()
		{
			$sql="SELECT * FROM persona WHERE tipo_persona='Proveedor'";
			return ejecutarConsulta($sql);
        }
        public function listarc()
		{
			$sql="SELECT * FROM persona WHERE tipo_persona='Cliente'";
			return ejecutarConsulta($sql);
		}

		public function select(){
			$sql="SELECT * FROM categoria WHERE condicion = 1";
			return ejecutarConsulta($sql);

		}
	}
?>
