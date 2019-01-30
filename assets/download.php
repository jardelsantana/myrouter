<?php
if( isset( $_GET['arquivo'] ) && is_file( $_GET['arquivo'] ) ){
  
 $arquivo = $_GET['arquivo'];
  
 // Pega a extensão do arquivo
 $ext = pathinfo($arquivo,PATHINFO_EXTENSION);
  
 // No vetor abaixo são setados os Mime Types dos possíveis arquivos
 $mimeType = array(
 'mp3'=>'audio/mpeg',
 'pdf'=>'application/pdf',
 'cdr'=>'application/cdr',
 'gif'=>'application/gif',
 'zip'=>'application/zip',
 'rar'=>'application/rar',
 'backup'=>'application/backup',
 'sql'=>'application/sql',
 'jpg'=>'application/jpg',
 'jepg'=>'application/jepg',
 'ai'=>'application/ai',
 'psd'=>'application/psd',
 'xml'=>'application/xml',
 'doc'=>'application/msword',
 'ppt'=>'application/vnd.ms-powerpoint',
 'pps'=>'application/vnd.ms-powerpoint'
 );
  
 //Seta o Mime Type do arquivo de acordo com a extensão
 if(array_key_exists($ext,$mimeType)){
 $mimeType = $mimeType[$ext];
 }else{
 // Se o Mime Type não for encontrado na lista, será usado o padrão application/octet-stream
 $mimeType = "application/octet-stream";
 }
  
 // Seta os cabeçalhos
 header( "Pragma: public" );
 header( "Expires: 0" );
 header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
 header( "Cache-Control: private",false );
 header( "Content-Type: $mimeType" );
  
 // A linha abaixo é responsável por dizer que o arquivo é para download
 header( "Content-Disposition: attachment; filename=".basename($arquivo).";");
  
 header( "Content-Transfer-Encoding: binary" );
 header( "Content-Length: ".filesize($arquivo));
  
 // Lê e escreve o conteúdo do arquivo para o buffer de saída
 readfile($arquivo);
  
 exit;
} else {
 // Para dar um erro 404 de arquivo não encontrado
 header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
 header("Status: 404 Not Found");
  
 // Se as duas linhas acima não der um erro 404 exibe a mensagem abaixo
 die("Arquivo não encontrado");
}
?>