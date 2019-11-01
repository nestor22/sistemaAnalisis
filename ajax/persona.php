<?php
	require_once "../modelos/Persona.php";
	$persona = new Persona();
	$idpersona = isset($_POST["idpersona"])?limpiarCadena($_POST["idpersona"]):"";
    $tipopersona = isset($_POST["tipopersona"])?limpiarCadena($_POST["tipopersona"]):"";
    $tipodocumento = isset($_POST["tipodocumento"])?limpiarCadena($_POST["tipodocumento"]):"";
    $numdocumento = isset($_POST["numdocumento"])?limpiarCadena($_POST["numdocumento"]):"";
    $nombre = isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
    $direccion =isset($_POST["direccion"])?limpiarCadena($_POST["direccion"]) : "";
	$telefono =isset($_POST["telefono"])?limpiarCadena($_POST["telefono"]) : "";
	$email =isset($_POST["email"])?limpiarCadena($_POST["email"]) : "";
    
switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($idpersona)){
			$rspta=$persona->insertar($tipopersona, $nombre, $tipodocumento, $numdocumento, $direccion, $telefono, $email);
			echo $rspta ? "Persona registrado" : "Categoria  no se pudo registrar";
		}
		else {
			$rspta=$persona->editar($idpersona, $tipopersona, $nombre, $tipodocumento, $numdocumento, $direccion, $telefono, $email);
			echo $rspta ? "Persona actualizado" : "Categoria no se pudo actualizar";
		}
	break;

	case 'eliminar':
			$rspta = $persona->desactivar($idpersona);
			echo $rspta ? "Persona eliminada": "Error al eliminar";
		break;

	case 'mostrar':
		$rspta = $persona->mostrar ($idpersona);
		echo json_encode($rspta);

		break;
		case 'listarp':
			$rspta = $persona-> listarp();
			$data  = Array();
		 while ($reg = $rspta -> fetch_object() ) {
			$data[] = array(
			"0"=>'<button class = "btn btn-warning" onclick ="mostrar(' . $reg->idpersona . ')" ><i class="fa fa-pencil"></i></button>' . ' <button class = "btn btn-danger" onclick ="eliminar(' . $reg->idpersona . ')" ><i class="fa fa-trash"></i></button>',
			"1"=>$reg->nombre,
			"2"=>$reg->tipo_docuento,
            "3"=>$reg->num_documento,
            "4"=>$reg->telefono,
            "5"=>$reg->email
		 );
		 }
			$results  = array(
				"sEcho"=>1,
				"iTotalRecords"=>count($data),
				"iTotalDisplyRecords"=>count($data),
				"aaData"=>$data
			);
			echo json_encode($results);
            break;
            case 'listarc':
			$rspta = $persona-> listarca();
			$data  = Array();
		 while ($reg = $rspta -> fetch_object() ) {
			$data[] = array(
			"0"=>'<button class = "btn btn-warning" onclick ="mostrar(' . $reg->idpersona . ')" ><i class="fa fa-pencil"></i></button>' . ' <button class = "btn btn-danger" onclick ="eliminar(' . $reg->idpersona . ')" ><i class="fa fa-trash"></i></button>',
			"1"=>$reg->nombre,
			"2"=>$reg->tipo_docuento,
            "3"=>$reg->num_documento,
            "4"=>$reg->telefono,
            "5"=>$reg->email
		 );
		 }
			$results  = array(
				"sEcho"=>1,
				"iTotalRecords"=>count($data),
				"iTotalDisplyRecords"=>count($data),
				"aaData"=>$data
			);
			echo json_encode($results);
			break;

}

?>
