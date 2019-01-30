<?php

?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">LOGS</li>
          </ul>
        </div>

        <?php if($permissao['fr5'] == S) { ?>


    <?php if ($_GET['reg'] == '3') { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Backup excluído com sucesso. </div>
    <?php } ?>

    <?php if ($_GET['reg'] == '4') { ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Backup do MyRouter ERP realizado com sucesso. </div>
    <?php } ?>

        <div class="page-header">
          <h1>LOGS <small>MyRouter ERP</small></h1>
        </div>

        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">
            <div class="powerwidget blue" id="" data-widget-editbutton="false">

              <header>
                <h2>Visualizar<small>LOGS</small></h2>
              </header>

              <div class="inner-spacer">

                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>LOGIN</th>
                      <th>IP</th>
                      <th>DATA</th>
                      <th>AÇÃO</th>
                      <th>DETALHES</th>
                      <th>QUERY</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
    $idempresa = $_SESSION['empresa'];
    $consultas = $mysqli->query("SELECT * FROM log ORDER BY id DESC");
    while($campo = mysqli_fetch_array($consultas)){

        ?>
        <tr>
            <td><?php echo $campo['admin']; ?></td>
            <td><?php echo $campo['ip']; ?></td>
            <td><?php echo $campo['data']; ?></td>
             <td><?php echo $campo['acao']; ?></td>
            <td><?php echo $campo['detalhes']; ?></td>
            <td><?php echo $campo['query']; ?></td>
        </tr>

    <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>LOGIN</th>
                      <th>IP</th>
                      <th>DATA</th>
                      <th>AÇÃO</th>
                      <th>DETALHES</th>
                      <th>QUERY</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>


      <?php } else { ?>

    <div class="page-header">
        <h1>Permissão <small>Negada!</small></h1>
    </div>

    <div class="row" id="powerwidgets">
        <div class="col-md-12 bootstrap-grid">

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    <i class="fa fa-times-circle"></i></button>
                <strong>Atenção!</strong> Você não possui permissão para esse modulo. </div>

        </div></div>
<?php } ?>