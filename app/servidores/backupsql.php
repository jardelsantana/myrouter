<?php

//echo 'ola';
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(E_ERROR | E_PARSE | E_WARNING );

if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
  echo  $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('backups'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado


    $nomedoarquivo = base64_decode($_GET['arq']);
    $url = "backups/$nomedoarquivo";
    unlink("$url");

    header("Location: index.php?app=Backupsql&reg=3");
}

?>





        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Backupsql</li>
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
          <h1>Backups <small>MyRouter ERP</small></h1>
        </div>

        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">

            <a href="backups/bckgen.php" class="btn btn-info">NOVO BACKUP</a><br><br>

            <div class="powerwidget blue" id="" data-widget-editbutton="false">

              <header>
                <h2>Gerenciar<small>Backups</small></h2>
              </header>

              <div class="inner-spacer">

                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Servidor</th>
                      <th>Data</th>
                      <th>Chave</th>
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
    $idempresa = $_SESSION['empresa'];
    $consultas = $mysqli->query("SELECT * FROM backups WHERE servidor = 'MyRouterERP' ORDER BY data DESC");
    while($campo = mysqli_fetch_array($consultas)){

        ?>
        <tr>
            <td><?php echo $campo['servidor']; ?></td>
            <td><?php echo $campo['data']; ?></td>
            <td><?php echo $campo['regkey']; ?></td>

            <td>

                <a href="assets/download.php?arquivo=../backups/<?php echo $campo['arquivo']; ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Download do Arquivo"><i class="fa fa-file"></i></a>&nbsp;

                <?php if($logado['nivel'] == '1') { ?>
                    <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=Backupsql&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del&arq=<?php echo base64_encode($campo['arquivo']); ?>' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
                <?php } ?>
            </td>
        </tr>

    <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                     <th>Servidor</th>
                      <th>Data</th>
                      <th>Chave</th>
                      <th width="110">Ações</th>
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