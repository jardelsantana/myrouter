<div class="breadcrumb clearfix">
    <ul>
        <li><a href="index.php?app=Dashboard">Dashboard</a></li>
        <li class="active">Ubiquiti</li>
    </ul>
</div>
<?php if($permissao['cu1'] == S) { ?>

    <?php if ($_GET['reg'] == '1') { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Registro cadastrado com sucesso. </div>
    <?php } ?>
    <?php if ($_GET['reg'] == '2') { ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Registro alterado com sucesso. </div>
    <?php } ?>
    <?php if ($_GET['reg'] == '3') { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Registro excluído com sucesso. </div>
    <?php } ?>
        
        <div class="page-header">
          <h1>Ubiquiti</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget blue" id="" data-widget-editbutton="false">
            
              <header>
                <h2>Relatório<small>UBNT</small></h2>
              </header>
              
              <div class="inner-spacer">
    <button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bars"></i> EXPORTAR </button>
	<ul class="dropdown-menu " role="menu">
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'json',escape:'false'});"> <img src='assets/images/json.png' width='24px'> JSON</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'xml',escape:'false',ignoreColumn:'[7]'});"> <img src='assets/images/xml.png' width='24px'> XML</a></li>
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
                      <th>Login/Assinante</th>
                      <th>IP/Equipamento</th>
                      <th>Porta/Equipamento</th>
                      <th>Login/Equipamento</th>
                      <th>Senha/Equipamento</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

        $consultas = $mysqli->query("SELECT * FROM assinaturas WHERE ip_ubnt <> ''");
        while($campo = mysqli_fetch_array($consultas)){
        $row = mysqli_num_rows($consultas);

            ?>
            <tr>
                <td><?php echo $campo['login']; ?></td>
                <td><?php echo $campo['ip_ubnt']; ?></td>
                <td><?php echo $campo['porta_ubnt']; ?></td>
                <td><?php echo $campo['login_ubnt']; ?></td>
                <td><?php echo $campo['senha_ubnt'];?></td>
            </tr>

        <?php
        }

    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Login/Assinante</th>
                      <th>IP/Equipamento</th>
                       <th>Porta/Equipamento</th>
                      <th>Login/Equipamento</th>
                      <th>Senha/Equipamento</th>
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