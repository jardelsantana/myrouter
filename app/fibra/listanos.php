<div class="breadcrumb clearfix">
    <ul>
        <li><a href="index.php?app=Dashboard">Dashboard</a></li>
        <li><a href="?app=Fibra">Fibra</a></li>

        <li class="active">No</li>
    </ul>
</div>

<?php if($permissao['e1'] == S) { ?>

    <?php if ($_GET['reg'] == '1') { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> No cadastrado com sucesso. </div>
    <?php } ?>
    <?php if ($_GET['reg'] == '2') { ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> No alterado com sucesso. </div>
    <?php } ?>
    <?php if ($_GET['reg'] == '3') { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> No excluído com sucesso. </div>
    <?php } ?>
        
        <div class="page-header">
          <h1>Nos</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>Fibra</small></h2>
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
                      <th>#</th>
                      <th>Nome do No</th>
                      <th>Cor</th>
                      <th>Espessura</th>
                      <th width="20%">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

    $idempresa = $_SESSION['empresa'];
    $consultas = $mysqli->query("SELECT * FROM fib_no WHERE empresa = '$idempresa'");
    while($campo = mysqli_fetch_array($consultas)){

        ?>
        <tr>
            <td><?php echo $campo['id']; ?></td>
            <td><?php echo $campo['desc_ponto']; ?></td>
            <td><?php echo $campo['cor']; ?></td>
            <td><?php echo $campo['esplinha']; ?></td>
            <td>
                <a href="?app=CadElemento&idno=<?php echo base64_encode($campo['id']); ?>" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Cadastra Elementos do No"><i class="entypo-share"></i></a>&nbsp;
                <a href="#etiqueta<?php echo $campo['id']; ?>" role="button" class="btn btn-success tooltiped" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Imprimir"><i class="entypo-print"></i></a>&nbsp;

                <a href="?app=CadastroFibra&id=<?php echo base64_encode($campo['id']); ?>" class="btn btn-info tooltiped" data-toggle="tooltip" data-placement="top" title="Alterar"><i class="entypo-tools"></i></a>&nbsp;
                <?php if($logado['nivel'] == '1') { ?>
                    <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroFibra&id=<?php echo base64_encode($campo['id']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>
                <?php } ?>

                <div class="modal" id="etiqueta<?php echo $campo['id']; ?>">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                ELEMENTOS DO NO</div>
                            <div class="modal-body text-center">
                                <?php
                                $noid = $campo['id'];
                                $qrElementos = $mysqli->query("SELECT * FROM fib_elementos WHERE id_no = '$noid'");

                                while($teste = mysqli_fetch_array($qrElementos)){
                                    ?>
                                    <div class="text-left">
                                    <?php  echo 'Nome: '.$teste['descricao'].' Latitude: '.$teste['lat'].' Longitude: '.$teste['lon'].'<br>'; ?>
                                    </div>
                                <?php
                                }

                                ?>
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
                      <th>#</th>
                      <th>Nome do no</th>
                      <th>Cor</th>
                      <th>Espessura</th>
                      <th>Ações</th>
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