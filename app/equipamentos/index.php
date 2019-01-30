<style>
@font-face {
    font-family: "codigo";
    src: url("../../assets/BarcodeFont.ttf") format("truetype");
}
</style>
<!--[if IE]>
<style>
@font-face {
    font-family: "codigo";
    src: url("../../assets/BarcodeFont.eot");
}
</style>
<![endif]-->
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li class="active">Clientes</li>
          </ul>
        </div>
        
        <?php if($permissao['e1'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Equipamento cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '2') { ?>
	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Equipamento alterado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Equipamento excluído com sucesso. </div>
	<?php } ?>
        
        <div class="page-header">
          <h1>Equipamentos</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
          <a href="index.php?app=CadastroEquipamento" class="btn btn-info">Cadastro</a>
            <p></p>
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Equipamentos</small></h2>
              </header>
              <div class="inner-spacer">
              
                    <div class="btn-group">
	<button class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown">
	<i class="fa fa-bars"></i> EXPORTAR </button>
	<ul class="dropdown-menu " role="menu">
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'json',escape:'false'});"> <img src='assets/images/json.png' width='24px'> JSON</a></li>
	<li class="divider"></li>
	<li><a href="#" onClick ="$('#table-1').tableExport({type:'xml',escape:'false'});"> <img src='assets/images/xml.png' width='24px'> XML</a></li>
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
                      <th width="80">Etiqueta</th>
                      <th>Equipamento</th>
                      <th>Nota Fiscal</th>
                      <th>Fabricante</th>
                      <th>Status</th>
                      <th width="110">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  
 		  $idempresa = $_SESSION['empresa'];
 		  $consultas = $mysqli->query("SELECT * FROM equipamentos WHERE empresa = '$idempresa'");
 		  while($campo = mysqli_fetch_array($consultas)){
		  
		  ?>
		  <tr>
		     <td><span style="font-family:codigo;font-size:20px;"><?php echo $campo['barcode']; ?></span></td>
                     <td><?php echo $campo['equipamento']; ?></td>
                      <td><?php echo $campo['notafiscal']; ?></td>

                                             <td>
		      <?php
		      $ids = $campo['fabricante'];
		      $cfab = $mysqli->query("SELECT * FROM fabricante WHERE id = '$ids'");
 		      $cfabricante = mysqli_fetch_array($cfab);
 		      ?><?php echo $cfabricante['nome']; ?></td>


		      <td><?php if ($campo['status'] == 'S') { ?>Disponível<?php } else { ?>Indisponível<?php } ?> </td>
                      <td>
              <a href="#etiqueta<?php echo $campo['id']; ?>" role="button" class="btn btn-success tooltiped" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Imprimir"><i class="entypo-print"></i></a>&nbsp;        
        	      
	      <a href="?app=CadastroEquipamento&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
	      <?php if($logado['nivel'] == '1') { ?> 
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroEquipamento&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
	      <?php } ?>

<div class="modal" id="etiqueta<?php echo $campo['id']; ?>">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       IMPRESSÃO ETIQUETA</div>
      <div class="modal-body text-center">
      <iframe src="app/etiqueta.php?et=<?php echo $campo['barcode']; ?>" width="100%" height="210" frameborder="0"></iframe>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

	      
		      </td>
                    </tr>
                    

                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Etiqueta</th>
                      <th>Equipamento</th>
                      <th>Nota Fiscal</th>
                      <th>Fabricante</th>
                      <th>Status</th>
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