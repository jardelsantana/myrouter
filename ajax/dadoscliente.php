<?php
include("../config/conexao.class.php");
$con = mysql_connect($host, $login_db, $senha_db);
mysql_select_db($database, $con);
 
/**
* função que retorna o select
*/
function montaSelect()
{
$sql = "SELECT * FROM clientes";
$query = mysql_query( $sql );
 
if( mysql_num_rows( $query ) > 0 )
{
while( $dados = mysql_fetch_assoc( $query ) )
{
$opt .= '<option value="'.$dados['id'].'">'.$dados['nome'].'</option>';
}
}
else
$opt = '<option value="0">Nenhum cliente cadastrado</option>';
 
return $opt;
}
 
/**
* função que devolve em formato JSON os dados do cliente
*/
function retorna( $id )
{
$id = (int)$id;
 
$sql = "SELECT * FROM clientes WHERE id = {$id} ";
$query = mysql_query( $sql );
 
 
$arr = Array();
if( mysql_num_rows( $query ) )
{
while( $dados = mysql_fetch_object( $query ) )
{
$arr['endereco'] = utf8_encode($dados->endereco);
$arr['numero'] = utf8_encode($dados->numero);
$arr['bairro'] = utf8_encode($dados->bairro);
$arr['complemento'] = utf8_encode($dados->complemento);
$arr['cidade'] = utf8_encode($dados->cidade);
$arr['estado'] = utf8_encode($dados->estado);
$arr['cep'] = utf8_encode($dados->cep);
$arr['login'] = utf8_encode($dados->login);
$arr['senha'] = utf8_encode($dados->senha);
}
}
else
$arr[] = 'endereco: não encontrado';
 
return json_encode( $arr );
}
 
/* só se for enviado o parâmetro, que devolve o combo */
if( isset($_GET['id']) )
{
echo retorna( $_GET['id'] );
}

?>