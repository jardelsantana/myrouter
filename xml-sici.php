<?php
    require_once 'config/conexao.class.php';
    $con = new conexao(); // instancia classe de conxao
    $con->connect(); // abre conexao com o banco

$idsici = base64_decode($_GET['sici']);
$sql = $mysqli->query("SELECT * FROM sici WHERE id = '$idsici'");
$sici = mysqli_fetch_array($sql);
$row = mysqli_num_rows($sql);

// Verifica se Existe
if($row >0) {

$arquivo = "XML/sici$idsici.xml";

// Abre se não cria
$ponteiro = fopen($arquivo, "w");

// SICI
$ano = $sici['ano'];
$mes = $sici['mes'];
$outorga = $sici['outorga'];
$num_cat = $sici['num_cat'];

$ipl1a = $sici['ipl1a'];
$ipl1b = $sici['ipl1b'];
$ipl1c = $sici['ipl1c'];
$ipl1d = $sici['ipl1d'];

$iem4auf = $sici['iem4auf'];
$iem4avalor = $sici['iem4avalor'];
$iem5auf = $sici['iem5auf'];
$iem5avalor = $sici['iem5avalor'];

$iem9fauf = $sici['iem9fauf'];
$iem9fbuf = $sici['iem9fbuf'];
$iem9fcuf = $sici['iem9fcuf'];
$iem9fduf = $sici['iem9fduf'];
$iem9feuf = $sici['iem9feuf'];
$iem9favalor = $sici['iem9favalor'];
$iem9fbvalor = $sici['iem9fbvalor'];
$iem9fcvalor = $sici['iem9fcvalor'];
$iem9fdvalor = $sici['iem9fdvalor'];
$iem9fevalor = $sici['iem9fevalor'];

$iem9jauf = $sici['iem9jauf'];
$iem9jbuf = $sici['iem9jbuf'];
$iem9jcuf = $sici['iem9jcuf'];
$iem9jduf = $sici['iem9jduf'];
$iem9jeuf = $sici['iem9jeuf'];
$iem9javalor = $sici['iem9javalor'];
$iem9jbvalor = $sici['iem9jbvalor'];
$iem9jcvalor = $sici['iem9jcvalor'];
$iem9jdvalor = $sici['iem9jdvalor'];
$iem9jevalor = $sici['iem9jevalor'];

$iem10fauf = $sici['iem10fauf'];
$iem10fbuf = $sici['iem10fbuf'];
$iem10fcuf = $sici['iem10fcuf'];
$iem10fduf = $sici['iem10fduf'];
$iem10favalor = $sici['iem10favalor'];
$iem10fbvalor = $sici['iem10fbvalor'];
$iem10fcvalor = $sici['iem10fcvalor'];
$iem10fdvalor = $sici['iem10fdvalor'];

$iem10jauf = $sici['iem10jauf'];
$iem10jbuf = $sici['iem10jbuf'];
$iem10jcuf = $sici['iem10jcuf'];
$iem10jduf = $sici['iem10jduf'];
$iem10javalor = $sici['iem10javalor'];
$iem10jbvalor = $sici['iem10jbvalor'];
$iem10jcvalor = $sici['iem10jcvalor'];
$iem10jdvalor = $sici['iem10jdvalor'];

$ipl3codm = $sici['ipl3codm'];
$ipl3pf = $sici['ipl3pf'];
$ipl3pj = $sici['ipl3pj'];

$qaipl4smcodm = $sici['qaipl4smcodm'];

$qaipl4smaqaipl5sm = $sici['qaipl4smaqaipl5sm'];
$qaipl4smatotal = $sici['qaipl4smatotal'];
$qaipl4sma15 = $sici['qaipl4sma15'];
$qaipl4sma16 = $sici['qaipl4sma16'];
$qaipl4sma17 = $sici['qaipl4sma17'];
$qaipl4sma18 = $sici['qaipl4sma18'];
$qaipl4sma19 = $sici['qaipl4sma19'];

$qaipl4smbqaipl5sm = $sici['qaipl4smbqaipl5sm'];
$qaipl4smbtotal = $sici['qaipl4smbtotal'];
$qaipl4smb15 = $sici['qaipl4smb15'];
$qaipl4smb16 = $sici['qaipl4smb16'];
$qaipl4smb17 = $sici['qaipl4smb17'];
$qaipl4smb18 = $sici['qaipl4smb18'];
$qaipl4smb19 = $sici['qaipl4smb19'];

$qaipl4smcqaipl5sm = $sici['qaipl4smcqaipl5sm'];
$qaipl4smctotal = $sici['qaipl4smctotal'];
$qaipl4smc15 = $sici['qaipl4smc15'];
$qaipl4smc16 = $sici['qaipl4smc16'];
$qaipl4smc17 = $sici['qaipl4smc17'];
$qaipl4smc18 = $sici['qaipl4smc18'];
$qaipl4smc19 = $sici['qaipl4smc19'];

$qaipl4smdqaipl5sm = $sici['qaipl4smdqaipl5sm'];
$qaipl4smdtotal = $sici['qaipl4smdtotal'];
$qaipl4smd15 = $sici['qaipl4smd15'];
$qaipl4smd16 = $sici['qaipl4smd16'];
$qaipl4smd17 = $sici['qaipl4smd17'];
$qaipl4smd18 = $sici['qaipl4smd18'];
$qaipl4smd19 = $sici['qaipl4smd19'];

$qaipl4smeqaipl5sm = $sici['qaipl4smeqaipl5sm'];
$qaipl4smetotal = $sici['qaipl4smetotal'];
$qaipl4sme15 = $sici['qaipl4sme15'];
$qaipl4sme16 = $sici['qaipl4sme16'];
$qaipl4sme17 = $sici['qaipl4sme17'];
$qaipl4sme18 = $sici['qaipl4sme18'];
$qaipl4sme19 = $sici['qaipl4sme19'];

$qaipl4smfqaipl5sm = $sici['qaipl4smfqaipl5sm'];
$qaipl4smftotal = $sici['qaipl4smftotal'];
$qaipl4smf15 = $sici['qaipl4smf15'];
$qaipl4smf16 = $sici['qaipl4smf16'];
$qaipl4smf17 = $sici['qaipl4smf17'];
$qaipl4smf18 = $sici['qaipl4smf18'];
$qaipl4smf19 = $sici['qaipl4smf19'];

$qaipl4smgqaipl5sm = $sici['qaipl4smgqaipl5sm'];
$qaipl4smgtotal = $sici['qaipl4smgtotal'];
$qaipl4smg15 = $sici['qaipl4smg15'];
$qaipl4smg16 = $sici['qaipl4smg16'];
$qaipl4smg17 = $sici['qaipl4smg17'];
$qaipl4smg18 = $sici['qaipl4smg18'];
$qaipl4smg19 = $sici['qaipl4smg19'];

$qaipl4smhqaipl5sm = $sici['qaipl4smhqaipl5sm'];
$qaipl4smhtotal = $sici['qaipl4smhtotal'];
$qaipl4smh15 = $sici['qaipl4smh15'];
$qaipl4smh16 = $sici['qaipl4smh16'];
$qaipl4smh17 = $sici['qaipl4smh17'];
$qaipl4smh18 = $sici['qaipl4smh18'];
$qaipl4smh19 = $sici['qaipl4smh19'];

$qaipl4smiqaipl5sm = $sici['qaipl4smiqaipl5sm'];
$qaipl4smitotal = $sici['qaipl4smitotal'];
$qaipl4smi15 = $sici['qaipl4smi15'];
$qaipl4smi16 = $sici['qaipl4smi16'];
$qaipl4smi17 = $sici['qaipl4smi17'];
$qaipl4smi18 = $sici['qaipl4smi18'];
$qaipl4smi19 = $sici['qaipl4smi19'];

$qaipl4smjqaipl5sm = $sici['qaipl4smjqaipl5sm'];
$qaipl4smjtotal = $sici['qaipl4smjtotal'];
$qaipl4smj15 = $sici['qaipl4smj15'];
$qaipl4smj16 = $sici['qaipl4smj16'];
$qaipl4smj17 = $sici['qaipl4smj17'];
$qaipl4smj18 = $sici['qaipl4smj18'];
$qaipl4smj19 = $sici['qaipl4smj19'];

$qaipl4smlqaipl5sm = $sici['qaipl4smlqaipl5sm'];
$qaipl4smltotal = $sici['qaipl4smltotal'];
$qaipl4sml15 = $sici['qaipl4sml15'];
$qaipl4sml16 = $sici['qaipl4sml16'];
$qaipl4sml17 = $sici['qaipl4sml17'];
$qaipl4sml18 = $sici['qaipl4sml18'];
$qaipl4sml19 = $sici['qaipl4sml19'];

$qaipl4smmqaipl5sm = $sici['qaipl4smmqaipl5sm'];
$qaipl4smmtotal = $sici['qaipl4smmtotal'];
$qaipl4smm15 = $sici['qaipl4smm15'];
$qaipl4smm16 = $sici['qaipl4smm16'];
$qaipl4smm17 = $sici['qaipl4smm17'];
$qaipl4smm18 = $sici['qaipl4smm18'];
$qaipl4smm19 = $sici['qaipl4smm19'];

$qaipl4smnqaipl5sm = $sici['qaipl4smnqaipl5sm'];
$qaipl4smntotal = $sici['qaipl4smntotal'];
$qaipl4smn15 = $sici['qaipl4smn15'];
$qaipl4smn16 = $sici['qaipl4smn16'];
$qaipl4smn17 = $sici['qaipl4smn17'];
$qaipl4smn18 = $sici['qaipl4smn18'];
$qaipl4smn19 = $sici['qaipl4smn19'];

$qaipl4smoqaipl5sm = $sici['qaipl4smoqaipl5sm'];
$qaipl4smototal = $sici['qaipl4smototal'];
$qaipl4smo15 = $sici['qaipl4smo15'];
$qaipl4smo16 = $sici['qaipl4smo16'];
$qaipl4smo17 = $sici['qaipl4smo17'];
$qaipl4smo18 = $sici['qaipl4smo18'];
$qaipl4smo19 = $sici['qaipl4smo19'];

$ipl6imcodm = $sici['ipl6imcodm'];
$ipl1a = $sici['ipl1a'];
$ipl1b = $sici['ipl1b'];
$ipl1c = $sici['ipl1c'];
$ipl1d = $sici['ipl1d'];
$ipl2a = $sici['ipl2a'];
$ipl2b = $sici['ipl2b'];
$ipl2c = $sici['ipl2c'];
$ipl2d = $sici['ipl2d'];
$iem1avalor = $sici['iem1avalor'];
$iem1bvalor = $sici['iem1bvalor'];
$iem1cvalor = $sici['iem1cvalor'];
$iem1dvalor = $sici['iem1dvalor'];
$iem1evalor = $sici['iem1evalor'];
$iem1fvalor = $sici['iem1fvalor'];
$iem1gvalor = $sici['iem1gvalor'];
$iem2avalor = $sici['iem2avalor'];
$iem2bvalor = $sici['iem2bvalor'];
$iem2cvalor = $sici['iem2cvalor'];
$iem3avalor = $sici['iem3avalor'];
$iem6avalor = $sici['iem6avalor'];
$iem7avalor = $sici['iem7avalor'];
$iem8avalor = $sici['iem8avalor'];
$iem8bvalor = $sici['iem8bvalor'];
$iem8cvalor = $sici['iem8cvalor'];
$iem8dvalor = $sici['iem8dvalor'];
$iem8evalor = $sici['iem8evalor'];

// Escrevendo XML
fwrite($ponteiro, "<?xml version='1.0' encoding='utf-8'?> ");
fwrite($ponteiro, "<root>");
fwrite($ponteiro, '<UploadSICI ano="'.$ano.'" mes="'.$mes.'">');
fwrite($ponteiro, '<Outorga fistel="'.$outorga.'">');
fwrite($ponteiro, '<Indicador Sigla="IEM4">');
fwrite($ponteiro, '<Conteudo uf="'.$iem4auf.'" item="a" valor="'.$iem4avalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM5">');
fwrite($ponteiro, '<Conteudo uf="'.$iem5auf.'" item="a" valor="'.$iem5avalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM9">');
fwrite($ponteiro, '<Pessoa item="F">');
fwrite($ponteiro, '<Conteudo uf="'.$iem9fauf.'" item="a" valor="'.$iem9favalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9fbuf.'" item="b" valor="'.$iem9fbvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9fcuf.'" item="c" valor="'.$iem9fcvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9fduf.'" item="d" valor="'.$iem9fdvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9feuf.'" item="e" valor="'.$iem9fevalor.'"/>');
fwrite($ponteiro, '</Pessoa>');
fwrite($ponteiro, '<Pessoa item="J">');
fwrite($ponteiro, '<Conteudo uf="'.$iem9jauf.'" item="a" valor="'.$iem9javalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9jbuf.'" item="b" valor="'.$iem9jbvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9jcuf.'" item="c" valor="'.$iem9jcvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9jduf.'" item="d" valor="'.$iem9jdvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem9jeuf.'" item="e" valor="'.$iem9jevalor.'"/>');
fwrite($ponteiro, '</Pessoa>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM10">');
fwrite($ponteiro, '<Pessoa item="F">');
fwrite($ponteiro, '<Conteudo uf="'.$iem10fauf.'" item="a" valor="'.$iem10favalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem10fbuf.'" item="b" valor="'.$iem10fbvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem10fcuf.'" item="c" valor="'.$iem10fcvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem10fduf.'" item="d" valor="'.$iem10fdvalor.'"/>');
fwrite($ponteiro, '</Pessoa>');
fwrite($ponteiro, '<Pessoa item="J">');
fwrite($ponteiro, '<Conteudo uf="'.$iem10jauf.'" item="a" valor="'.$iem10javalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem10jbuf.'" item="b" valor="'.$iem10jbvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem10jcuf.'" item="c" valor="'.$iem10jcvalor.'"/>');
fwrite($ponteiro, '<Conteudo uf="'.$iem10jduf.'" item="d" valor="'.$iem10jdvalor.'"/>');
fwrite($ponteiro, '</Pessoa>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IPL3">');
fwrite($ponteiro, '<Municipio codmunicipio="'.$ipl3codm.'">');
fwrite($ponteiro, '<Pessoa item="F">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$ipl3pf.'"/>');
fwrite($ponteiro, '</Pessoa>');
fwrite($ponteiro, '<Pessoa item="J">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$ipl3pj.'"/>');
fwrite($ponteiro, '</Pessoa>');
fwrite($ponteiro, '</Municipio>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="QAIPL4SM">');
fwrite($ponteiro, '<Municipio codmunicipio="'.$qaipl4smcodm.'">');
fwrite($ponteiro, '<Tecnologia item="A">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smaqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smatotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4sma15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4sma16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4sma17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4sma18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4sma19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="B">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smbqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smbtotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smb15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smb16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smb17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smb18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smb19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="C">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smcqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smctotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smc15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smc16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smc17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smc18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smc19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="D">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smdqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smdtotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smd15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smd16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smd17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smd18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smd19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="E">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smeqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smetotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4sme15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4sme16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4sme17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4sme18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4sme19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="F">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smfqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smftotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smf15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smf15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smf15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smf15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smf15.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="G">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smgqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smgtotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smg15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smg16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smg17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smg18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smg19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="H">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smhqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smhtotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smh15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smh16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smh17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smh18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smh19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="I">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smiqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smitotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smh15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smh16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smh17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smh18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smh19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="J">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smjqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smjtotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smj15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smj16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smj17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smj18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smj19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="L">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smlqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smltotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4sml15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4sml16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4sml17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4sml18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4sml19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="M">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smmqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smmtotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smm15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smm16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smm17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smm18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smm19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="N">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smnqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smntotal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smn15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smn16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smn17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smn18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smn19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '<Tecnologia item="O">');
fwrite($ponteiro, '<Conteudo nome="QAIPL5SM" valor="'.$qaipl4smoqaipl5sm.'"/>');
fwrite($ponteiro, '<Conteudo nome="total" valor="'.$qaipl4smototal.'"/>');
fwrite($ponteiro, '<Conteudo faixa="15" valor="'.$qaipl4smo15.'"/>');
fwrite($ponteiro, '<Conteudo faixa="16" valor="'.$qaipl4smo16.'"/>');
fwrite($ponteiro, '<Conteudo faixa="17" valor="'.$qaipl4smo17.'"/>');
fwrite($ponteiro, '<Conteudo faixa="18" valor="'.$qaipl4smo18.'"/>');
fwrite($ponteiro, '<Conteudo faixa="19" valor="'.$qaipl4smo19.'"/>');
fwrite($ponteiro, '</Tecnologia>');
fwrite($ponteiro, '</Municipio>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IPL6IM">');
fwrite($ponteiro, '<Conteudo codmunicipio="'.$ipl6imcodm.'" valor="0"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IAU1">');
fwrite($ponteiro, '<Conteudo valor="'.$num_cat.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IPL1">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$ipl1a.'"/>');
fwrite($ponteiro, '<Conteudo item="b" valor="'.$ipl1b.'"/>');
fwrite($ponteiro, '<Conteudo item="c" valor="'.$ipl1c.'"/>');
fwrite($ponteiro, '<Conteudo item="d" valor="'.$ipl1d.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IPL2">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$ipl2a.'"/>');
fwrite($ponteiro, '<Conteudo item="b" valor="'.$ipl2b.'"/>');
fwrite($ponteiro, '<Conteudo item="c" valor="'.$ipl2c.'"/>');
fwrite($ponteiro, '<Conteudo item="d" valor="'.$ipl2d.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM1">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$iem1avalor.'"/>');
fwrite($ponteiro, '<Conteudo item="b" valor="'.$iem1bvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="c" valor="'.$iem1cvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="d" valor="'.$iem1dvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="e" valor="'.$iem1evalor.'"/>');
fwrite($ponteiro, '<Conteudo item="f" valor="'.$iem1fvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="g" valor="'.$iem1gvalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM2">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$iem2avalor.'"/>');
fwrite($ponteiro, '<Conteudo item="b" valor="'.$iem2bvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="c" valor="'.$iem2cvalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM3">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$iem3avalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM6">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$iem6avalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM7">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$iem7avalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '<Indicador Sigla="IEM8">');
fwrite($ponteiro, '<Conteudo item="a" valor="'.$iem8avalor.'"/>');
fwrite($ponteiro, '<Conteudo item="b" valor="'.$iem8bvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="c" valor="'.$iem8cvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="d" valor="'.$iem8dvalor.'"/>');
fwrite($ponteiro, '<Conteudo item="e" valor="'.$iem8evalor.'"/>');
fwrite($ponteiro, '</Indicador>');
fwrite($ponteiro, '</Outorga>');
// Fecha Pai
fwrite($ponteiro, "</UploadSICI>");
fwrite($ponteiro, "</root>");

// Fecha XML
fclose($ponteiro);


} // Fecha IF($row)
?>
<script>
alert('SICI Gerado e Atualizado');
document.location.href = ("XML/sici<?php echo base64_decode($_GET['sici']); ?>.xml");
</script>
