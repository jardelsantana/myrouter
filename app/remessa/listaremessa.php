<?php
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1");
?>

<div class="breadcrumb clearfix">
  <ul>
    <li><a href="index.php?app=Dashboard">Dashboard</a></li>
    <li class="active">Arquivo Remessa</li>
  </ul>
</div>

<?php if($permissao['c1'] == S) { ?>

        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Cliente cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Cliente alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Cliente excluído com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '4') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Cliente possui assinaturas ativas, não é possível excluir. </div>
	<?php } ?>

        <div class="page-header">
          <h1>Arquivo Remessa</h1>
        </div>

        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">

            <div class="powerwidget blue" id="" data-widget-editbutton="false">

              <header>
                <h2>Gerenciar<small>Arquivo Remessa</small></h2>
              </header>

              <div class="inner-spacer">

                 <div class="btn-group">
	<button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bars"></i> EXPORTAR </button>
	<ul class="dropdown-menu " role="menu">
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'json',escape:'false'});"> <img src='assets/images/json.png' width='24px'> JSON</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'xml',escape:'false',ignoreColumn:'[6]'});"> <img src='assets/images/xml.png' width='24px'> XML</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'sql'});"> <img src='assets/images/sql.png' width='24px'> SQL</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'csv',escape:'false'});"> <img src='assets/images/csv.png' width='24px'> CSV</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'txt',escape:'false'});"> <img src='assets/images/txt.png' width='24px'> TXT</a></li>
	<li class="divider"></li>

	<li><a href="#" onClick ="$('#table-1').tableExport({type:'excel',escape:'false'});"> <img src='assets/images/xls.png' width='24px'> XLS</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'doc',escape:'false'});"> <img src='assets/images/word.png' width='24px'> Word</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'powerpoint',escape:'false'});"> <img src='assets/images/ppt.png' width='24px'> PowerPoint</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'png',escape:'false'});"> <img src='assets/images/png.png' width='24px'> PNG</a></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src='assets/images/pdf.png' width='24px'> PDF</a></li>
		</ul>
		</div>	<br>
	      <br>

                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Arquivo Remessa</th>

                      <th width="155">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
    <?php
if(isset($_GET['arquivo'])){
		$file = $_GET['arquivo'];

		unlink("app/remessa/".$file);

		echo "<META HTTP-EQUIV=REFRESH CONTENT='0; URL=index.php?app=ListarRemessa'>";

}


$itens = glob('app/remessa/*.REM');
if ($itens !== false) {
    foreach ($itens as $item) {
		$arq = explode("/", $item);
			 $arquivo = $arq[2];

	   ?>
	   <tr>
    <td width="1031"><i class="icon-fixed-width icon-file-text pull-left icon-border" style="color:green;"></i> <?php echo $arquivo ?></td>
    <td width="145" align="center">
      <a href="app/remessa/dwonload_remessa.php?download=<?php echo $arquivo  ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Download"><i class="entypo-download"></i></a>
      <a href="index.php?app=ListarRemessa&arquivo=<?php echo $arquivo  ?>" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir" onclick="return confirm('Deseja realmente deletar o arquivo?')"><i class="entypo-trash"></i></a></td>
  </tr>

	<?php

	   }

   }


?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Arquivo Remessa</th>

                      <th width="80">Ações</th>
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