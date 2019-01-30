<?php $paginaLink = $_SERVER['QUERY_STRING'];?>
<!-- active -->
<div class="responsive-admin-menu">
        <div class="responsive-menu">MyRouter
          <div class="menuicon"><i class="fa fa-angle-down"></i></div>
        </div>
        
      <ul id="menu">
      	  
      	  <li><a class="<?php if($paginaLink == 'app=Dashboard') {echo 'active';} ?>" href="index.php?app=Dashboard" title="Dashboard"><i class="entypo-monitor "></i><span> Dashboard</span></a></li>
         
         <?php if($permissao['financeiro'] == S) { ?>
         <li><a class="submenu <?php if($paginaLink == 'app=LivroCaixa') {echo 'active';} ?><?php if($paginaLink == 'app=Financeiro') {echo 'active';} ?><?php if($paginaLink == 'app=Retorno') {echo 'active';} ?>" href="#" title="Financeiro" data-id="financeiro-sub"><i class="fa fa-money"></i><span> Financeiro</span></a>
            <ul id="financeiro-sub" class="accordion">

                <?php if($permissao['ft1'] == S) { ?>
                    <li><a href="index.php?app=CadastroBoleto" title="Gerar Boleto Avulso"><i class="fa fa-plus-square"></i><span> Gerar Fatura Avulsa</span></a></li>
                <?php } ?>

              <?php if($permissao['f1'] == S) { ?>
              <li><a href="index.php?app=Financeiro" title="Gerenciar Faturas"><i class="fa fa-tasks"></i><span> Gerenciar Faturas </span></a></li>
              <?php } ?>
              
              <?php if($permissao['f2'] == S) { ?>
              <li><a href="index.php?app=LivroCaixa" title="Livro Caixa"><i class="fa fa-tasks"></i><span> Livro Caixa</span></a></li>	
              <?php } ?>
              
              <?php if($permissao['f3'] == S) { ?>
              <li><a href="index.php?app=Retorno" title="Retorno de Boletos"><i class="fa fa-tasks"></i><span> Retorno de Boletos</span></a></li>
              <?php } ?>



                <?php if($permissao['fr2'] == S) { ?>
                    <li><a href="index.php?app=NFSe" title="Nota Fiscal"><i class="fa fa-file-archive-o"></i><span>Nota Fiscal</span></a></li>
                <?php } ?>


                <li><a href="#" data-id="sub-remessa" title="Remessa" class="submenu"><i class="entypo-archive"></i><span>Remessa</span></a>
                    <ul id="sub-remessa">

                        <!-- GERANDO REMESSA -->
                        <?php if($permissao['f3'] == S) { ?>
                            <li><a href="index.php?app=Remessa" title="Gerar Remessa"><i class="fa fa-tasks"></i><span> Gerar Remessa</span></a></li>
                        <?php } ?>
                        <!-- Listar remessa -->
                        <?php if($permissao['f3'] == S) { ?>
                            <li><a href="index.php?app=ListarRemessa" title="Gerar Remessa"><i class="fa fa-tasks"></i><span> Listar Remessa</span></a></li>
                        <?php } ?>
                        <!-- FIM REMESSA -->
                    </ul>
                </li>

            </ul>
          </li>  
          <?php } ?>
	  
         <?php if($permissao['assinaturas'] == S) { ?>
	 <li><a class="submenu <?php if($paginaLink == 'app=Assinaturas') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroAssinatura') {echo 'active';} ?>" href="#" title="Assinaturas" data-id="assina-sub"><i class="fa fa-ticket"></i><span> Assinaturas</span></a>
            <ul id="assina-sub">
              <?php if($permissao['a1'] == S) { ?>
              <li><a href="index.php?app=CadastroAssinatura" title="Adicionar Assinatura"><i class="fa fa-plus-square"></i><span> Nova Assinatura</span></a></li>
              <?php } ?>
              <?php if($permissao['a2'] == S) { ?>
              <li><a href="index.php?app=Assinaturas" title="Gerenciar Assinaturas"><i class="fa fa-tasks"></i><span> Lista Assinaturas</span></a></li>
              <?php } ?>
            </ul>
          </li>   
	  <?php } ?>

	    <?php if($permissao['faturas'] == S) { ?>
	  <!-- <li><a class="submenu <?php if($paginaLink == 'app=Boletos') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroBoleto') {echo 'active';} ?>" href="#" title="Boletos" data-id="boletos-sub"><i class="fa fa-file-o"></i><span>Faturas Avulsas</span></a>
            <ul id="boletos-sub">
            <?php if($permissao['ft1'] == S) { ?>
              <li><a href="index.php?app=CadastroBoleto" title="Gerar Boleto Avulso"><i class="fa fa-plus-square"></i><span> Gerar Fatura Avulsa</span></a></li>
              <?php } ?>
              <?php if($permissao['ft2'] == S) { ?>
              <li><a href="index.php?app=Boletos" title="Gerenciar Boletos"><i class="fa fa-tasks"></i><span> Gerenciar Faturas</span></a></li>
              <?php } ?>
            </ul>
          </li>   -->
          <?php } ?>
	 
	 
	 <?php if($permissao['clientes'] == S) { ?>   
         <li><a class="submenu <?php if($paginaLink == 'app=Clientes') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroCliente') {echo 'active';} ?>" href="#" title="Clientes" data-id="clientes-sub"><i class="fa fa-group"></i><span> Cliente</span></a>
            <ul id="clientes-sub">
              <?php if($permissao['c1'] == S) { ?>
              <li><a href="index.php?app=CadastroCliente" title="Adicionar Cliente"><i class="fa fa-user"></i><span> Adicionar Cliente</span></a></li>
              <?php } ?>
              <?php if($permissao['c2'] == S) { ?>
              <li><a href="index.php?app=Clientes" title="Gerenciar Clientes"><i class="fa fa-group"></i><span> Gerenciar Clientes</span></a></li>
              <?php } ?>
            </ul>
          </li>  
          <?php } ?>
          
    	  <?php if($permissao['tecnicos'] == S) { ?>
          <li><a class="submenu <?php if($paginaLink == 'app=Tecnicos') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroTecnico') {echo 'active';} ?>" href="#" title="Técnicos" data-id="tecnico-sub"><i class="fa fa-user"></i><span> Técnicos</span></a>
            <ul id="tecnico-sub">
            <?php if($permissao['t1'] == S) { ?>
              <li><a href="index.php?app=CadastroTecnico" title="Adicionar Tecnico"><i class="fa fa-user"></i><span> Novo Tecnico</span></a></li>
              <?php } ?>
              <?php if($permissao['t2'] == S) { ?>
              <li><a href="index.php?app=Tecnicos" title="Gerenciar Tecnicos"><i class="fa fa-user"></i><span> Gerenciar Tecnicos</span></a></li>
              <?php } ?>
            </ul>
          </li> 
          <?php } ?>
          
          <?php if($permissao['fornecedores'] == S) { ?>
          <li><a class="submenu <?php if($paginaLink == 'app=Fornecedores') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroFornecedor') {echo 'active';} ?>" href="#" title="Fornecedores" data-id="fornecedor-sub"><i class="fa fa-truck"></i><span> Fornecedores</span></a>
            <ul id="fornecedor-sub">
            <?php if($permissao['fo1'] == S) { ?>
              <li><a href="index.php?app=CadastroFornecedor" title="Adicionar Fornecedor"><i class="fa fa-truck"></i><span> Novo Fornecedor</span></a></li>
              <?php } ?>
              <?php if($permissao['fo2'] == S) { ?>
              <li><a href="index.php?app=Fornecedores" title="Gerenciar Fornecedores"><i class="fa fa-truck"></i><span> Lista Fornecedores</span></a></li>
              <?php } ?>
            </ul>
          </li>  
          <?php } ?>
         
	 <?php if($permissao['ordemservico'] == S) { ?> 
         <li><a class="submenu <?php if($paginaLink == 'app=OrdemServicos') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroOS') {echo 'active';} ?>" href="#" title="Ordem de Serviços" data-id="os-sub"><i class="fa  fa-fax"></i><span> Ordem de Serviços</span></a>
            <ul id="os-sub">
            <?php if($permissao['os1'] == S) { ?>
              <li><a href="index.php?app=CadastroOS" title="Adicionar Ordem de Serviços"><i class="fa fa-file"></i><span> Adicionar O.S</span></a></li>
              <?php } ?>
              <?php if($permissao['os2'] == S) { ?>
              <li><a href="index.php?app=OrdemServicos" title="Gerenciar Ordem de Serviços"><i class="fa fa-calendar"></i><span> Gerenciar O.S</span></a></li>
              <?php } ?>

                <?php if($permissao['os2'] == S) { ?>
                    <li><a href="index.php?app=EncerradasOS" title="Gerenciar Ordem de Serviços Encerradas"><i class="fa fa-times-circle-o"></i><span>O.S Encerradas</span></a></li>
                <?php } ?>

            </ul>
          </li>  
          <?php } ?>
          
          
          <?php if($permissao['planos'] == S) { ?>
          <li><a class="submenu <?php if($paginaLink == 'app=Planos') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroPlano') {echo 'active';} ?>" href="#" title="Planos" data-id="planos-sub"><i class="entypo-rocket"></i><span> Planos</span></a>
            <ul id="planos-sub">
            <?php if($permissao['p1'] == S) { ?>
              <li><a href="index.php?app=CadastroPlano" title="Adicionar Plano"><i class="entypo-rocket"></i><span> Adicionar Plano</span></a></li>
              <?php } ?>
              <?php if($permissao['p2'] == S) { ?>
              <li><a href="index.php?app=Planos" title="Gerenciar Planos"><i class="fa fa-file"></i><span> Gerenciar Planos</span></a></li>
              <?php } ?>
            </ul>
          </li>     
          <?php } ?>
              
         <?php if($permissao['equipamentos'] == S) { ?>     
         <li><a class="submenu <?php if($paginaLink == 'app=Equipamentos') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroEquipamento') {echo 'active';} ?>" href="#" title="Equipamentos" data-id="equipamento-sub"><i class="fa fa-keyboard-o"></i><span> Equipamentos</span></a>
            <ul id="equipamento-sub">
            <?php if($permissao['e1'] == S) { ?>
              <li><a href="index.php?app=CadastroEquipamento" title="Cadastro de Equipamento"><i class="fa fa-pencil-square-o"></i><span> Novo Equipamento</span></a></li>
              <?php } ?>

              <?php if($permissao['e2'] == S) { ?>
              <li><a href="index.php?app=Equipamentos" title="Gerenciar Equipamentos"><i class="fa fa-print"></i><span> Lista Equipamentos</span></a></li>
              <?php } ?>

                <?php if($permissao['e1'] == S) { ?>
                    <li><a href="index.php?app=ListaFabricante" title="Fabricantes"><i class="fa fa-folder"></i><span> Fabricantes</span></a></li>
                <?php } ?>

            </ul>
          </li>     
          <?php } ?>
        
       	  <?php if($permissao['ferramentas'] == S) { ?>
	  <li><a class="submenu <?php if($paginaLink == 'app=Mapas') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroSICI') {echo 'active';} ?><?php if($paginaLink == 'app=SICI') {echo 'active';} ?><?php if($paginaLink == 'app=API') {echo 'active';} ?><?php if($paginaLink == 'app=BLOCK') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroNFSe') {echo 'active';} ?><?php if($paginaLink == 'app=NFSe') {echo 'active';} ?><?php if($paginaLink == 'app=Backups') {echo 'active';} ?>" href="#" title="Ferramentas" data-id="ferramentas-sub"><i class="fa fa-cubes"></i><span> Ferramentas</span></a>
            <ul id="ferramentas-sub">
              <?php if($permissao['fr1'] == S) { ?>
              <li><a href="index.php?app=SICI" title="Coleta de Dados"><i class="fa fa-file-archive-o"></i><span>Coleta de Dados (SICI)</span></a></li>
              <?php } ?>

             
             <?php if($permissao['fr3'] == S) { ?>
              <li><a href="index.php?app=BLOCK" title="Bloqueio de Sites"><i class="fa fa-file-archive-o"></i><span>Bloqueio de Sites</span></a></li>
              <?php } ?>
             
             <?php if($permissao['fr4'] == S) { ?>
             <li><a href="index.php?app=Mapas" title="Mapa dos Clientes"><i class="fa fa-globe"></i><span>Mapa dos Clientes</span></a></li>
             <?php } ?>

                <?php if($permissao['fr4'] == S) { ?>
                    <li><a href="index.php?app=Fibra" title="Mapa da Fibra"><i class="fa fa-globe"></i><span>Mapa da Fibra</span></a></li>
                <?php } ?>
             
             <?php if($permissao['fr5'] == S) { ?>
             <li><a href="index.php?app=Backups" title="Backups Mikrotik"><i class="fa fa-file"></i><span>Backups Mikrotik</span></a></li>
             <?php } ?>

                <?php if($permissao['fr5'] == S) { ?>
                    <li><a href="index.php?app=Backupsql" title="Backups MyRouter ERP"><i class="fa fa-file"></i><span>Backups MyRouter ERP</span></a></li>
                <?php } ?>

                <?php if($permissao['fr5'] == S) { ?>
                    <li><a href="index.php?app=Newsletter" title="Mala Direta"><i class="fa fa-envelope"></i><span>Mala Direta</span></a></li>
                <?php } ?>
             
             <?php if($permissao['fr6'] == S) { ?>
             <li><a href="index.php?app=API" title="WebServices"><i class="fa fa-globe"></i><span>WebServices</span></a></li>
             <?php } ?>

                <?php if($permissao['fr6'] == S) { ?>
                    <li><a href="index.php?app=LogsHistorico" title="Histórico do Sistema"><i class="fa fa-file"></i><span>Histórico do Sistema</span></a></li>
                <?php } ?>

            </ul>
          </li>       
	  <?php } ?>  
         
	 <!--  MENU MikroTik -->

	 <?php if($permissao['mikrotik'] == S) { ?>     
         <li> <a class="submenu <?php if($paginaLink == 'app=Servidores') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroServidor') {echo 'active';} ?><?php if($paginaLink == 'app=IPARP') {echo 'active';} ?><?php if($paginaLink == 'app=Scripts') {echo 'active';} ?><?php if($paginaLink == 'app=Pool') {echo 'active';} ?><?php if($paginaLink == 'app=ControlePool') {echo 'active';} ?><?php if($paginaLink == 'app=ControleBanda') {echo 'active';} ?><?php if($paginaLink == 'app=CadastroScript') {echo 'active';} ?><?php if($paginaLink == 'app=PPP') {echo 'active';} ?><?php if($paginaLink == 'app=HOTSPOT') {echo 'active';} ?><?php if($paginaLink == 'app=Interface') {echo 'active';} ?>" href="#" data-id="interface-sub" title="Interface"><i class="glyphicon glyphicon-cog"></i><span> Mikrotik</span></a> 
         
         <ul id="interface-sub" class="accordion">
         <?php if($permissao['mk1'] == S) { ?>     
         <li><a href="index.php?app=Servidores" title="Gerenciar Servidores"><i class="glyphicon glyphicon-registration-mark"></i><span> Servidores & RBs </span></a></li>
         <?php } ?>
         
         <?php if($permissao['mk2'] == S) { ?>   
         <li><a href="index.php?app=Scripts" title="Gerenciar Scripts"><i class="fa fa-bug"></i><span> Scripts </span></a></li>		
         <?php } ?>

             <?php if($permissao['mk2'] == S) { ?>
                 <li><a href="index.php?app=NatMKPRINT" title="Firewall Nat"><i class="fa fa-fire"></i><span> Firewall Nat </span></a></li>
             <?php } ?>
         
         <?php if($permissao['mk3'] == S) { ?>   
         <li><a href="index.php?app=ControleBanda" title="Controle de Banda"><i class="fa fa-cloud-download"></i><span> Controle de Banda </span></a></li>
	 <?php } ?>
	 
	 <?php if($permissao['mk4'] == S) { ?>   
	 <li><a href="index.php?app=Pool" title="Classes de IPs Pool"><i class="fa fa-retweet"></i><span> IPs Pool </span></a></li>   <?php } ?>	
         
         <?php if($permissao['mk5'] == S) { ?>   
         <li><a href="#" data-id="interface" title="Interfaces do Mikrotik" class="submenu"><i class="entypo-flow-tree"></i><span> Interfaces</span></a>
                <ul id="interface">
                <?php
                $idempresa = $_SESSION['empresa'];
                $menuconsiparp = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		while($interface = mysqli_fetch_array($menuconsiparp)){
 		?>
                 <li><a href="index.php?app=Interface&id=<?php echo base64_encode($interface['id']); ?>" title=""><i class="entypo-gauge"></i><span><?php echo $interface['servidor']; ?></span></a></li>
                <?php } ?>  
                </ul>
              </li>
              <?php } ?>
         
         <?php if($permissao['mk6'] == S) { ?>   
         <li><a href="#" data-id="logs" title="Logs do Mikrotik" class="submenu"><i class="entypo-key "></i><span> Histórico</span></a>
                <ul id="logs">
                <?php
                $idempresa = $_SESSION['empresa'];
                $menuconsiparp = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		while($logs = mysqli_fetch_array($menuconsiparp)){
 		?>
                 <li><a href="index.php?app=LOGS&id=<?php echo base64_encode($logs['id']); ?>" title=""><i class="entypo-key "></i><span><?php echo $logs['servidor']; ?></span></a></li>
                <?php } ?>  
                </ul>
              </li>
         <?php } ?>
          
	  <?php if($permissao['mk7'] == S) { ?>       
          <li><a href="#" data-id="ip-arp" title="IP/ARP" class="submenu"><i class="fa fa-sliders"></i><span> IP/ARP</span></a>
                <ul id="ip-arp">
                <?php
                $idempresa = $_SESSION['empresa'];
                $menuconsiparp = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		while($iparp = mysqli_fetch_array($menuconsiparp)){
 		?>
                 <li><a href="index.php?app=IPARP&id=<?php echo base64_encode($iparp['id']); ?>" title=""><i class="fa fa-bars"></i><span><?php echo $iparp['servidor']; ?></span></a></li>
                <?php } ?>  
                </ul>
              </li>
              <?php } ?>
              
              <?php if($permissao['mk8'] == S) { ?>   
              <li><a href="#" data-id="wlan" title="Conectados Tabela Wireless" class="submenu"><i class="fa fa-sliders"></i><span>Conectados </span></a>
                <ul id="wlan">
                <?php
                $idempresa = $_SESSION['empresa'];
                $menuconsiparpwlan = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		while($wlan = mysqli_fetch_array($menuconsiparpwlan)){
 		?>
                 <li><a href="index.php?app=Wireless&id=<?php echo base64_encode($wlan['id']); ?>" title=""><i class="fa fa-bars"></i><span><?php echo $wlan['servidor']; ?></span></a></li>
                <?php } ?>  
                </ul>
              </li>
              <?php } ?>

              <?php if($permissao['mk9'] == S) { ?>   
              <li><a href="#" data-id="hotspot" title="Hot Spot" class="submenu"><i class="fa fa-sliders"></i><span> HotSpot </span></a>
                <ul id="hotspot">
                <?php
                $idempresa = $_SESSION['empresa'];
                $menuconsiparp = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		while($hotspot = mysqli_fetch_array($menuconsiparp)){
 		?>
                 <li><a href="index.php?app=HOTSPOT&id=<?php echo base64_encode($hotspot['id']); ?>" title=""><i class="fa fa-bars"></i><span><?php echo $hotspot['servidor']; ?></span></a></li>
                <?php } ?>  
                </ul>
              </li>
              <?php } ?>
              
              <?php if($permissao['mk10'] == S) { ?>   
              <li><a href="#" data-id="ppp" title="PPPoE" class="submenu"><i class="fa fa-sliders"></i><span> PPPoE</span></a>
                <ul id="ppp">
                <?php
                $idempresa = $_SESSION['empresa'];
                $menuconsiparp = $mysqli->query("SELECT * FROM servidores WHERE empresa = '$idempresa'");
 		while($pppoe = mysqli_fetch_array($menuconsiparp)){
 		?>
                 <li><a href="index.php?app=PPP&id=<?php echo base64_encode($pppoe['id']); ?>" title=""><i class="fa fa-bars"></i><span><?php echo $pppoe['servidor']; ?></span></a></li>
                <?php } ?>  
                </ul>
              </li>
              <?php } ?>
              
            </ul>
          </li>
          <?php } ?>



          <?php if($permissao['cupons'] == S) { ?>
              <li><a class="submenu <?php if($paginaLink == 'app=Ubiquiti') {echo 'active';} ?><?php if($paginaLink == 'app=Ubiquiti') {echo 'active';} ?>" href="#" title="Ubiquiti" data-id="ubiquiti-sub"><i class="fa fa-signal"></i><span> Ubiquiti</span></a>
                  <ul id="ubiquiti-sub">
                      <?php if($permissao['cu1'] == S) { ?>
                          <li><a href="index.php?app=Ubiquiti" title="Nível de Sinal"><i class="fa fa-bar-chart"></i><span> Nível de Sinal </span></a></li>
                          <li><a href="index.php?app=UbiquitiRel" title="Relatório de IP"><i class="fa fa-file"></i><span> Relatório de IP </span></a></li>
<!--                          <li><a href="index.php?app=CadastroUbiquiti" title="Cadastro"><i class="fa fa-desktop"></i><span> Cadastro de Router </span></a></li>-->
                          <li><a href="index.php?app=ServidoresUBNT" title="Lista Route"><i class="fa fa-desktop"></i><span> Cadastro EdgeRoute </span></a></li>



                      <?php } ?>
                  </ul>
              </li>
          <?php } ?>


          <?php if($permissao['cupons'] == S) { ?>
              <li><a class="submenu <?php if($paginaLink == 'app=Juniper') {echo 'active';} ?><?php if($paginaLink == 'app=Juniper') {echo 'active';} ?>" href="#" title="Juniper" data-id="juniper-sub"><i class="glyphicon glyphicon-cog"></i><span> Juniper</span></a>
                  <ul id="juniper-sub">
                      <?php if($permissao['cu1'] == S) { ?>
                          <!-- <li><a href="index.php?app=Ubiquiti" title="Nível de Sinal"><i class="fa fa-bar-chart"></i><span> Nível de Sinal </span></a></li>-->
                         <!--  <li><a href="index.php?app=UbiquitiRel" title="Relatório de IP"><i class="fa fa-file"></i><span> Relatório de IP </span></a></li>-->
                         <!--                          <li><a href="index.php?app=CadastroUbiquiti" title="Cadastro"><i class="fa fa-desktop"></i><span> Cadastro de Router </span></a></li>-->
                          <li><a href="index.php?app=BRASJUNOS" title="Lista Route"><i class="fa fa-desktop"></i><span> Cadastro BRAS-JUNOS </span></a></li>



                      <?php } ?>
                  </ul>
              </li>
          <?php } ?>




          <?php if($permissao['cupons'] == S) { ?>   
          <li><a class="submenu <?php if($paginaLink == 'app=CadastroHotspot') {echo 'active';} ?><?php if($paginaLink == 'app=Hotspots') {echo 'active';} ?>" href="#" title="HotSpots" data-id="hotspot-sub"><i class="fa fa-wifi"></i><span> Cupons Hotspots</span></a>
            <ul id="hotspot-sub">
            <?php if($permissao['cu1'] == S) { ?>   
              <li><a href="index.php?app=CadastroHotspot" title="Adicionar Cliente"><i class="fa fa-file"></i><span> Adicionar Hotspot</span></a></li>
              <?php } ?>
              <?php if($permissao['cu2'] == S) { ?>   
              <li><a href="index.php?app=Hotspots" title="Gerenciar Clientes"><i class="fa fa-newspaper-o"></i><span> Gerenciar Hotspots</span></a></li>
              <?php } ?>
            </ul>
          </li>  
          <?php } ?>
	  
	   <?php if($permissao['relatorios'] == S) { ?>   
	   <li><a class="submenu <?php if($paginaLink == 'app=Relatorios') {echo 'active';} ?>" href="#" title="Relatórios" data-id="relatorio-sub"><i class="fa fa-bullhorn"></i><span> Relatórios</span></a>
            <ul id="relatorio-sub" class="accordion">

              <?php if($permissao['r4'] == S) { ?>   
              <li><a href="index.php?app=Relatorios&relatorio=relatorio_clientesassinantes" title="Relatório Clientes Assinates"><i class="fa fa-file"></i><span>Clientes Assinantes</span></a></li>
              <?php } ?>
              <?php if($permissao['r5'] == S) { ?>   
              <li><a href="index.php?app=Relatorios&relatorio=relatorio_planosvclientes" title="Relatório Planos x Clientes"><i class="fa fa-file"></i><span>Planos x Clientes</span></a></li>
             <?php } ?>
             <?php if($permissao['r6'] == S) { ?>   
	         <li><a href="index.php?app=Relatorios&relatorio=relatorio_financeiromes" title="Relatório Movimento do Caixa"><i class="fa fa-file"></i><span>Movimento do Caixa</span></a></li>
              <?php } ?>
              <?php if($permissao['r7'] == S) { ?>   
              <li><a href="index.php?app=Relatorios&relatorio=relatorio_retornos" title="Relatório Retornos Bancários"><i class="fa fa-file"></i><span>Retornos Bancários</span></a></li> 
              <?php } ?>



                <?php if($permissao['r2'] == S) { ?>
                    <li><a href="index.php?app=Relatorios&relatorio=log_conexao" title="Relatório Conexão"><i class="fa fa-file"></i><span>Relatório Conexão</span></a></li>
                <?php } ?>

                <?php if($permissao['r2'] == S) { ?>
                    <li><a href="index.php?app=Relatorios&relatorio=relatorio_comodato" title="Clientes x Comodato"><i class="fa fa-file"></i><span>Clientes x Comodato</span></a></li>
                <?php } ?>

                <?php if($permissao['r2'] == S) { ?>
                    <li><a href="index.php?app=Relatorios&relatorio=relatorio_clientesassinantesbloqueio" title="Assinaturas Bloqueada"><i class="fa fa-file"></i><span>Assinaturas Bloqueada</span></a></li>
                <?php } ?>

                <li><a href="#" data-id="sub-relatorio" title="Faturas" class="submenu"><i class="entypo-archive"></i><span>Faturas</span></a>
                    <ul id="sub-relatorio">

                        <?php if($permissao['r2'] == S) { ?>
                            <li><a href="index.php?app=Relatorios&relatorio=relatorio_fatura_data" title="Relatório Faturas por Vencimento"><i class="fa fa-file"></i><span>Por Vencimento</span></a></li>
                        <?php } ?>

                        <?php if($permissao['r2'] == S) { ?>
                            <li><a href="index.php?app=Relatorios&relatorio=relatorio_por_data" title="Relatório Faturas por Data"><i class="fa fa-file"></i><span>Por Data</span></a></li>
                        <?php } ?>

                        <?php if($permissao['r1'] == S) { ?>
                            <li><a href="index.php?app=Relatorios&relatorio=relatorio_ativos" title="Relatórios Faturas em Aberto"><i class="fa fa-file"></i><span>Faturas Abertas</span></a></li>
                        <?php } ?>
                        <?php if($permissao['r2'] == S) { ?>
                            <li><a href="index.php?app=Relatorios&relatorio=relatorio_pagos" title="Relatório Faturas Pagas"><i class="fa fa-file"></i><span>Faturas Pagas</span></a></li>
                        <?php } ?>
                        <?php if($permissao['r3'] == S) { ?>
                            <li><a href="index.php?app=Relatorios&relatorio=relatorio_bloqueios" title="Relatório Faturas Bloqueadas"><i class="fa fa-file"></i><span>Faturas Bloqueadas</span></a></li>
                        <?php } ?>

                    </ul>
                </li>

            </ul>
          </li>  
	  <?php } ?> 
          
   	  
   	  <?php if($logado['nivel'] == 1) { ?>     
          <li><a class="submenu <?php if($paginaLink == 'app=Permissoes') {echo 'active';} ?>" href="#" title="Permissões de Usuário" data-id="permissao-sub"><i class="fa fa-lock"></i><span> Permissões</span></a>
            <ul id="permissao-sub">
          
              <li><a href="index.php?app=Permissoes" title="Gerenciar Permissões"><i class="fa fa-file"></i><span> Gerenciar Permissões</span></a></li>
           
            </ul>
          </li>  
	  	          
          <li><a class="<?php if($paginaLink == 'app=Sistema') {echo 'active';} ?>" href="index.php?app=Sistema" title="Sistema"><i class="entypo-tools "></i><span> Configurar Sistema</span></a></li>
          <?php } ?>
          
          
        </ul>
      </div>