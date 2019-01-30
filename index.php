<?php
session_start();
ob_start();
ini_set("allow_url_fopen", 1);
ini_set("display_errors", 1);
error_reporting(1);
ini_set("track_errors","1");

$filename = 'config/conexao.php';
if (!file_exists($filename)) {
	header("Location: setup/instalar.php");
}

header("Content-Type: text/html; charset=ISO-8859-1", true);
    require_once 'config/conexao.class.php';
    require_once 'config/crud.class.php';
    require_once 'config/mikrotik.class.php';
    require_once 'config/librouteros/RouterOS.php';
    require_once 'config/ubnt_class.php';

    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco
    
    //if ( !isset($_SESSION['login']) ){ // Verifica Login do Usu?rio
	
	if(!isset($_SESSION['login']) or $_SESSION['nivel'] == "0"){
			
			if($_SESSION['nivel'] == "0"){
		echo "
		<script>
			window.location = 'cliente/index.php';
			</script>
		";	
				
			}
			
			
		echo "
		<script>
			window.location = 'login.php';
			</script>
		";
} else { 
    $idbase = $_SESSION['id'];  
    if($idbase){ 
        $cslogin = $mysqli->query("SELECT * FROM usuarios WHERE id = + $idbase");
        $logado = mysqli_fetch_array($cslogin);
    }
    $_SESSION['empresa'] = 1;
    $idpuser = $logado['id'];
    $gper = $mysqli->query("SELECT * FROM permissoes WHERE codigo = '$idpuser'");
    $permissao = mysqli_fetch_array($gper);
    
    
    $cskey = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
    $chavekey = mysqli_fetch_array($cskey);
    
    $chave = $chavekey['chave'];
    $cnpj = $chavekey['cnpj'];

/*
//REGISTRO DE LICENÇA
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://key.myrouter.com.br/keyerpmk.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,"chave=$chave&cnpj=$cnpj");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

$regstatus = json_decode($server_output);
echo $regstatus;
if ($regstatus == "OK") { 

} else { 
echo '<script>
        alert ("ATENÇÃO CHAVE NÃO REGISTRADA!");
        document.location.href = ("certificado.php");
</script>'; 
}*/


/* Para Boqueio Automatico Desabilite Abaixo recomendamos ativar o cron.php pelo CRONJOBS
Comando
$ crontab -e  * /1 * * * * /usr/local/bin/php -q /route/to/your/script.php
require_once("config/cron.php"); 
*/

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<meta name="keywords" content="Sistema de Gest?o Provedores">
<meta name="author" content="MyRouter ERP">
<meta name="description" content="MyRouter ERP - Powerfull Mikrotik">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MyRouter ERP</title>
<link href="assets/css/styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-select.css">
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<!--JQuery--> 
<script type="text/javascript" src="assets/js/vendors/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/jquery/jquery-ui.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/modernizr/modernizr.custom.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.js"></script>
</head>

<body style="margin:0px; border:0px; padding:0px;">

<!--<body onload="initMap()" style="margin:0px; border:0px; padding:0px;">-->

<div class="smooth-overflow">

    <nav class="main-header clearfix" role="navigation">
    <?php include("app/nav.php"); ?>
    </nav>
    

    <div class="main-wrap"> 
      

      <!--Main Menu-->
      <?php include("app/menu.php"); ?>
      <!--/MainMenu-->
      
      <div class="content-wrapper"> 
      
        <nav class="cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">
          <div class="cbp-hsinner">
          
          </div>
        </nav>
              
              <!-- INCLUDES -->
        
                    <?php
		    $app = (isset ( $_GET ['app'] ) ? $_GET ['app'] : 'app');
		    switch ($app) {
	
		    case 'CadastroCliente' :
		    include_once ('app/clientes/cadastro.php');
		    break;
		    case 'Historico' :
		    include_once ('app/clientes/historico.php');
		    break;
		    case 'Mapas' :
		    include_once ('app/clientes/mapas.php');
		    break;
		    
		    case 'Planos' :
		    include_once ('app/planos/index.php');
		    break;
		    case 'CadastroPlano' :
		    include_once ('app/planos/cadastro.php');
		    break;
		    
		    case 'Pool' :
		    include_once ('app/servidores/ippool.php');
		    break;
		    case 'CadastroPool' :
		    include_once ('app/servidores/cadastropool.php');
		    break;
		    
		    case 'SICI' :
		    include_once ('app/ferramentas/sici.php');
		    break;
		    case 'CadastroSICI' :
		    include_once ('app/ferramentas/cadastrosici.php');
		    break;
		    case 'API' :
		    include_once ('app/ferramentas/webservices.php');
		    break;
		    case 'NFSe' :
		    include_once ('app/notafiscal/nfse.php');
		    break;
		    case 'CadastroNFSe' :
		    include_once('app/notafiscal/cadastronfse.php');
		    break;
            case 'EditarNFSe' :
            include_once('app/notafiscal/editarnota.php');
            break;
		    case 'BLOCK' :
		    include_once ('app/ferramentas/bloqueio.php');
		    break;
		    case 'CadastroBLOCK' :
		    include_once ('app/ferramentas/cadastroblock.php');
		    break;
            case 'NatMK' :
            include_once('app/mikrotik/natmk.php');
            break;
            case 'NatMKPRINT' :
            include_once('app/mikrotik/natmkprint.php');
            break;
            case 'Regras' :
		    include_once ('app/ferramentas/manual.php');
		    break;
		    case 'Boletos' :
		    include_once ('app/financeiro/boletos.php');
		    break;
		    case 'CadastroBoleto' :
		    include_once('app/financeiro/cadastroboleto.php');
		    break;
		    case 'LivroCaixa' :
		    include_once ('app/caixa/cx.php');
		    break;
		    
		    case 'Clientes' :
		    include_once ('app/clientes/index.php');
		    break;
		    case 'CadastroCliente' :
		    include_once ('app/clientes/cadastro.php');
		    break;
		    
		    case 'Assinaturas' :
		    include_once ('app/assinaturas/index.php');
		    break;
		    case 'CadastroAssinatura' :
		    include_once ('app/assinaturas/cadastro.php');
		    break;
		    case 'EqpAssinatura' :
		    include_once ('app/assinaturas/edteqp.php');
		    break;
		    
		    case 'Sistema' :
		    include_once ('app/sistema/index.php');
		    break;
		    case 'Financeiro' :
		    include_once ('app/financeiro/index.php');
		    break;
		    case 'FaturaEDT' :
		    include_once ('app/financeiro/cadastro.php');
		    break;
		    case 'FaturaEDTGerenciaNet' :
		    include_once ('app/financeiro/cadastroGerenciaNet.php');
		    break;
		    case 'FiltroFinanceiro' :
		    include_once ('app/financeiro/filtro.php');
		    break;
		    
		    case 'Fornecedores' :
		    include_once ('app/fornecedores/index.php');
		    break;
		    case 'CadastroFornecedor' :
		    include_once ('app/fornecedores/cadastro.php');
		    break;
		    case 'CadastroHotspot' :
		    include_once ('app/hotspots/cadastro.php');
		    break;
		    case 'Hotspots' :
		    include_once ('app/hotspots/index.php');
		    break;
		    case 'Tecnicos' :
		    include_once ('app/tecnicos/index.php');
		    break;
		    case 'CadastroTecnico' :
		    include_once ('app/tecnicos/cadastro.php');
		    break;
		    
		    case 'OrdemServicos' :
		    include_once ('app/os/index.php');
		    break;

		    case 'CadastroOS' :
		    include_once ('app/os/cadastro.php');
		    break;

            case 'EncerradasOS' :
            include_once ('app/os/os_encerradas.php');
            break;

		    case 'Equipamentos' :
		    include_once ('app/equipamentos/index.php');
		    break;

		    case 'Fabricante' :
		    include_once ('app/equipamentos/fabricante.php');
		    break;

		    case 'ListaFabricante' :
		    include_once ('app/equipamentos/listafabricante.php');
		    break;

		    case 'CadastroEquipamento' :
		    include_once ('app/equipamentos/cadastro.php');
		    break;
		    
		    case 'Frotas' :
		    include_once ('app/frotas/index.php');
		    break;

		    case 'CadastroFrota' :
		    include_once ('app/frotas/cadastro.php');
		    break;
		    
		    case 'Backups' :
		    include_once ('app/servidores/backups.php');
		    break;

            case 'Backupsql' :
            include_once ('app/servidores/backupsql.php');
            break;

            case 'bckgen' :
            include_once ('backups/bckgen.php');
            break;

            case 'EnviarEmail' :
            include_once('app/email/enviar_email-01.php');
            break;

            case 'Newsletter' :
            include_once('app/email/newsletter_form.php');
            break;


            case 'ControleBanda' :
		    include_once ('app/servidores/controlebanda.php');
		    break;

            case 'CadastroBanda' :
		    include_once ('app/servidores/cadastrobanda.php');
		    break;
		    		    
		    case 'Servidores' :
		    include_once ('app/servidores/index.php');
		    break;

		    case 'CadastroServidor' :
		    include_once ('app/servidores/cadastro.php');
		    break;

		    case 'Scripts' :
		    include_once ('app/servidores/scripts.php');
		    break;

		    case 'CadastroScript' :
		    include_once ('app/servidores/scriptcadastro.php');
		    break;

		    case 'Interface' :
		    include_once ('app/servidores/interfaces.php');
		    break;

		    case 'LOGS' :
		    include_once ('app/servidores/logs.php');
		    break;

		    case 'IPARP' :
		    include_once ('app/servidores/iparp.php');
		    break;

		    case 'HOTSPOT' :
		    include_once ('app/servidores/hotspot.php');
		    break;

		    case 'PPP' :
		    include_once ('app/servidores/ppp.php');
		    break;

		    case 'Monitor' :
		    include_once ('app/servidores/monitor.php');
		    break;
		    
		    case 'Retorno' :
		    include_once ('app/financeiro/retorno.php');
		    break;

            case 'Remessa' :
            include_once ('app/remessa/remessa.php');
            break;

            case 'ListarRemessa' :
            include_once ('app/remessa/listaremessa.php');
            break;

		    case 'Wireless' :
		    include_once ('app/servidores/wlan.php');
		    break;
		    
		    case 'Relatorios' :
		    include_once ('app/relatorios/index.php');
		    break;
		    
		    case 'Permissoes' :
		    include_once ('app/sistema/permissoes.php');
		    break;

		    case 'AtribuirPermissoes' :
		    include_once ('app/sistema/permissoesedt.php');
		    break;

		    case 'Dashboard' :
		    include_once ('app/dashboard/index.php');
		    break;

            case 'Ubiquiti' :
            include_once ('app/ubnt/index.php');
            break;

            case 'UbiquitiRel' :
            include_once ('app/ubnt/relatorio.php');
            break;

			case 'CadastroUbiquiti' :
			include_once ('app/ubnt/cadastro.php');
			break;

			case 'ServidoresUBNT' :
			include_once ('app/ubnt/servidor_index.php');
			break;

			case 'BRASJUNOS' :
			include_once ('app/juniper/servidor_index.php');
            break;

            case 'CadastroJuniper' :
            include_once ('app/juniper/cadastro.php');
            break;

            //MODULO FIBRA
            case 'Fibra' :
            include_once ('app/fibra/index.php');
            break;

            case 'CadastroFibra' :
            include_once ('app/fibra/cadastro.php');
            break;

            case 'ListaNo' :
            include_once ('app/fibra/listanos.php');
            break;

            case 'ListaAreaFibra' :
            include_once ('app/fibra/listarea.php');
            break;

            case 'ListaMarcadores' :
            include_once ('app/fibra/listamarcadores.php');
            break;

            case 'EditarMarcadores' :
            include_once ('app/fibra/editarmarcadores.php');
            break;

            case 'EditarAreaFibra' :
            include_once ('app/fibra/editararea.php');
            break;

            case 'CadElemento' :
            include_once ('app/fibra/elementos.php');
            break;

            case 'ProcessarRetorno' :
            include_once ('processa.retorno.php');
            break;

            case 'ProcessarRetornoSicoob' :
            include_once ('app/remessa/processa.retorno.sicoob.php');
            break;

		    case 'home' :
		    default :
		    include_once ('app/dashboard/index.php');
		    break;

    		case 'ContasFixas' :
		    include_once ('app/contasfixas/index.php');
		    break;

		    case 'CadastroContasFixas' :
		    include_once ('app/contasfixas/cadastro.php');
		    break;

		    case 'LogsHistorico' :
		    include_once ('app/ferramentas/logs.php');
		    break;

		    case 'AutoBloqueio' :
		    include_once ('app/autobloqueio.php');
		    break;
		    }

             ?>
        
              <!-- FIM -->
    </div>
  </div>

<div class="scroll-top-wrapper hidden-xs">
    <i class="fa fa-angle-up"></i>
</div>

<!--Scripts--> 

<script type="text/javascript" src="assets/js/vendors/fullscreen/screenfull.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/nanoscroller/jquery.nanoscroller.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/sparkline/jquery.sparkline.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/horisontal/cbpHorizontalSlideOutMenu.js"></script> 
<script type="text/javascript" src="assets/js/vendors/classie/classie.js"></script> 
<script type="text/javascript" src="assets/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="assets/js/vendors/datatables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/datatables/jquery.dataTables-bootstrap.js"></script> 
<script type="text/javascript" src="assets/js/vendors/datatables/dataTables.colVis.js"></script> 
<script type="text/javascript" src="assets/js/vendors/datatables/colvis.extras.js"></script> 
<script type="text/javascript" src="assets/js/vendors/powerwidgets/powerwidgets.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/bootstrap/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/animation/animation.js"></script> 


<script type="text/javascript" src="assets/js/tableExport.js"></script>
<script type="text/javascript" src="assets/js/jquery.base64.js"></script>

<script type="text/javascript" src="assets/js/html2canvas.js"></script>
<script type="text/javascript" src="assets/js/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="assets/js/jspdf/jspdf.js"></script>
<script type="text/javascript" src="assets/js/jspdf/libs/base64.js"></script>


<script type="text/javascript" src="assets/js/vendors/todos/todos.js"></script> 
<script type="text/javascript" src="assets/js/scripts.js"></script>
<script>
function moeda(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas n?meros
	v=v.replace(/[0-9]{12}/,"inv?lido")   //limita pra m?ximo 999.999.999,99
	v=v.replace(/(\d{1})(\d{8})$/,"$1$2")  //coloca ponto antes dos ?ltimos 8 digitos
	v=v.replace(/(\d{1})(\d{5})$/,"$1$2")  //coloca ponto antes dos ?ltimos 5 digitos
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1.$2")	//coloca virgula antes dos ?ltimos 2 digitos
		z.value = v;
	}
	function kbps(z){  
		v = z.value;
		v=v.replace(/\D/g,"")  //permite digitar apenas n?meros
	v=v.replace(/[0-9]{12}/,"inv?lido")   //limita pra m?ximo 999.999.999,99
	v=v.replace(/(\d{1})(\d{8})$/,"$1$2")  //coloca ponto antes dos ?ltimos 8 digitos
	v=v.replace(/(\d{1})(\d{5})$/,"$1$2")  //coloca ponto antes dos ?ltimos 5 digitos
	v=v.replace(/(\d{1})(\d{1,2})$/,"$1$2")	//coloca virgula antes dos ?ltimos 2 digitos
		z.value = v;
	}
	</script>
<!--/Scripts-->

</body>
</html>
<?php //include("config/cron.php"); ?>
<?php } ?>