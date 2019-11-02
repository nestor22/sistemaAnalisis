var tabla;
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
    });
    $.post("../ajax/ingreso.php?op=selectProveedor", function(r){
        $("#idproveedor").html(r);
        $("#idproveedor").selectpicker('refresh');
    });

}
function limpiar()
{
	$("#idproveedor").val("");
	$("#proveedor").val("");
	$("#serie_comrobante").val("");
	$("#num_comprobante").val("");
	$("#fecha_hora").val("");
	$("#impuesto").val("");
	$("#total_compra").val("");
	$(".filas").remove();
	$("#total").html("0");
	


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
		listarArticulos();

		$("#guardar").hide();
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		//detalles=0;
		$("#btnAgregarArt").show();
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
					url: '../ajax/ingreso.php?op=listar',
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
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
			url: "../ajax/ingreso.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {
	          alert(datos);
	          mostrarform(false);
			  tabla.ajax.reload();
			  listar();
	    }
	});
	limpiar();
}
function mostrar(idingreso)
{
	$.post("../ajax/ingreso.php?op=mostrar",{idarticulo : idarticulo}, function(data, status)
	{
	data = JSON.parse(data);
	mostrarform(true);
	$("#idcategoria").val(data.idcategoria);
	$("#idcategoria").selectpicker('refresh');
	$("#codigo").val(data.codigo);
	$("#nombre").val(data.nombre);
	$("#stock").val(data.stock);
	$("#descripcion").val(data.descripcion);
	$("#imagenmuestra").show();
	$("#imagenmuestra").attr("src", "../files/articulos/"+data.imagen);
	$("#imagenactual").val(data.imagen);
	$("#idarticulo").val(data.idarticulo);
})
}
function anular(idingreso){
	bootbox.confirm("Esta seguro que deces anular el ingreso?", function(result){
		if(result){
			$.post("../ajax/ingreso.php?op=anular",{idingreso : idingreso}, function(e){
				bootbox.alert(e);
				tabla.ajax.reload();

			});
		}
	})
}
function listarArticulos()
{
	tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,
	    "aServerSide": true,
	    dom: 'Bfrtip',
	    buttons: [           
		        ],
		"ajax":
				{
					url: '../ajax/ingreso.php?op=selectArticulos',
					type : "get",
						dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 4,
	    "order": [[ 0, "desc" ]]
	}).DataTable();
}

var impupesto=12;
var cont=0;
var detalles=0;

$("#guardar").hide();
$("#tipo_comprobante").change(marcarImpuesto);
function marcarImpuesto(){
	var tipo_comprobante =$("#tipo_comprobante option:selected").text();
	if(tipo_comprobante=='Factura'){
		$("#impuesto").val(impuesto);
	}else{
		$("#impuesto").val("0");
	}
}
function agregarDetalle(idarticulo, articulo){
	var cantidad=1;
	var precio_compra=1;
	var precio_venta=1;

	if(idarticulo!="")
	{
		var subtotal=cantidad*precio_compra;
		var fila = '<tr class="files" id="fila'+cont+'"> '+ 
			'<td><button type="button" class="btn btn-danger" onclick="elinarDetaller('+cont+')" >X</button></td>'+
			'<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
			'<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
			'<td><input type="number" name="precio_compra[]" id="precio_compra[]" value="'+cantidad+'"></td>'+
			'<td><input type="number" name="precion_venta[]" id="precio_venta[]" value="'+cantidad+'"></td>'+
			'<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</td>'+
			'<td><button type="button" onclick="modificarSubtotales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'
		+ '</tr>';
		cont++;
		detalles=detalles+1
		$('#detalles').append(fila);
		modificarSubtotales();
	}else {
		alert("error al ingresar el detalle");
	}

}
function modificarSubtotales(){
	var cant=document.getElementsByName("cantidad[]");
	var prec=document.getElementsByName("precio_compra[]");
	var sub=document.getElementsByName("subtotal");
	

	for (var i=0; i<cant.length; i++){
		var inpC=cant[i];
		var inpP=prec[i];
		var inpS=sub[i];
		inpS.value=inpC.value*inpP.value;
		document.getElementsByName("subtotal")[i].innerHTML=inpS.value;

	}
	calcularTotales();

}
function calcularTotales(){
	var sub = document.getElementsByName("subtotal");
	var total = 0.0;

	for(var i=0;i<sub.length; i++){
		total+=document.getElementsByName("subtotal")[i].value;

	}
	$("#total").html("Q/." + total);
	$("#total_compra").val(total);
	evaluar();
}
function evaluar(){
	if (detalles>0){
		$("#btnGuardar").show();
	}else {
		$("#btnGuardar").hide();
		cont=0;
	}
}
function eliminarDetalle(){
	$("#fila"+indice).remove();
	calcularTotales();
	detalles=detalles-1;
}
init();
