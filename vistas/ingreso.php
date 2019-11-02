<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"])) {
header("location: login.html");
}else{

require 'header.php';

if ($_SESSION['compras']==1){

?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Ingresos / Compras <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Fecha</th>
                          <th>Proveedor</th>
                          <th>Usuario</th>
                          <th>Tipo Comprobante</th>
                          <th>Numero de Documento</th>
                          <th>Total</th>
                          <th>Estado</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <th>Opciones</th>
                          <th>Fecha</th>
                          <th>Proveedor</th>
                          <th>Usuario</th>
                          <th>Tipo Documento</th>
                          <th>Numero de Documento</th>
                          <th>Total</th>
                          <th>Estado</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario"  method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Proveedor(*):</label>
                            <input type="hidden" name="idingreso" id="idingreso">
                            <select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true" required ></select>

                          </div>

                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>fecha(*):</label>
                            <input class="form-control" type="date" name="fecha_hora" id="fecha_hora" required>

                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Comprobante(*):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" data-live-search="true" required >
                                <option value="Boleta">Boleta</option>
                                <option value="Facutura">Factura</option>
                                <option value="Ticket">Ticket</option>
                            </select>

                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Serie(*):</label>
                            <input class="form-control" type="text" name="serie_documento" id="serie_documento"  required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Numero(*):</label>
                            <input class="form-control" type="text" name="num_documento" id="num_documento" required>
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Impuesto(*):</label>
                            <input class="form-control" type="text" name="impuesto" id="impuesto" required>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                           <a href="#myModal" data-toggle="modal">
                            <button id="btnAregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span>Agregar Articulos</button>
                           </a>
                           </div>

                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" >
                           <thead style="background-color:#A9D0F5">
                            <th>Opciones</th>
                            <th>Articulos</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>subtotal</th>
                           </thead>
                           <tfoot>
                           <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><H4 id="total" >Q/. 0.00</H4><input type="hidden" name="total_compra" id="total_compra"></th>
                           </tfoot>
                           <tbody>
                           
                           </tbody>
                           </table>
                           </div>
                          <div class="from-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="guardar">
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                              <i class="fa fa-save"></i> Guardar</button>

                              <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button">
                                <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>


                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<!-- Modoal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
        <h4 class="modal-title">Seleccione un Articulo</h4>
      </div>
      <div class="modal-body" >
        <table id="tblarticulos" class = "table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Opciones</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Codigo</th>
            <th>Stock</th>
            <th>Imagen</th>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <th>Opciones</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Codigo</th>
            <th>Stock</th>
            <th>Imagen</th>
          </tfoot>
        </table>
      </div>
      <div  class="modal-footer" >
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>

</div>
<!-- Fin Modoal -->


<?php
}
else
{
  require 'noacceso.php';
}
  require 'footer.php';
?>
<script type="text/javascript" src="scripts/ingreso2.js">
</script>
<?php }
//ob_end_flush();
 ?>
