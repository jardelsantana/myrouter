
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=NFSe">Nota Fiscal</a></li>
            <li class="active">NFSe</li>
          </ul>
        </div>
        
        <?php if($permissao['fr2'] == S) { ?>
        
        <?php if ($_GET['reg'] == '1') { ?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Lote Nota Fiscal cadastrado com sucesso. </div>
	<?php } ?>
	<?php if ($_GET['reg'] == '3') { ?>
	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	<i class="fa fa-times-circle"></i></button>
        <strong>Atenção!</strong> Lote Nota Fiscal excluído com sucesso. </div>
	<?php } ?>

            <?php if ($_GET['reg'] == '4') { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times-circle"></i></button>
                    <strong>Atenção!</strong> A Nota Fiscal foi excluído com sucesso. </div>
            <?php } ?>

            <?php if ($_GET['reg'] == '5') { ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times-circle"></i></button>
                    <strong>Atenção!</strong> A Nota Fiscal foi Alterada com sucesso. </div>
            <?php } ?>

        
        <div class="page-header">
          <h1>NFSe de Comunicação</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            <a href="index.php?app=CadastroNFSe" class="btn btn-info">GERAR NOVO LOTE DE NF</a><br><br>
            <div class="powerwidget" id="" data-widget-editbutton="false">
              <header>
                <h2>Gerenciar<small>NF</small></h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th>Número</th>
                      <th>QTD</th>
                      <th>Mês</th>
                      <th>Ano</th>
                      <th>Lote</th>
                      <th>Autenticação</th>
                      <th width="320">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
 		  $consultas = $mysqli->query("SELECT * FROM notafiscal group by nlote order by id DESC");
 		  while($campo = mysqli_fetch_array($consultas)){
		  $nlote = $campo['nlote'];
		  $qtds = $mysqli->query("SELECT * FROM notafiscal WHERE nlote = '$nlote'");
 		  $row = mysqli_num_rows($qtds);
		  ?>
		  <tr>
		  <td><?php echo $campo['nlote']; ?></td>
		  <td><?php echo $row; ?> NFs</td>
		  
                      <td>
		      <?php if($campo['mesrps'] == '01') { ?>Janeiro<?php } ?>
		      <?php if($campo['mesrps'] == '02') { ?>Fevereiro<?php } ?>
		      <?php if($campo['mesrps'] == '03') { ?>Março<?php } ?>
		      <?php if($campo['mesrps'] == '04') { ?>Abril<?php } ?>
		      <?php if($campo['mesrps'] == '05') { ?>Maio<?php } ?>
		      <?php if($campo['mesrps'] == '06') { ?>Junho<?php } ?>
		      <?php if($campo['mesrps'] == '07') { ?>Julho<?php } ?>
		      <?php if($campo['mesrps'] == '08') { ?>Agosto<?php } ?>
		      <?php if($campo['mesrps'] == '09') { ?>Setembro<?php } ?>
		      <?php if($campo['mesrps'] == '10') { ?>Outubro<?php } ?>
		      <?php if($campo['mesrps'] == '11') { ?>Novembro<?php } ?>
		      <?php if($campo['mesrps'] == '12') { ?>Dezembro<?php } ?>
		      </td>
		      
                      <td><?php echo $campo['anorps']; ?></td>
                      <td><?php echo $campo['lote']; ?></td>
                   <td><?php echo md5($campo['nlote']); ?></td>
              
	      <td>
              <a href="xml-nfse.php?id=<?php echo base64_encode($campo['nlote']); ?>" class="btn btn-success tooltiped" data-toggle="tooltip" data-placement="top" title="Gerar XML RPS NFSe" target=_blank><i class="entypo-download"></i></a>&nbsp;
             
	      	 <a href="javascript:void(0);" onclick="javascript: if (confirm('Deseja realmente excluir esse registro ?')) { window.location.href='?app=CadastroNFSe&nlote=<?php echo base64_encode($campo['nlote']); ?>&Ex=Del' } else { void('') };" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Excluir"><i class="entypo-trash"></i></a>

              <a href="app/notafiscal/exportar_clie_nf.php?id=<?php echo base64_encode($campo['nlote']); ?>" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Gerar CLIE_NF - DIGINOTA" target=_blank><i class="entypo-print"></i></a>&nbsp;
              <a href="app/notafiscal/exportar_fatp_nf.php?id=<?php echo base64_encode($campo['nlote']); ?>" class="btn btn-warning tooltiped" data-toggle="tooltip" data-placement="top" title="Gerar FATP_NF - DIGINOTA" target=_blank><i class="entypo-print"></i></a>&nbsp;
              <a href="app/notafiscal/exportar_nf.php?id=<?php echo base64_encode($campo['nlote']); ?>" class="btn btn-danger tooltiped" data-toggle="tooltip" data-placement="top" title="Gerar Nota Fiscal" target=_blank><i class="entypo-print"></i></a>&nbsp;

          </td>
                    </tr>
                   
		  <?php  } ?>

                  </tbody>
                  <tfoot>
                    <tr>
                    <th>Número</th>
                    <th>QTD</th>
                      <th>Mês</th>
                      <th>Ano</th>
                      <th>Lote</th>
                      <th>Autenticação</th>
                      <th width="320">Ações</th>
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