<?php
	require_once "../modelos/Categoria.php";
	$categoria = new Categoria();
// llamada de datos  y limpiesa de los caracteres
	$idcategoria = isset($_POST["idcategoria"])?limpiarCadena($_POST["idcategoria"]):"";
	$nombre = isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
	$descripcion =isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]) : "";
	//$condicion = isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]);
switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($idcategoria)){
			$rspta=$categoria->insertar($nombre,$descripcion);
			echo $rspta ? "Categoria registrado" : "Categoria  no se pudo registrar";
		}
		else {
			$rspta=$categoria->editar($idcategoria,$nombre,$descripcion);
			echo $rspta ? "Categoria actualizado" : "Categoria no se pudo actualizar";
		}
	break;

	case 'desactivar':
			$rspta = $categoria->desactivar($idcategoria);
			echo $rspta ? "Articulo desactivado": "Error al desactivar";
		break;
	case 'activar':
		$rspta = $categoria ->  activar($idcategoria);
		echo $rspta ? "Articulo Activado": "Error al activar";
		break;
	case 'mostrar':
		$rspta = $categoria->mostrar ($idcategoria);
		echo json_encode($rspta);

		break;
		case 'listar':
			# code...
			$rspta = $categoria-> listar();
// vamos a declarar un array
			$data  = Array();
		 while ($reg = $rspta -> fetch_object() ) {
		 	# code...
			// seccion de codigo inservible por razones desconocidas
			$data[] = array(
			"0"=>($reg->condicion) ? '<button class = "btn btn-warning" onclick ="mostrar(' . $reg->idcategoria . ')" ><i class="fa fa-pencil"></i></button>' . ' <button class = "btn btn-danger" onclick ="desactivar(' . $reg->idcategoria . ')" ><i class="fa fa-close"></i></button>':'<button class = "btn btn-warning" onclick ="mostrar(' . $reg->idcategoria . ')" ><i class="fa fa-pencil"></i></button>'.' <button class = "btn btn-primary" onclick ="activar(' . $reg->idcategoria . ')" ><i class="fa fa-check"></i></button>',
			"1"=>$reg->nombre,
			"2"=>$reg->descripcion,
			"3"=>($reg->condicion) ? '<span class = "label bg-green">Activado</span>':'<span class = "label bg-red">Desactivado</span>'
		 );
		 }
			$results  = array(
				"sEcho"=>1,//informacion para el data table
				"iTotalRecords"=>count($data),
				"iTotalDisplyRecords"=>count($data),
				"aaData"=>$data
			);
			echo json_encode($results);

			break;

}

?>
