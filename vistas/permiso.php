<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"])) {
header("location: login.html");
}else{

require 'header.php';
if($_SESSION["acceso"]==1){

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
                          <h1 class="box-title">Permisos </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                        <thead>

                          <th>Nombre</th>

                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>

                          <th>Nombre</th>


                        </tfoot>
                      </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario"  method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idcategoria" id="idcategoria">
                            <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="nombre" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripcion(*):</label>
                            <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="100" placeholder="nombre" required>

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
<script type="text/javascript" src="scripts/permiso.js">
</script>
<?php }
ob_end_flush();
 ?>
