<?php
// CONEXAO PADRÃO
require_once("conexao.php"); 

/*ini_set("allow_url_fopen", 1);
ini_set("display_errors", 5);
error_reporting(5);
ini_set("track_errors","0");
date_default_timezone_set("Brazil/East");*/

$host = $host; // servidor
$database = $banco; // nome do banco
$login_db = $usuario; // usuario do banco 
$senha_db = $senha; // senha do usuario do banco

$administrador = "contato@myrouter.com.br"; // email do administrador
define('KEY', "ZXJwbWtsaW1pdGVNekE9"); // Key 
	
define('HOST', $host);	
define('BANCO',  $database);
define('LOGIN',  $login_db);
define('SENHA',  $senha_db);

$mysqli = new mysqli($host,$usuario,$senha,$banco) or die("Não é Possivel Conecta ao Banco de Dados");

$cn=mysql_connect($host, $login_db, $senha_db);
mysql_select_db($database);

class conexao
{

    /*
    CONEXÃO CRUDS
    */

    private $db_host = HOST; // servidor
    private $db_user = LOGIN; // usuario do banco
    private $db_pass = SENHA; // senha do usuario do banco
    private $db_name = BANCO; // nome do banco

    private $con = false;

   
    public function connect() // Estabelece conexao
    {
        if(!$this->con)
        {
            $myconn = @mysql_connect($this->db_host,$this->db_user,$this->db_pass);
            if($myconn)
            {
                $seldb = @mysql_select_db($this->db_name,$myconn);
                if($seldb)
                {
                    $this->con = true;
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return true;
        }
    }

   
    public function disconnect() // Fecha conexao
    {
    if($this->con)
    {
        if(@mysql_close())
        {
                        $this->con = false;
            return true;
        }
        else
        {
            return false;
        }
    }
    }
      
}
/*
// Função Backups

$databackup = date('d-m-Y');

$atual = date('H:i');
$horario = "02:36";
if ($horario == $atual) { 

$abre = fopen("config/dump/myrouter.sql", "w"); // nome do arquivo que será salvo o backup

$sql1 = mysqli_list_tables($banco) or die(mysqli_error());

while ($ver=mysqli_fetch_row($sql1)) {
	$tabela = $ver[0];
	$sql2 = $mysqli->query("SHOW CREATE TABLE $tabela");
	while ($ver2=mysqli_fetch_row($sql2)) {
		fwrite($abre, "-- Criando tabela: $tabela\n");
		$pp = fwrite($abre, "$ver2[1]\n\n-- Salva os dados\n");
		$sql3 = $mysqli->query("SELECT * FROM $tabela");

		while($ver3=mysqli_fetch_row($sql3)) {
			$grava = "INSERT INTO $tabela VALUES ('";
			$grava .= implode("', '", $ver3);
			$grava .= "')\n";
			fwrite($abre, $grava);
		}
		fwrite($abre, "\n\n");
	}
}

$finaliza = fclose($abre);

if($finaliza) {

$Vai 		= "<b>Backup Automatico Programado</b><br>
		   MyRouter ERP - Sistema de Gestão de Provedores<br><br><br>
		   *Por favor não responda essa mensagem.";

require_once("../app/email/class.phpmailer.php");

define('GUSER', 'contato@myrouter.com.br');	// <-- Insira aqui
define('GPWD', 'linuxdebian');		// <-- Insira aqui a senha

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->IsHTML(true);
	$mail->Host = 'mail.myrouter.com.br';	// SMTP utilizado
	$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$databackup = date('d-m-Y');
	$mail->AddAttachment('config/dump/myrouter.sql');
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = '';
		return true;
	}
}


if (smtpmailer($administrador, 'contato@myrouter.com.br', 'MyRouter ERP Sistema de Gestão de Provedres', 'Backup Automatico', $Vai)) {
 echo "BACKUP REALIZADO COM SUCESSO";
}
if (!empty($error)) echo $error;
	
}	
} // FIM FUNÇÃO*/


function extenso($valor=0, $maiusculas=false) {
        // verifica se tem virgula decimal
        if (strpos($valor, ",") > 0) {
                // retira o ponto de milhar, se tiver
                $valor = str_replace(".", "", $valor);

                // troca a virgula decimal por ponto decimal
                $valor = str_replace(",", ".", $valor);
        }
        $singular = array("Centavo", "Real", "Mil", "Milhão", "Bilhão", "Trilhão", "Quatrilhão");
        $plural = array("Centavos", "Reais", "Mil", "Milhões", "Bilhões", "Trilhões",
                "Quatrilhões");

        $c = array("", "Cem", "Duzentos", "Trezentos", "Quatrocentos",
                "Quinhentos", "Seiscentos", "Setecentos", "Oitocentos", "Novecentos");
        $d = array("", "Dez", "Vinte", "Trinta", "Quarenta", "Cinquenta",
                "Sessenta", "Setenta", "Oitenta", "Noventa");
        $d10 = array("Dez", "Onze", "Doze", "Treze", "Quatorze", "Quinze",
                "Dezesseis", "Dezesete", "Dezoito", "Dezenove");
        $u = array("", "Um", "Dois", "Três", "Quatro", "Cinco", "Seis",
                "Sete", "Oito", "Nove");

        $z = 0;

        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        $cont = count($inteiro);
        for ($i = 0; $i < $cont; $i++)
                for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
                $inteiro[$i] = "0" . $inteiro[$i];

        $fim = $cont - ($inteiro[$cont - 1] > 0 ? 1 : 2);
        $rt = '';
        for ($i = 0; $i < $cont; $i++) {
                $valor = $inteiro[$i];
                $rc = (($valor > 100) && ($valor < 200)) ? "Cento" : $c[$valor[0]];
                $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
                $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

                $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd &&
                        $ru) ? " e " : "") . $ru;
                $t = $cont - 1 - $i;
                $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                if ($valor == "000"

                )$z++; elseif ($z > 0)
                $z--;
                if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
                $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
                if ($r)
                $rt = $rt . ((($i > 0) && ($i <= $fim) &&
                        ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }

        if (!$maiusculas) {
                return($rt ? $rt : "zero");
        } elseif ($maiusculas == "2") {
                return (strtoupper($rt) ? strtoupper($rt) : "Zero");
        } else {
                return (ucwords($rt) ? ucwords($rt) : "Zero");
        }
        }

function acento($string)
{
  $string = str_replace('á','a',$string);
  $string = str_replace('Á','A',$string);
  $string = str_replace('à','a',$string);
  $string = str_replace('À','A',$string);
  $string = str_replace('â','a',$string);
  $string = str_replace('Â','A',$string);
  $string = str_replace('ã','a',$string);
  $string = str_replace('Ã','A',$string);
  $string = str_replace('ç','c',$string);
  $string = str_replace('Ç','C',$string);
  $string = str_replace('é','e',$string);
  $string = str_replace('É','E',$string);
  $string = str_replace('ê','e',$string);
  $string = str_replace('Ê','E',$string);
  $string = str_replace('è','e',$string);
  $string = str_replace('È','E',$string);
  $string = str_replace('í','i',$string);
  $string = str_replace('Í','I',$string);
  $string = str_replace('ó','o',$string);
  $string = str_replace('Ó','O',$string);
  $string = str_replace('ô','o',$string);
  $string = str_replace('Ô','O',$string);
  $string = str_replace('õ','o',$string);
  $string = str_replace('Õ','O',$string);
  $string = str_replace('ú','u',$string);
  $string = str_replace('Ú','U',$string);
  $string = str_replace('~','',$string);
  $string = str_replace('&','e',$string);
  $string = str_replace('.','',$string);
  $string = str_replace('-','_',$string);
  $string = str_replace(',','',$string);
  $string = str_replace(';','',$string);
  $string = str_replace(':','',$string);
  $string = str_replace(' ','+',$string);
  return $string;
  
  } 

// Funções Juros
function Moeda($value){
return number_format($value, 2, ",", ".");
};
 
 function convdata($dataform, $tipo){
 if ($tipo == 0) {
 $datatrans = explode ("/", $dataform);
 $data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
 } elseif ($tipo == 1) {
 $datatrans = explode ("-", $dataform);
 $data = "$datatrans[2]/$datatrans[1]/$datatrans[0]";
 }elseif ($tipo == 2) {
 $datatrans = explode ("-", $dataform);
 $data = "$datatrans[1]/$datatrans[2]/$datatrans[0]";
 } elseif ($tipo == 3) {
 $datatrans = explode ("/", $dataform);
 $data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
 }
 
 return $data;
 };
 
 function diasEntreData($date_ini, $date_end){
 $data_ini = strtotime( convdata(convdata($date_ini,3),2) ); //data inicial '29 de julho de 2003'
 $hoje = convdata($date_end,3);//date("m/d/Y"); // data atual
 $foo = strtotime($hoje); // transforma data atual em segundos (eu acho)
 $dias = ($foo - $data_ini)/86400; //calcula intervalo
 return $dias;
 };
 //
 //require_once("cron.php"); 
?>