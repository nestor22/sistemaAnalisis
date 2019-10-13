var tabla;
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
	$.post("../ajax/articulo.php?op=selectCategoria", function(r){
		$("#idcategoria").html(r);
		$("#idcategoria").selectpicker('refresh');
	});
}
function limpiar()
{
	$("#codigo").val("");
	$("#stock").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{

		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/articulo.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
			url: "../ajax/articulo.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          alert(datos);
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar (idarticulo)
{
	$.post("../ajax/articulo.php?op=mostrar",{idarticulo : idarticulo}, function(data, status)
	{
	data = JSON.parse(data);
	mostrarform(true);
	$("#idarticulo").val(data.nombres);
	$("#codigo").val(data.nombres);
	$("#stock").val(data.nombres);
	$("#nombre").val(data.nombres);
	$("#nombre").val(data.nombres);
	$("#descripcion").val(data.descripcion);
	$("#idcategoria").val(data.idcategoria);

	})
}
function desactivar(idarticulo){
	bootbox.confirm("Esta seguro que deces desactivar el articulo?", function(result){
		if(result){
			$.post("../ajax/articulo.php?op=desactivar",{idarticulo : idarticulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}
	})
}
function activar(idarticulo){
	bootbox.confirm("Esta seguro que deces activar el articulo?", function(result){
		if(result){
			$.post("../ajax/categoria.php?op=activar",{idarticulo : idarticulo}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})

}
init();
