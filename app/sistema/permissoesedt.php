<?php 
    /*
    Função CRUD
    Atribuição de Permissões
    Ultima Atualização: 03/02/2015
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){

        $alterar = $mysqli->query("SELECT * FROM permissoes WHERE usuario = '$getId'");
        $campo = mysqli_fetch_array($alterar);

    }
	
    if(isset ($_POST['editar'])){

    $permissaoid = $_POST['permissaoid'];


    $financeiro = $_POST['financeiro']? : 'N';
    $f1 = $_POST['f1']? : 'N';
    $f2 = $_POST['f2']? : 'N';
    $f3 = $_POST['f3']? : 'N';
    $assinaturas = $_POST['assinaturas']? : 'N';
    $a1 = $_POST['a1']? : 'N';
    $a2 = $_POST['a2']? : 'N';
    $faturas = $_POST['faturas']? : 'N';
    $ft1 = $_POST['ft1']? : 'N';
    $ft2 = $_POST['ft2']? : 'N';
    $clientes = $_POST['clientes']? : 'N';
    $c1 = $_POST['c1']? : 'N';
    $c2 = $_POST['c2']? : 'N';
    $tecnicos = $_POST['tecnicos']? : 'N';
    $t1 = $_POST['t1']? : 'N';
    $t2 = $_POST['t2']? : 'N';
    $fornecedores = $_POST['fornecedores']? : 'N';
    $fo1 = $_POST['fo1']? : 'N';
    $fo2 = $_POST['fo2']? : 'N';
    $ordemservico = $_POST['ordemservico']? : 'N';
    $os1 = $_POST['os1']? : 'N';
    $os2 = $_POST['os2']? : 'N';
    $planos = $_POST['planos']? : 'N';
    $p1 = $_POST['p1']? : 'N';
    $p2 = $_POST['p2']? : 'N';
    $equipamentos = $_POST['equipamentos']? : 'N';
    $e1 = $_POST['e1']? : 'N';
    $e2 = $_POST['e2']? : 'N';
    $ferramentas = $_POST['ferramentas']? : 'N';
    $fr1 = $_POST['fr1']? : 'N';
    $fr2 = $_POST['fr2']? : 'N';
    $fr3 = $_POST['fr3']? : 'N';
    $fr4 = $_POST['fr4']? : 'N';
    $fr5 = $_POST['fr5']? : 'N';
    $fr6 = $_POST['fr6']? : 'N';
    $mikrotik = $_POST['mikrotik']? : 'N';
    $mk1 = $_POST['mk1']? : 'N';
    $mk2 = $_POST['mk2']? : 'N';
    $mk3 = $_POST['mk3']? : 'N';
    $mk4 = $_POST['mk4']? : 'N';
    $mk5 = $_POST['mk5']? : 'N';
    $mk6 = $_POST['mk6']? : 'N';
    $mk7 = $_POST['mk7']? : 'N';
    $mk8 = $_POST['mk8']? : 'N';
    $mk9 = $_POST['mk9']? : 'N';
    $mk10 = $_POST['mk10']? : 'N';
    $cupons = $_POST['cupons']? : 'N';
    $cu1 = $_POST['cu1']? : 'N';
    $cu2 = $_POST['cu2']? : 'N';
    $relatorios = $_POST['relatorios']? : 'N';
    $r1 = $_POST['r1']? : 'N';
    $r2 = $_POST['r2']? : 'N';
    $r3 = $_POST['r3']? : 'N';
    $r4 = $_POST['r4']? : 'N';
    $r5 = $_POST['r5']? : 'N';
    $r6 = $_POST['r6']? : 'N';
    $r7 = $_POST['r7']? : 'N';
    $home = $_POST['home']? : 'N';

   $sql = "UPDATE `permissoes` SET financeiro='$financeiro',f1='$f1',f2='$f2',f3='$f3',assinaturas='$assinaturas',a1='$a1',a2='$a2',faturas='$faturas',ft1='$ft1',ft2='$ft2',clientes='$clientes',c1='$c1',c2='$c2',tecnicos='$tecnicos',t1='$t1',t2='$t2',fornecedores='$fornecedores',fo1='$fo1',fo2='$fo2',ordemservico='$ordemservico',os1='$os1',os2='$os2',planos='$planos',p1='$p1',p2='$p2',equipamentos='$equipamentos',e1='$e1',e2='$e2',ferramentas='$ferramentas',fr1='$fr1',fr2='$fr2',fr3='$fr3',fr4='$fr4',fr5='$fr5',fr6='$fr6',mikrotik='$mikrotik',mk1='$mk1',mk2='$mk2',mk3='$mk3',mk4='$mk4',mk5='$mk5',mk6='$mk6',mk7='$mk7',mk8='$mk8',mk9='$mk9',mk10='$mk10',cupons='$cupons',cu1='$cu1',cu2='$cu2',relatorios='$relatorios',r1='$r1',r2='$r2',r3='$r3',r4='$r4',r5='$r5',r6='$r6',r7='$r7',home='$home' WHERE codigo ='$permissaoid'";
   echo mysql_query($sql);

   // $crud = new crud('permissoes'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    //$crud->atualizar("financeiro='$financeiro',f1='$f1',f2='$f2',f3='$f3',assinaturas='$assinaturas',a1='$a1',a2='$a2',faturas='$faturas',ft1='$ft1',ft2='$ft2',clientes='$clientes',c1='$c1',c2='$c2',tecnicos='$tecnicos',t1='$t1',t2='$t2',fornecedores='$fornecedores',fo1='$fo1',fo2='$fo2',ordemservico='$ordemservico',os1='$os1',os2='$os2',planos='$planos',p1='$p1',p2='$p2',equipamentos='$equipamentos',e1='$e1',e2='$e2',ferramentas='$ferramentas',fr1='$fr1',fr2='$fr2',fr3='$fr3',fr4='$fr4',fr5='$fr5',fr6='$fr6',mikrotik='$mikrotik',mk1='$mk1',mk2='$mk2',mk3='$mk3',mk4='$mk4',mk5='$mk5',mk6='$mk6',mk7='$mk7',mk8='$mk8',mk9='$mk9',mk10='$mk10',cupons='$cupons',cu1='$cu1',cu2='$cu2',relatorios='$relatorios',r1='$r1',r2='$r2',r3='$r3',r4='$r4',r5='$r5',r6='$r6',r7='$r7'", "usuario='$permissaoid'");

    header("Location: index.php?app=Permissoes&reg=2");
    }

    $idu = base64_decode($_GET['id']);
    $alterar = $mysqli->query("SELECT * FROM permissoes WHERE codigo = '$idu'");
    $campo = mysqli_fetch_array($alterar);

?>

        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="?app=Dashboard">Dashboard</a></li>
            <li><a href="?app=Permissoes">Permissoes</a></li>
            <li class="active">Atribuir</li>
          </ul>
        </div>
        
        <div class="page-header">
          <h1>Permissões<small> Níveis de Acesso</small></h1>
        </div>
        
        <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Atribuir<small>Permissão</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                 
                    <section class="col col-6">
                      <label class="label"><b>Módulo Financeiro</b></label>
                      <div class="inline-group">

		      <label class="checkbox"><input type="checkbox" name="financeiro" value="S" <?php if ($campo['financeiro'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="f1" value="S" <?php if ($campo['f1'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Faturas</label>
		      
		      <label class="checkbox"><input type="checkbox" name="f2" value="S" <?php if ($campo['f2'] == 'S') { echo "checked"; } ?>><i></i>Fluxo de Caixa</label>
		      
		      <label class="checkbox"><input type="checkbox" name="f3" value="S" <?php if ($campo['f3'] == 'S') { echo "checked"; } ?>><i></i>Retorno de Boletos</label>  
                       
                      </div>
                    </section>
                    
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Assinaturas</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="assinaturas" value="S" <?php if ($campo['financeiro'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="a1" value="S" <?php if ($campo['a1'] == 'S') { echo "checked"; } ?>><i></i>Criar Assinaturas</label>
		      
		      <label class="checkbox"><input type="checkbox" name="a2" value="S" <?php if ($campo['a2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Assinaturas</label>
		     
                      </div>
                    </section>
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Faturas</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="faturas" value="S" <?php if ($campo['faturas'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="ft1" value="S" <?php if ($campo['ft1'] == 'S') { echo "checked"; } ?>><i></i>Criar Faturas</label>
		      
		      <label class="checkbox"><input type="checkbox" name="ft2" value="S" <?php if ($campo['ft2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Faturas</label>
		     
                      </div>
                    </section>
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Clientes</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="clientes" value="S" <?php if ($campo['clientes'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="c1" value="S" <?php if ($campo['c1'] == 'S') { echo "checked"; } ?>><i></i>Criar Clientes</label>
		      
		      <label class="checkbox"><input type="checkbox" name="c2" value="S" <?php if ($campo['c2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Clientes</label>
		     
                      </div>
                    </section>
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Técnicos</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="tecnicos" value="S" <?php if ($campo['tecnicos'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="t1" value="S" <?php if ($campo['t1'] == 'S') { echo "checked"; } ?>><i></i>Criar Técnico</label>
		      
		      <label class="checkbox"><input type="checkbox" name="t2" value="S" <?php if ($campo['t2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Técnicos</label>
		     
                      </div>
                    </section>
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Fornecedores</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="fornecedores" value="S" <?php if ($campo['fornecedores'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="fo1" value="S" <?php if ($campo['fo1'] == 'S') { echo "checked"; } ?>><i></i>Criar Fornecedor</label>
		      
		      <label class="checkbox"><input type="checkbox" name="fo2" value="S" <?php if ($campo['fo2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Fornecedores</label>
		     
                      </div>
                    </section>
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Ordem Serviços</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="ordemservico" value="S" <?php if ($campo['ordemservico'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="os1" value="S" <?php if ($campo['os1'] == 'S') { echo "checked"; } ?>><i></i>Criar O.S</label>
		      
		      <label class="checkbox"><input type="checkbox" name="os2" value="S" <?php if ($campo['os2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar O.S</label>
		     
                      </div>
                    </section>
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Planos</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="planos" value="S" <?php if ($campo['planos'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="p1" value="S"  <?php if ($campo['p1'] == 'S') { echo "checked"; } ?>><i></i>Criar Planos</label>
		      
		      <label class="checkbox"><input type="checkbox" name="p2" value="S" <?php if ($campo['p2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Planos</label>
		     
                      </div>
                    </section>
                    
                    
                     <section class="col col-6">
                      <label class="label"><b>Módulo Equipamentos</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="equipamentos" value="S" <?php if ($campo['equipamentos'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="e1" value="S" <?php if ($campo['e1'] == 'S') { echo "checked"; } ?>><i></i>Criar Equipamento</label>
		      
		      <label class="checkbox"><input type="checkbox" name="e2" value="S" <?php if ($campo['e2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Equipamentos</label>
		     
                      </div>
                    </section>
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Ferramentas</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="ferramentas" value="S" <?php if ($campo['ferramentas'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="fr1" value="S" <?php if ($campo['fr1'] == 'S') { echo "checked"; } ?>><i></i>Coleta de Dados SICI</label>
		      
		      <label class="checkbox"><input type="checkbox" name="fr2" value="S" <?php if ($campo['fr2'] == 'S') { echo "checked"; } ?>><i></i>Nota Fiscal RPS</label>
		      
		      <label class="checkbox"><input type="checkbox" name="fr3" value="S" <?php if ($campo['fr3'] == 'S') { echo "checked"; } ?>><i></i>Bloqueio de Sites</label>
		      
		      <label class="checkbox"><input type="checkbox" name="fr4" value="S" <?php if ($campo['fr4'] == 'S') { echo "checked"; } ?>><i></i>Mapa dos Clientes</label>
		      
		      <label class="checkbox"><input type="checkbox" name="fr5" value="S" <?php if ($campo['fr5'] == 'S') { echo "checked"; } ?>><i></i>Backups Mikrotik</label>
		      
		      <label class="checkbox"><input type="checkbox" name="fr6" value="S" <?php if ($campo['fr6'] == 'S') { echo "checked"; } ?>><i></i>WebServices</label>
		     
                      </div>
                    </section>
                    
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Mikrotik</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="mikrotik" value="S" <?php if ($campo['mikrotik'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="mk1" value="S" <?php if ($campo['mk1'] == 'S') { echo "checked"; } ?>><i></i>Servidores Mikrotik</label>
		      
		      <label class="checkbox"><input type="checkbox" name="mk2" value="S" <?php if ($campo['mk2'] == 'S') { echo "checked"; } ?>><i></i>Scripts</label>
		      
		      <label class="checkbox"><input type="checkbox" name="mk3" value="S" <?php if ($campo['mk3'] == 'S') { echo "checked"; } ?>><i></i>Controle de Banda</label>
		     
		      <label class="checkbox"><input type="checkbox" name="mk4" value="S" <?php if ($campo['mk4'] == 'S') { echo "checked"; } ?>><i></i>IPs Pool</label>
		     
		     <label class="checkbox"><input type="checkbox" name="mk5" value="S" <?php if ($campo['mk5'] == 'S') { echo "checked"; } ?>><i></i>Interfaces</label>
		     
		     <label class="checkbox"><input type="checkbox" name="mk6" value="S" <?php if ($campo['mk6'] == 'S') { echo "checked"; } ?>><i></i>Histórico</label>
		     
		     <label class="checkbox"><input type="checkbox" name="mk7" value="S" <?php if ($campo['mk7'] == 'S') { echo "checked"; } ?>><i></i>IP/ARP</label>
		     
		     <label class="checkbox"><input type="checkbox" name="mk8" value="S" <?php if ($campo['mk8'] == 'S') { echo "checked"; } ?>><i></i>Conectados</label>
		     
		     <label class="checkbox"><input type="checkbox" name="mk9" value="S" <?php if ($campo['mk9'] == 'S') { echo "checked"; } ?>><i></i>Hotspot</label>
		     
		     <label class="checkbox"><input type="checkbox" name="mk10" value="S" <?php if ($campo['mk10'] == 'S') { echo "checked"; } ?>><i></i>PPPoE</label>
                      </div>
                    </section>



                      <section class="col col-6">
                          <label class="label"><b>Módulo Home</b></label>
                          <div class="inline-group">

                              <label class="checkbox"><input type="checkbox" name="home" value="S" <?php if ($campo['home'] == 'S') { echo "checked"; } ?>><i></i>DashBoard</label>

                          </div>
                      </section>



                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Cupons Hotspot</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="cupons" value="S" <?php if ($campo['cupons'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="cu1" value="S" <?php if ($campo['cu1'] == 'S') { echo "checked"; } ?>><i></i>Criar Cupom</label>
		      
		      <label class="checkbox"><input type="checkbox" name="cu2" value="S" <?php if ($campo['cu2'] == 'S') { echo "checked"; } ?>><i></i>Gerenciar Cupons</label>
		     
                      </div>
                    </section>
                    
                    <section class="col col-6">
                      <label class="label"><b>Módulo Relatórios</b></label>
                      <div class="inline-group">
                      
		      <label class="checkbox"><input type="checkbox" name="relatorios" value="S" <?php if ($campo['relatorios'] == 'S') { echo "checked"; } ?>><i></i>Ativar</label>
                      
		      <label class="checkbox"><input type="checkbox" name="r1" value="S" <?php if ($campo['r1'] == 'S') { echo "checked"; } ?>><i></i>Faturas Abertas</label>
		      
		      <label class="checkbox"><input type="checkbox" name="r2" value="S" <?php if ($campo['r2'] == 'S') { echo "checked"; } ?>><i></i>Faturas Pagas</label>
		      
		      <label class="checkbox"><input type="checkbox" name="r3" value="S" <?php if ($campo['r3'] == 'S') { echo "checked"; } ?>><i></i>Faturas Bloqueadas</label>
		      
		      <label class="checkbox"><input type="checkbox" name="r4" value="S" <?php if ($campo['r4'] == 'S') { echo "checked"; } ?>><i></i>Clientes Assinantes</label>
		      
		      <label class="checkbox"><input type="checkbox" name="r5" value="S" <?php if ($campo['r5'] == 'S') { echo "checked"; } ?>><i></i>Planos x Clientes</label>
		      
		      <label class="checkbox"><input type="checkbox" name="r6" value="S" <?php if ($campo['r6'] == 'S') { echo "checked"; } ?>><i></i>Movimento do Caixa</label>
		      
		      <label class="checkbox"><input type="checkbox" name="r7" value="S" <?php if ($campo['r7'] == 'S') { echo "checked"; } ?>><i></i>Retornos Bancários</label>
		     
                      </div>
                    </section>
                    
                    
                    
                    
                  </fieldset>
                  <footer>


		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="permissaoid" value="<?php echo base64_decode($_GET['id']); ?>">
		
                  </footer>
                </form>
              </div>
            </div>
            