var tabla;
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
}
function limpiar()
{
	$("#nombre").val("");
	$("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
	$("#idpersona").val("");
    
    
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
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/persona.php?op=listarp',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,
	    "order": [[ 0, "desc" ]]
	}).DataTable();
}
function guardaryeditar(e)
{
	e.preventDefault(); 
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
			url: "../ajax/persona.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {
	          bootbox.alert(datos);
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar (idpersona)
{
	$.post("../ajax/persona.php?op=mostrar",{idpersona : idpersona}, function(data, status)
	{
	data = JSON.parse(data);
	mostrarform(true);
    $("#nombre").val(data.nombre);
    $("#tipodocumento").val(data.tipo_documento);
    $("#tipodocumento").selectpicker('refresh');
	$("#numdocumento").val(data.num_documento);
	$("#direccion").val(data.direccion);
	$("#telefono").val(data.telefono);
	$("#email").val(data.email);
    $("#idpersona").val(data.idpersona);

	})
}
function eliminar(idpersona){
	bootbox.confirm("Esta seguro que deces eliminar al proveedor?", function(result){
		if(result){
			$.post("../ajax/persona.php?op=desactivar",{idpersona : idpersona}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}
	})

}
init();