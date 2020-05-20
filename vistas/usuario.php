 <?php
 //ob_start();
 //session_start();
// if (!isset($_SESSION["nombre"])) {
 //header("location: login.html");
 //}else{

require 'header.php';
//if($_SESSION['acceso']==1){

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
                          <h1 class="box-title">Usuario <button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
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
                          <th>Tipo de Documento</th>
                          <th>Numero Documento</th>
                          <th>Cargo</th>
                          <th>Imagen</th>
                          <th>Condicion</th>

                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <th>Opciones</th>
                          <th>Nombre</th>
                          <th>Tipo de Documento</th>
                          <th>Numero Documento</th>
                          <th>Cargo</th>
                          <th>Imagen</th>
                          <th>Condicion</th>
                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario"  method="POST">
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idusuario" id="idusuairo">
                            <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo  Documento(*):</label>
                            <select id="tipo_documento" name="tipo_documento" class="form-control selectpicker" data-live-search="true"  required>
                            <option value="DPI">DPI</option>
                            <option value="NIT">NIT</option>
                            <option value="CODIGO">Codigo empleado</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Numero documento(*):</label>
                            <input class="form-control" type="text" name="num_documento" id="num_documento"  required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Direccion:</label>
                            <input class="form-control" type="text" name="direccion" id="direccion" maxlength="70" placeholder="direccion">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>telefono:</label>
                            <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Email:</label>
                            <input class="form-control" type="email" name="email" id="email" maxlength="40" placeholder="email">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cargo:</label>
                            <input class="form-control" type="text" name="cargo" id="cargo" maxlength="70" placeholder="cargo">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Login:</label>
                            <input class="form-control" type="text" name="login" id="login" maxlength="70" placeholder="Nombre Usuario" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>clave:</label>
                            <input class="form-control" type="password" name="clave" id="clave" maxlength="70" placeholder="clave" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Permisos:</label>
                          <ul style="list-style:none;" id="permiso">
                          </ul>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input class="form-control" type="file" name="imagen" id="imagen">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            <img src="" alt="Imagen Articulo" width="150px" height="120px" id="imagenmuestra">
                          </div>

                          </div>

                          <div class="from-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                              <i class="fa fa-save"></i> Guardar</button>

                              <button class="btn btn-danger" onclick="cancelarform()" type="button">
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
//}else {
  //require 'noacceso.php';
//}
  require 'footer.php';
?>
<script type="text/javascript" src="scripts/usuario.js">
</script>
<?php //}
//ob_end_flush();
 ?>
