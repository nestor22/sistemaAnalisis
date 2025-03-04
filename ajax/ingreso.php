<?php
if(strlen(session_id())<1){
session_start();
}
	require_once "../modelos/Ingreso.php";
	$ingreso = new Ingreso();

    $idingreso = isset($_POST["idingreso"])?limpiarCadena($_POST["idingreso"]):"";
    $idproveedor = isset($_POST["idproveedor"])?limpiarCadena($_POST["idproveedor"]):"";
    $idusuario = $_SESSION['idusuario'];
    $tipo_comprobante = isset($_POST["tipo_comprobante"])?limpiarCadena($_POST["tipo_comprobante"]):"";
    $serie_comprobante = isset($_POST["serie_comprobante"])?limpiarCadena($_POST["serie_comprobante"]):"";
    $num_comprobante = isset($_POST["num_comprobante"])?limpiarCadena($_POST["num_comprobante"]):"";
    $fecha_hora = isset($_POST["fecha_hora"])?limpiarCadena($_POST["fecha_hora"]):"";
    $impuesto = isset($_POST["impuesto"])?limpiarCadena($_POST["impuesto"]):"";
    $total_compra = isset($_POST["total_compra"])?limpiarCadena($_POST["total_compra"]):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($idingreso)){
			$rspta=$ingreso->insertar($idproveedor,$idusuario,$tipo_comprobante,$serie_comprobante,$num_comprobante,$fecha_hora,$impuesto,$total_compra,$_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_compra"],$_POST["precio_venta"]);
			echo $rspta ? "Ingreso registrado" :"No se pudo registrar";
		}
		else {
		}
	break;

	case 'anular':
			$rspta = $ingreso->anular($idingreso);
			echo $rspta ? "Ingreso Anulado": "Error al anular";
		break;
	case 'mostrar':
		$rspta = $ingreso->mostrar($idingreso);
		echo json_encode($rspta);

		break;
		case 'listar':
			$rspta = $ingreso->listar();
			$data  = Array();
		 while ($reg = $rspta->fetch_object() ) {
			$data[] = array(
			"0"=>($reg->estado=='Aceptado') ? '<button class = "btn btn-warning" onclick ="mostrar(' . $reg->idingreso . ')" ><i class="fa fa-pencil"></i></button>' . ' <button class = "btn btn-danger" onclick ="anular(' . $reg->idingreso . ')" ><i class="fa fa-close"></i></button>':'<button class = "btn btn-warning" onclick ="mostrar(' . $reg->idingreso . ')" ><i class="fa fa-pencil"></i></button>',
			"1"=>$reg->fecha,
            "2"=>$reg->proveedor,
            "3"=>$reg->usuario,
            "4"=>$reg->tipo_comprobante,
            "5"=>$reg->serie_comprobante . '-' . $reg->num_comprobante,
            "6"=>$reg->total_compra,
			"7"=>($reg->estado=='Aceptado') ? '<span class = "label bg-green">Aceptado</span>':'<span class = "label bg-red">Anulado</span>'
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
            case 'selectProveedor':
                require_once "../modelos/Persona.php";
                $persona = new Persona();
                $rspta = $persona->listarp();
                while($reg = $rspta->fetch_object()){
                    echo ('<option value="' . $reg->idpersona . '">' . $reg->nombre . '</option>');
                }

			break;
			case 'selectArticulos':
				require_once "../modelos/Articulo.php";
				$articulo = new Articulo();
				$rspta = $articulo->listarActivos();
				$data =Array();
				while ($reg=$rspta->fetch_object()) {
				  $data[]=array(
					"0"=>'<button class="btn btn-warning" onclick="agregarDetalle(' . $reg->idarticulo . ',\'' . $reg->nombre . '\')"><span class="fa fa-plus"></span></button>',
					"1"=>$reg->nombre,
					"2"=>$reg->categoria,
					"3"=>$reg->codigo,
					"4"=>$reg->stock,
					"5"=>"<img src='../files/articulos/" . $reg->imagen . "' heigth='50px' width='50px'>",
				  );
				}
				$results = array(
				  "sEcho"=>1,
				  "iTotalRecords"=>count($data),
				  "iTotalDisplayRecords"=>count($data),
				  "aaData"=>$data
				 );
				 echo json_encode($results);
			break;

}

?>
