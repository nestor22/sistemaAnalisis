<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"])) {
header("location: login.html");
}else{

require 'header.php';
if($_SESSION['compras']==1){

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
                          <h1 class="box-title">Proveedores<button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                          <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Tipo Documento</th>
                          <th>Numero Documento</th>
                          <th>Telefono </th>
                          <th>Email</th>

                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Tipo Documento</th>
                          <th>Numero Documento</th>
                          <th>Telefono </th>
                          <th>Email</th>

                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario"  method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idpersona" id="idpersona">
                            <input type="hidden" name="tipopersona" id="tipopersona" value="Proveedor">
                            <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de Documento(*):</label>
                            <select name="tipodocumento" id="tipodocumento" class="form-control select-picker" required>
                            <option value="DPI">DPI</option>
                            <option value="NIT">NIT</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Numero Documento:</label>
                            <input class="form-control" type="text" name="numdocumento" id="numdocumento" maxlength="70" placeholder="direccion" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Direccion:</label>
                            <input class="form-control" type="text" name="direccion" id="direccion" maxlength="70" placeholder="direccion">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                            <input class="form-control" type="text" name="telefono" id="telefono" maxlength="10" placeholder="12334567">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email:</label>
                            <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="ejemplo@ejemplo.com">
                          </div>


                          <div class="from-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                              <i class="fa fa-save"></i> Guardar</button>

                              <button class="btn btn-danger" onclick="cancelarform()"                           type="button">
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

<?php
}else {
  require 'noacceso.php';
}
  require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/proveedor.js">
</script>
<?php }
ob_end_flush();
 ?>
