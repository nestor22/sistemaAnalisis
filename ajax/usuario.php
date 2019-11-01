<?php
  require_once "../modelos/Usuario.php";
  $usuario = new Usuario();
  $idusuario = isset($_POST["idusuario"])?limpiarCadena($_POST["idusuario"]):"";
  $nombre = isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
  $tipo_documento = isset($_POST["tipo_documento"])?limpiarCadena($_POST["tipo_documento"]):"";
  $num_documento = isset($_POST["num_documento"])?limpiarCadena($_POST["num_documento"]):"";
  $direccion = isset($_POST["direccion"])?limpiarCadena($_POST["direccion"]):"";
  $telefono = isset($_POST["telefono"])?limpiarCadena($_POST["telefono"]):"";
  $email = isset($_POST["email"])?limpiarCadena($_POST["email"]):"";
  $cargo = isset($_POST["cargo"])?limpiarCadena($_POST["cargo"]):"";
  $login = isset($_POST["login"])?limpiarCadena($_POST["login"]):"";
  $clave  = isset($_POST["clave"])?limpiarCadena($_POST["clave"]):"";
  $imagen = isset($_POST["imagen"])?limpiarCadena($_POST["imagen"]):"";
  switch ($_GET["op"]) {
    case 'guardaryeditar':
    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/users/" . $imagen)."";
			}
    }
    //  encriptacion sha256
    $clavehas=hash("SHA256", $clave);
      if(empty($idusuario))
      {
        $rspta = $usuario->insertar($nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, $login, $clavehas, $imagen, $_POST['permiso']);
        echo $rspta ? "Usuario Registrado":"usuario no se puede registrar";

      } else{
        $rspta = $usuario->editar($idusuario, $nombre, $tipo_documento, $num_documento, $direccion, $telefono, $email, $cargo, $login, $clavehas, $imagen, $_POST['permiso']);
        echo $rspta ? "Usuario actualizado":"Articulo no se puede editar";
      }
    break;
    case 'desactivar':
    $rspta = $usuario->desactivar($idusuario);
    echo $rspta ? "Usuario Desactivado":"Articulo no se puede Desactivar";
    break;
    case 'activar':
    $rspta = $usuario->activar($idusuario);
    echo $rspta ? "Usuario activado":"Articulo no se puede Desactivar";
    break;
    case 'mostrar':
    $rspta = $usuario->mostrar($idusuario);
		echo json_encode($rspta);
    break;
    case 'listar':
    $rspta = $usuario->listar();
    $data =Array();
    while ($reg=$rspta->fetch_object()) {
      $data[]=array(
        "0"=>($reg->condicion)?'<button class = "btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')"><i class="fa fa-pencil"></i></button> ' . ' <button class = "btn btn-danger" onclick="desactivar(' . $reg->idusuario . ')"><i class="fa fa-close"></i></button>':'<button class = "btn btn-warning" onclick="mostrar(' . $reg->idusuario . ')"><i class="fa fa-pencil"></i></button> ' . ' <button class = "btn btn-primary" onclick="activar(' . $reg->idusuario . ')"><i class="fa fa-check"></i></button>',
        "1"=>$reg->nombre,
        "2"=>$reg->tipo_documento,
        "3"=>$reg->num_documento,
        "4"=>$reg->cargo,
        "5"=>"<img src='../files/users/" . $reg->imagen . "' heigth='50px' width='50px'>",
        "6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
    case 'permisos':
     require_once "../modelos/Permiso.php";
     $permiso = new Permiso();
     $rspta = $permiso->listar();
     $id = $_GET['id'];
     if (!empty($id)){
       $marcados = $usuario->listamarcados($id);
       $valores = array();
       while($per = $marcados->fetch_object()){
        array_push($valores, $per->idpermiso);
       }
       while ($reg = $rspta->fetch_object()){
        $sw = in_array($reg->idpermiso, $valores)?'checked':'';
        echo '<li><input type="checkbox" ' . $sw . ' name ="permiso[]" value="' . $reg->idpermiso .'">' . $reg->nombre . '</li>';
       }
     }else {
       while ($reg = $rspta->fetch_object()){
        echo '<li><input type="checkbox" name ="permiso[]" value="' . $reg->idpermiso .'">' . $reg->nombre . '</li>';
       }
     }

    break;
    case 'verificar':
      $logina = $_POST['logina'];
      $clavea = $_POST['clavea'];
      $clavehash = hash("SHA256", $clavea);
      $rspta = $usuario->verificar($logina, $clavehash);
      $fetch = $rspta->fetch_object();
      if(isset($fetch)){
        $_SESSION['idusuario']=$fetch->idusuario;
        $_SESSION['nombre']=$fetch->nombre;
        $_SESSION['imagen']=$fetch->imagen;
        $_SESSION['login']=$fetch->login;
      }
      echo json_encode($fetch);

    break;

    }
 ?>
