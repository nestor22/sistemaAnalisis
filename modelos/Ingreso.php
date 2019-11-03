<?php
	require "../config/conexion.php";

	Class Ingreso
	{
		//Implementamos nuestro constructor
		public function __construct()
		{

		}

		//Implementamos un método para insertar registros
		public function insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$idarticulo,$cantidad,$precio_compra,$precio_venta)
	{
		$sql="INSERT INTO ingreso (idproveedor,idusuario,tipo_comprobante,serie_comprobante,num_comprobante,fecha_hora,impuesto,total_compra,estado)
		VALUES ('$idproveedor','$idusuario','$tipo_comprobante','$serie_comprobante','$num_comprobante','$fecha_hora','$impuesto','$total_compra','Aceptado')";
		//return ejecutarConsulta($sql);
		$idingresonew=ejecutarConsulta_retornarID($sql);

		$num_elementos=0;
		$sw=true;

		while ($num_elementos < count($idarticulo))
		{
			$sql_detalle = "INSERT INTO detalle_ingreso(idingreso, idarticulo,cantidad,precio_compra,precio_venta) VALUES ('$idingresonew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_compra[$num_elementos]','$precio_venta[$num_elementos]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$num_elementos=$num_elementos + 1;
		}

		return $sw;
	}
		public function anular($idingreso)
		{
			$sql="UPDATE ingreso SET estado='Anulado' WHERE idingreso='$idingreso'";
			return ejecutarConsulta($sql);
		}

		public function mostrar($idingreso)
		{
  			$sql="SELECT i.idingreso, DATE(i.fecha_hora) as fecha,p.idpersona,p.nombre as proveedor, u.idusuario, u.nombre as usuario,i.tipo_comprobante,i.serie_comprobante, i.num_comprobante  FROM ingreso AS i INNER JOIN persona AS p ON i.idproveedor=p.idpersona INNER JOIN usuario AS u ON i.idusuario=u.idusuario WHERE idingreso='$idingreso'";
        return ejecutarConsultaSimpleFila($sql);
		}
		public function listar()
		{
			$sql="SELECT i.idingreso, DATE(i.fecha_hora) as fecha,p.idpersona,p.nombre as proveedor, u.idusuario, u.nombre as usuario,i.tipo_comprobante,i.serie_comprobante, i.num_comprobante, i.estado, i.total_compra  FROM ingreso AS i INNER JOIN persona AS p ON i.idproveedor=p.idpersona INNER JOIN usuario AS u ON i.idusuario=u.idusuario";
			return ejecutarConsulta($sql);
		}
		

	}
?>
