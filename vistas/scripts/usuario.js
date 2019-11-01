var tabla;
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	})
    $("#imagenmuestra").hide();
    $.post("../ajax/usuario.php?op=permisos&id=", function(r){
        $("#permiso").html(r);
    });
}
function limpiar()
{
	$("#idusuario").val("");
	$("#nombre").val("");
    $("#tipo_documento").val("");
    $("#num_documento").val("");
    $("#direccion").val("");
    $("#telefono").val("");
    $("#email").val("");
    $("#cargo").val("");
    $("#login").val("");
    $("#clave").val("");
	$("#imagenactual").val("");
	$("#imagenmuestra").attr("src", "");
}
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
					url: '../ajax/usuario.php?op=listar',
					type : "get",
						dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
function guardaryeditar(e)
{
	e.preventDefault();
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
			url: "../ajax/usuario.php?op=guardaryeditar",
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
function mostrar(idusuario)
{
	$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
	data = JSON.parse(data);
	mostrarform(true);
	$("#idusuairo").val(data.idusuario);
	$("#nombre").val(data.nombre);
	$("#tipo_documento").val(data.tipo_documento);
	$("#tipo_documento").selectpicker('refresh');
    $("#num_documento").val(data.num_documento);
    $("#direccion").val(data.direccion);
    $("#telefono").val(data.telefono);
    $("#email").val(data.email);
    $("#cargo").val(data.cargo);
    $("#login").val(data.login);
    $("#clave").val(data.clave);
	$("#imagenmuestra").show();
	$("#imagenmuestra").attr("src", "../files/users/"+data.imagen);
	$("#imagenactual").val(data.imagen);

})
$.post("../ajax/usuario.php?op=permisos&id="+idusuario, function(r){
		$("#permiso").html(r);
});
}
function desactivar(idusuario){
	bootbox.confirm("Esta seguro que deces desactivar el usuario?", function(result){
		if(result){
			$.post("../ajax/usuario.php?op=desactivar",{idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
function activar(idusuairo){
	bootbox.confirm("Esta seguro que deces activar el usuario?", function(result){
		if(result){
			$.post("../ajax/usuario.php?op=activar",{idusuario : idusuario}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
	})
}
init();
