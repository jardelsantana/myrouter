<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );


//mysql -u root -p myrouter < arquivo.sql
//update myrouter.financeiro set  situacao = "B" where  date_add(vencimento, interval 5 day) < now()  and   situacao = "N";

// programacao  orientado tipo claiton
// select * from financeiro where (date_add(vencimento, interval (select dias_bloc from empresa where id = 1) day) < now()) and (situacao = 'N') ;

$query1 = mysql_query("SELECT * FROM empresa WHERE id = '1'");
$dados1 = mysql_fetch_assoc($query1);
$dias_bloc = $dados1['dias_bloc'];

require_once 'conexao.php';
require_once 'conexao.class.php';
require_once 'crud.class.php';
require_once 'mikrotik.class.php';

$con = new conexao(); // instancia classe de conxao
$con->connect(); // abre conexao com o banco

$prddata = mysql_query("UPDATE myrouter.financeiro SET  situacao = 'B' WHERE  date_add(vencimento, interval 5 day) < now() AND   situacao = 'N'");
?>