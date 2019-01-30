<?php 
    /*
    Função CRUD
    Coleta de Dados SICI
    Ultima Atualização: 25/11/2014
    */
    
    $idempresa = $_SESSION['empresa'];
    @$getId = base64_decode($_GET['id']); 
    if(@$getId){ 
        
        $alterar = $mysqli->query("SELECT * FROM sici WHERE id = + $getId AND empresa = '$idempresa'");
        $campo = mysqli_fetch_array($alterar);
    }
					
    if(isset ($_POST['cadastrar'])){ 
    
    $empresa = $_SESSION['empresa'];
    
    
    
    
    $crud = new crud('sici');  // tabela como parametro
    $crud->inserir("empresa,ano,mes,outorga,num_cat,ipl1a,ipl1b,ipl1c,ipl1d,ipl2a,ipl2b,ipl2c,ipl2d,ipl3codm,ipl3pf,ipl3pj,ipl6imcodm,ipl6imvalor,iem1avalor,iem1bvalor,iem1cvalor,iem1dvalor,iem1evalor,iem1fvalor,iem1gvalor,iem2avalor,iem2bvalor,iem2cvalor,iem3avalor,iem4auf,iem4avalor,iem5auf,iem5avalor,iem6avalor,iem7avalor,iem8avalor,iem8bvalor,iem8cvalor,iem8dvalor,iem8evalor,iem9fauf,iem9favalor,iem9jauf,iem9javalor,iem9fbuf,iem9fbvalor,iem9jbuf,iem9jbvalor,iem9fcuf,iem9fcvalor,iem9jcuf,iem9jcvalor,iem9fduf,iem9fdvalor,iem9jduf,iem9jdvalor,iem9feuf,iem9fevalor,iem9jeuf,iem9jevalor,iem10fauf,iem10favalor,iem10jauf,iem10javalor,iem10fbuf,iem10fbvalor,iem10jbuf,iem10jbvalor,iem10fcuf,iem10fcvalor,iem10jcuf,iem10jcvalor,iem10fduf,iem10fdvalor,iem10jduf,iem10jdvalor,qaipl4smmqaipl5sm,qaipl4smmtotal,qaipl4smm15,qaipl4smm16,qaipl4smm17,qaipl4smm18,qaipl4smm19,qaipl4smnqaipl5sm,qaipl4smntotal,qaipl4smn15,qaipl4smn16,qaipl4smn17,qaipl4smn18,qaipl4smn19,qaipl4smoqaipl5sm,qaipl4smototal,qaipl4smo15,qaipl4smo16,qaipl4smo17,qaipl4smo18,qaipl4smo19,qaipl4smcodm,qaipl4smaqaipl5sm,qaipl4smatotal,qaipl4sma15,qaipl4sma16,qaipl4sma17,qaipl4sma18,qaipl4sma19,qaipl4smbqaipl5sm,qaipl4smbtotal,qaipl4smb15,qaipl4smb16,qaipl4smb17,qaipl4smb18,qaipl4smcqaipl5sm,qaipl4smctotal,qaipl4smc15,qaipl4smc16,qaipl4smc17,qaipl4smc18,qaipl4smc19,qaipl4smdqaipl5sm,qaipl4smdtotal,qaipl4smd15,qaipl4smd16,qaipl4smd17,qaipl4smd18,qaipl4smd19,qaipl4smeqaipl5sm,qaipl4smetotal,qaipl4sme15,qaipl4sme16,qaipl4sme17,qaipl4sme18,qaipl4sme19,qaipl4smfqaipl5sm,qaipl4smftotal,qaipl4smf15,qaipl4smf16,qaipl4smf17,qaipl4smf18,qaipl4smf19,qaipl4smgqaipl5sm,qaipl4smgtotal,qaipl4smg15,qaipl4smg16,qaipl4smg17,qaipl4smg18,qaipl4smg19,qaipl4smhqaipl5sm,qaipl4smhtotal,qaipl4smh15,qaipl4smh16,qaipl4smh17,qaipl4smh18,qaipl4smh19,qaipl4smiqaipl5sm,qaipl4smitotal,qaipl4smi15,qaipl4smi16,qaipl4smi17,qaipl4smi18,qaipl4smi19,qaipl4smjqaipl5sm,qaipl4smjtotal,qaipl4smj15,qaipl4smj16,qaipl4smj17,qaipl4smj18,qaipl4smj19,qaipl4smkqaipl5sm,qaipl4smktotal,qaipl4smk15,qaipl4smk16,qaipl4smk17,qaipl4smk18,qaipl4smk19,qaipl4smlqaipl5sm,qaipl4smltotal,qaipl4sml15,qaipl4sml16,qaipl4sml17,qaipl4sml18,qaipl4sml19", "'$empresa','$_POST[ano]','$_POST[mes]','$_POST[outorga]','$_POST[num_cat]','$_POST[ipl1a]','$_POST[ipl1b]','$_POST[ipl1c]','$_POST[ipl1d]','$_POST[ipl2a]','$_POST[ipl2b]','$_POST[ipl2c]','$_POST[ipl2d]','$_POST[ipl3codm]','$_POST[ipl3pf]','$_POST[ipl3pj]','$_POST[ipl6imcodm]','$_POST[ipl6imvalor]','$_POST[iem1avalor]','$_POST[iem1bvalor]','$_POST[iem1cvalor]','$_POST[iem1dvalor]','$_POST[iem1evalor]','$_POST[iem1fvalor]','$_POST[iem1gvalor]','$_POST[iem2avalor]','$_POST[iem2bvalor]','$_POST[iem2cvalor]','$_POST[iem3avalor]','$_POST[iem4auf]','$_POST[iem4avalor]','$_POST[iem5auf]','$_POST[iem5avalor]','$_POST[iem6avalor]','$_POST[iem7avalor]','$_POST[iem8avalor]','$_POST[iem8bvalor]','$_POST[iem8cvalor]','$_POST[iem8dvalor]','$_POST[iem8evalor]','$_POST[iem9fauf]','$_POST[iem9favalor]','$_POST[iem9jauf]','$_POST[iem9javalor]','$_POST[iem9fbuf]','$_POST[iem9fbvalor]','$_POST[iem9jbuf]','$_POST[iem9jbvalor]','$_POST[iem9fcuf]','$_POST[iem9fcvalor]','$_POST[iem9jcuf]','$_POST[iem9jcvalor]','$_POST[iem9fduf]','$_POST[iem9fdvalor]','$_POST[iem9jduf]','$_POST[iem9jdvalor]','$_POST[iem9feuf]','$_POST[iem9fevalor]','$_POST[iem9jeuf]','$_POST[iem9jevalor]','$_POST[iem10fauf]','$_POST[iem10favalor]','$_POST[iem10jauf]','$_POST[iem10javalor]','$_POST[iem10fbuf]','$_POST[iem10fbvalor]','$_POST[iem10jbuf]','$_POST[iem10jbvalor]','$_POST[iem10fcuf]','$_POST[iem10fcvalor]','$_POST[iem10jcuf]','$_POST[iem10jcvalor]','$_POST[iem10fduf]','$_POST[iem10fdvalor]','$_POST[iem10jduf]','$_POST[iem10jdvalor]','$_POST[qaipl4smmqaipl5sm]','$_POST[qaipl4smmtotal]','$_POST[qaipl4smm15]','$_POST[qaipl4smm16]','$_POST[qaipl4smm17]','$_POST[qaipl4smm18]','$_POST[qaipl4smm19]','$_POST[qaipl4smnqaipl5sm]','$_POST[qaipl4smntotal]','$_POST[qaipl4smn15]','$_POST[qaipl4smn16]','$_POST[qaipl4smn17]','$_POST[qaipl4smn18]','$_POST[qaipl4smn19]','$_POST[qaipl4smoqaipl5sm]','$_POST[qaipl4smototal]','$_POST[qaipl4smo15]','$_POST[qaipl4smo16]','$_POST[qaipl4smo17]','$_POST[qaipl4smo18]','$_POST[qaipl4smo19]','$_POST[qaipl4smcodm]','$_POST[qaipl4smaqaipl5sm]','$_POST[qaipl4smatotal]','$_POST[qaipl4sma15]','$_POST[qaipl4sma16]','$_POST[qaipl4sma17]','$_POST[qaipl4sma18]','$_POST[qaipl4sma19]','$_POST[qaipl4smbqaipl5sm]','$_POST[qaipl4smbtotal]','$_POST[qaipl4smb15]','$_POST[qaipl4smb16]','$_POST[qaipl4smb17]','$_POST[qaipl4smb18]','$_POST[qaipl4smcqaipl5sm]','$_POST[qaipl4smctotal]','$_POST[qaipl4smc15]','$_POST[qaipl4smc16]','$_POST[qaipl4smc17]','$_POST[qaipl4smc18]','$_POST[qaipl4smc19]','$_POST[qaipl4smdqaipl5sm]','$_POST[qaipl4smdtotal]','$_POST[qaipl4smd15]','$_POST[qaipl4smd16]','$_POST[qaipl4smd17]','$_POST[qaipl4smd18]','$_POST[qaipl4smd19]','$_POST[qaipl4smeqaipl5sm]','$_POST[qaipl4smetotal]','$_POST[qaipl4sme15]','$_POST[qaipl4sme16]','$_POST[qaipl4sme17]','$_POST[qaipl4sme18]','$_POST[qaipl4sme19]','$_POST[qaipl4smfqaipl5sm]','$_POST[qaipl4smftotal]','$_POST[qaipl4smf15]','$_POST[qaipl4smf16]','$_POST[qaipl4smf17]','$_POST[qaipl4smf18]','$_POST[qaipl4smf19]','$_POST[qaipl4smgqaipl5sm]','$_POST[qaipl4smgtotal]','$_POST[qaipl4smg15]','$_POST[qaipl4smg16]','$_POST[qaipl4smg17]','$_POST[qaipl4smg18]','$_POST[qaipl4smg19]','$_POST[qaipl4smhqaipl5sm]','$_POST[qaipl4smhtotal]','$_POST[qaipl4smh15]','$_POST[qaipl4smh16]','$_POST[qaipl4smh17]','$_POST[qaipl4smh18]','$_POST[qaipl4smh19]','$_POST[qaipl4smiqaipl5sm]','$_POST[qaipl4smitotal]','$_POST[qaipl4smi15]','$_POST[qaipl4smi16]','$_POST[qaipl4smi17]','$_POST[qaipl4smi18]','$_POST[qaipl4smi19]','$_POST[qaipl4smjqaipl5sm]','$_POST[qaipl4smjtotal]','$_POST[qaipl4smj15]','$_POST[qaipl4smj16]','$_POST[qaipl4smj17]','$_POST[qaipl4smj18]','$_POST[qaipl4smj19]','$_POST[qaipl4smkqaipl5sm]','$_POST[qaipl4smktotal]','$_POST[qaipl4smk15]','$_POST[qaipl4smk16]','$_POST[qaipl4smk17]','$_POST[qaipl4smk18]','$_POST[qaipl4smk19]','$_POST[qaipl4smlqaipl5sm]','$_POST[qaipl4smltotal]','$_POST[qaipl4sml15]','$_POST[qaipl4sml16]','$_POST[qaipl4sml17]','$_POST[qaipl4sml18]','$_POST[qaipl4sml19]'");
       
    header("Location: index.php?app=SICI&reg=1");					
    }
    
    if(isset ($_POST['editar'])){
    
    $iem9fauf = $_POST['iem9fauf'];
    $siciid = $_POST['siciid'];
    
    $crud = new crud('sici'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("ano='$_POST[ano]',mes='$_POST[mes]',outorga='$_POST[outorga]',num_cat='$_POST[num_cat]',ipl1a='$_POST[ipl1a]',ipl1b='$_POST[ipl1b]',ipl1c='$_POST[ipl1c]',ipl1d='$_POST[ipl1d]',ipl2a='$_POST[ipl2a]',ipl2b='$_POST[ipl2b]',ipl2c='$_POST[ipl2c]',ipl2d='$_POST[ipl2d]',ipl3codm='$_POST[ipl3codm]',ipl3pf='$_POST[ipl3pf]',ipl3pj='$_POST[ipl3pj]',ipl6imcodm='$_POST[ipl6imcodm]',ipl6imvalor='$_POST[ipl6imvalor]',iem1avalor='$_POST[iem1avalor]',iem1bvalor='$_POST[iem1bvalor]',iem1cvalor='$_POST[iem1cvalor]',iem1dvalor='$_POST[iem1dvalor]',iem1evalor='$_POST[iem1evalor]',iem1fvalor='$_POST[iem1fvalor]',iem1gvalor='$_POST[iem1gvalor]',iem2avalor='$_POST[iem2avalor]',iem2bvalor='$_POST[iem2bvalor]',iem2cvalor='$_POST[iem2cvalor]',iem3avalor='$_POST[iem3avalor]',iem4auf='$_POST[iem4auf]',iem4avalor='$_POST[iem4avalor]',iem5auf='$_POST[iem5auf]',iem5avalor='$_POST[iem5avalor]',iem6avalor='$_POST[iem6avalor]',iem7avalor='$_POST[iem7avalor]',iem8avalor='$_POST[iem8avalor]',iem8bvalor='$_POST[iem8bvalor]',iem8cvalor='$_POST[iem8cvalor]',iem8dvalor='$_POST[iem8dvalor]',iem8evalor='$_POST[iem8evalor]',iem9fauf='$_POST[iem9fauf]',iem9favalor='$_POST[iem9favalor]',iem9jauf='$_POST[iem9jauf]',iem9javalor='$_POST[iem9javalor]',iem9fbuf='$_POST[iem9fbuf]',iem9fbvalor='$_POST[iem9fbvalor]',iem9jbuf='$_POST[iem9jbuf]',iem9jbvalor='$_POST[iem9jbvalor]',iem9fcuf='$_POST[iem9fcuf]',iem9fcvalor='$_POST[iem9fcvalor]',iem9jcuf='$_POST[iem9jcuf]',iem9jcvalor='$_POST[iem9jcvalor]',iem9fduf='$_POST[iem9fduf]',iem9fdvalor='$_POST[iem9fdvalor]',iem9jduf='$_POST[iem9jduf]',iem9jdvalor='$_POST[iem9jdvalor]',iem9feuf='$_POST[iem9feuf]',iem9fevalor='$_POST[iem9fevalor]',iem9jeuf='$_POST[iem9jeuf]',iem9jevalor='$_POST[iem9jevalor]',iem10fauf='$_POST[iem10fauf]',iem10favalor='$_POST[iem10favalor]',iem10jauf='$_POST[iem10jauf]',iem10javalor='$_POST[iem10javalor]',iem10fbuf='$_POST[iem10fbuf]',iem10fbvalor='$_POST[iem10fbvalor]',iem10jbuf='$_POST[iem10jbuf]',iem10jbvalor='$_POST[iem10jbvalor]',iem10fcuf='$_POST[iem10fcuf]',iem10fcvalor='$_POST[iem10fcvalor]',iem10jcuf='$_POST[iem10jcuf]',iem10jcvalor='$_POST[iem10jcvalor]',iem10fduf='$_POST[iem10fduf]',iem10fdvalor='$_POST[iem10fdvalor]',iem10jduf='$_POST[iem10jduf]',iem10jdvalor='$_POST[iem10jdvalor]',qaipl4smmqaipl5sm='$_POST[qaipl4smmqaipl5sm]',qaipl4smmtotal='$_POST[qaipl4smmtotal]',qaipl4smm15='$_POST[qaipl4smm15]',qaipl4smm16='$_POST[qaipl4smm16]',qaipl4smm17='$_POST[qaipl4smm17]',qaipl4smm18='$_POST[qaipl4smm18]',qaipl4smm19='$_POST[qaipl4smm19]',qaipl4smnqaipl5sm='$_POST[qaipl4smnqaipl5sm]',qaipl4smntotal='$_POST[qaipl4smntotal]',qaipl4smn15='$_POST[qaipl4smn15]',qaipl4smn16='$_POST[qaipl4smn16]',qaipl4smn17='$_POST[qaipl4smn17]',qaipl4smn18='$_POST[qaipl4smn18]',qaipl4smn19='$_POST[qaipl4smn19]',qaipl4smoqaipl5sm='$_POST[qaipl4smoqaipl5sm]',qaipl4smototal='$_POST[qaipl4smototal]',qaipl4smo15='$_POST[qaipl4smo15]',qaipl4smo16='$_POST[qaipl4smo16]',qaipl4smo17='$_POST[qaipl4smo17]',qaipl4smo18='$_POST[qaipl4smo18]',qaipl4smo19='$_POST[qaipl4smo19]',qaipl4smcodm='$_POST[qaipl4smcodm]',qaipl4smaqaipl5sm='$_POST[qaipl4smaqaipl5sm]',qaipl4smatotal='$_POST[qaipl4smatotal]',qaipl4sma15='$_POST[qaipl4sma15]',qaipl4sma16='$_POST[qaipl4sma16]',qaipl4sma17='$_POST[qaipl4sma17]',qaipl4sma18='$_POST[qaipl4sma18]',qaipl4sma19='$_POST[qaipl4sma19]',qaipl4smbqaipl5sm='$_POST[qaipl4smbqaipl5sm]',qaipl4smbtotal='$_POST[qaipl4smbtotal]',qaipl4smb15='$_POST[qaipl4smb15]',qaipl4smb16='$_POST[qaipl4smb16]',qaipl4smb17='$_POST[qaipl4smb17]',qaipl4smb18='$_POST[qaipl4smb18]',qaipl4smcqaipl5sm='$_POST[qaipl4smcqaipl5sm]',qaipl4smctotal='$_POST[qaipl4smctotal]',qaipl4smc15='$_POST[qaipl4smc15]',qaipl4smc16='$_POST[qaipl4smc16]',qaipl4smc17='$_POST[qaipl4smc17]',qaipl4smc18='$_POST[qaipl4smc18]',qaipl4smc19='$_POST[qaipl4smc19]',qaipl4smdqaipl5sm='$_POST[qaipl4smdqaipl5sm]',qaipl4smdtotal='$_POST[qaipl4smdtotal]',qaipl4smd15='$_POST[qaipl4smd15]',qaipl4smd16='$_POST[qaipl4smd16]',qaipl4smd17='$_POST[qaipl4smd17]',qaipl4smd18='$_POST[qaipl4smd18]',qaipl4smd19='$_POST[qaipl4smd19]',qaipl4smeqaipl5sm='$_POST[qaipl4smeqaipl5sm]',qaipl4smetotal='$_POST[qaipl4smetotal]',qaipl4sme15='$_POST[qaipl4sme15]',qaipl4sme16='$_POST[qaipl4sme16]',qaipl4sme17='$_POST[qaipl4sme17]',qaipl4sme18='$_POST[qaipl4sme18]',qaipl4sme19='$_POST[qaipl4sme19]',qaipl4smfqaipl5sm='$_POST[qaipl4smfqaipl5sm]',qaipl4smftotal='$_POST[qaipl4smftotal]',qaipl4smf15='$_POST[qaipl4smf15]',qaipl4smf16='$_POST[qaipl4smf16]',qaipl4smf17='$_POST[qaipl4smf17]',qaipl4smf18='$_POST[qaipl4smf18]',qaipl4smf19='$_POST[qaipl4smf19]',qaipl4smgqaipl5sm='$_POST[qaipl4smgqaipl5sm]',qaipl4smgtotal='$_POST[qaipl4smgtotal]',qaipl4smg15='$_POST[qaipl4smg15]',qaipl4smg16='$_POST[qaipl4smg16]',qaipl4smg17='$_POST[qaipl4smg17]',qaipl4smg18='$_POST[qaipl4smg18]',qaipl4smg19='$_POST[qaipl4smg19]',qaipl4smhqaipl5sm='$_POST[qaipl4smhqaipl5sm]',qaipl4smhtotal='$_POST[qaipl4smhtotal]',qaipl4smh15='$_POST[qaipl4smh15]',qaipl4smh16='$_POST[qaipl4smh16]',qaipl4smh17='$_POST[qaipl4smh17]',qaipl4smh18='$_POST[qaipl4smh18]',qaipl4smh19='$_POST[qaipl4smh19]',qaipl4smiqaipl5sm='$_POST[qaipl4smiqaipl5sm]',qaipl4smitotal='$_POST[qaipl4smitotal]',qaipl4smi15='$_POST[qaipl4smi15]',qaipl4smi16='$_POST[qaipl4smi16]',qaipl4smi17='$_POST[qaipl4smi17]',qaipl4smi18='$_POST[qaipl4smi18]',qaipl4smi19='$_POST[qaipl4smi19]',qaipl4smjqaipl5sm='$_POST[qaipl4smjqaipl5sm]',qaipl4smjtotal='$_POST[qaipl4smjtotal]',qaipl4smj15='$_POST[qaipl4smj15]',qaipl4smj16='$_POST[qaipl4smj16]',qaipl4smj17='$_POST[qaipl4smj17]',qaipl4smj18='$_POST[qaipl4smj18]',qaipl4smj19='$_POST[qaipl4smj19]',qaipl4smkqaipl5sm='$_POST[qaipl4smkqaipl5sm]',qaipl4smktotal='$_POST[qaipl4smktotal]',qaipl4smk15='$_POST[qaipl4smk15]',qaipl4smk16='$_POST[qaipl4smk16]',qaipl4smk17='$_POST[qaipl4smk17]',qaipl4smk18='$_POST[qaipl4smk18]',qaipl4smk19='$_POST[qaipl4smk19]',qaipl4smlqaipl5sm='$_POST[qaipl4smlqaipl5sm]',qaipl4smltotal='$_POST[qaipl4smltotal]',qaipl4sml15='$_POST[qaipl4sml15]',qaipl4sml16='$_POST[qaipl4sml16]',qaipl4sml17='$_POST[qaipl4sml17]',qaipl4sml18='$_POST[qaipl4sml18]',qaipl4sml19='$_POST[qaipl4sml19]'", "id='$siciid'"); 
    
    header("Location: index.php?app=SICI&reg=2");
    }
    
    if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista
    $crud = new crud('sici'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado
    
    header("Location: index.php?app=SICI&reg=3");
    }
										
?>
<!-- Masked Validate -->
<script type="text/javascript" src="assets/js/jquery.validate.js"></script>
<!-- Masked Input -->
<script type="text/javascript" src="assets/js/jquery.maskedinput-1.3.min.js"></script>
<!-- Alpha Numeric -->
<script type="text/javascript" src="assets/js/jquery.alphanumeric.js"></script>
<script>
		
		   $().ready(function() {
		   $("#formSici").validate();
		   $("#outorga").numeric();
		   $("#num_cat").numeric({allow:""});
		   $("#ipl3codm").numeric();
		   $("#ipl3pj").numeric();
		   $("#ipl3pf").numeric();
		   $("#qaipl4smcodm").numeric();
		   $("#qaipl4smcqaipl5sm").numeric();
		   $("#qaipl4smctotal").numeric();
		   $("#qaipl4smc15").numeric();
		   $("#qaipl4smc16").numeric();
		   $("#qaipl4smc17").numeric();
		   $("#qaipl4smc18").numeric();
		   $("#qaipl4smc19").numeric();
		   $("#ipl6imcodm").numeric();
		   $("#ipl6imvalor").numeric();
		   $("#iem1avalor").numeric({allow:","});
		   $("#iem1bvalor").numeric({allow:","});
		   $("#iem1cvalor").numeric({allow:","});
		   $("#iem1dvalor").numeric({allow:","});
		   $("#iem1evalor").numeric({allow:","});
		   $("#iem1fvalor").numeric({allow:","});
		   $("#iem1gvalor").numeric({allow:","});
		   $("#iem2avalor").numeric({allow:","});
		   $("#iem2bvalor").numeric({allow:","});
		   $("#iem2cvalor").numeric({allow:","});
		   $("#iem3avalor").numeric({allow:","});
		   $("#iem4auf").alpha();
		   $("#iem4avalor").numeric();
		   $("#iem5auf").alpha();
		   $("#iem5avalor").numeric();
		   $("#iem6avalor").numeric({allow:","});
		   $("#iem7avalor").numeric({allow:","});
		   $("#ipl1a").numeric({allow:","});
		   $("#ipl1b").numeric({allow:","});
		   $("#ipl1c").numeric({allow:","});
		   $("#ipl1d").numeric({allow:","});
		   $("#ipl2a").numeric({allow:","});
		   $("#ipl2b").numeric({allow:","});
		   $("#ipl2c").numeric({allow:","});
		   $("#ipl2d").numeric({allow:","});
		   $("#iem9fauf").alpha();
		   $("#iem9fbuf").alpha();
		   $("#iem9fcuf").alpha();
		   $("#iem9fduf").alpha();
		   $("#iem9feuf").alpha();
		   $("#iem9jauf").alpha();
		   $("#iem9jbuf").alpha();
		   $("#iem9jcuf").alpha();
		   $("#iem9jduf").alpha();
		   $("#iem9jeuf").alpha();
		   $("#iem9favalor").numeric();
		   $("#iem9fbvalor").numeric();
		   $("#iem9fcvalor").numeric();
		   $("#iem9fdvalor").numeric();
		   $("#iem9fevalor").numeric();
		   $("#iem9javalor").numeric();
		   $("#iem9jbvalor").numeric();
		   $("#iem9jcvalor").numeric();
		   $("#iem9jdvalor").numeric();
		   $("#iem9jevalor").numeric();
		   $("#iem8avalor").numeric({allow:","});
		   $("#iem8bvalor").numeric({allow:","});
		   $("#iem8cvalor").numeric({allow:","});
		   $("#iem8dvalor").numeric({allow:","});
		   $("#iem8evalor").numeric({allow:","});
		   $("#iem10fauf").alpha();
		   $("#iem10fbuf").alpha();
		   $("#iem10fcuf").alpha();
		   $("#iem10fduf").alpha();
		   $("#iem10jauf").alpha();
		   $("#iem10jbuf").alpha();
		   $("#iem10jcuf").alpha();
		   $("#iem10jduf").alpha();
		   $("#iem10favalor").numeric({allow:","});
		   $("#iem10fbvalor").numeric({allow:","});
		   $("#iem10fcvalor").numeric({allow:","});
		   $("#iem10fdvalor").numeric({allow:","});
		   $("#iem10javalor").numeric({allow:","});
		   $("#iem10jbvalor").numeric({allow:","});
		   $("#iem10jcvalor").numeric({allow:","});
		   $("#iem10jdvalor").numeric({allow:","});
		   $("#qaipl4smaqaipl5sm").numeric();
		   $("#qaipl4smatotal").numeric();
		   $("#qaipl4sma15").numeric();
		   $("#qaipl4sma16").numeric();
		   $("#qaipl4sma17").numeric();
		   $("#qaipl4sma18").numeric();
		   $("#qaipl4sma19").numeric();
		   $("#qaipl4smbqaipl5sm").numeric();
		   $("#qaipl4smbtotal").numeric();
		   $("#qaipl4smb15").numeric();
		   $("#qaipl4smb16").numeric();
		   $("#qaipl4smb17").numeric();
		   $("#qaipl4smb18").numeric();
		   $("#qaipl4smb19").numeric();
		   $("#qaipl4smcqaipl5sm").numeric();
		   $("#qaipl4smctotal").numeric();
		   $("#qaipl4smc15").numeric();
		   $("#qaipl4smc16").numeric();
		   $("#qaipl4smc17").numeric();
		   $("#qaipl4smc18").numeric();
		   $("#qaipl4smc19").numeric();
		   $("#qaipl4smdqaipl5sm").numeric();
		   $("#qaipl4smdtotal").numeric();
		   $("#qaipl4smd15").numeric();
		   $("#qaipl4smd16").numeric();
		   $("#qaipl4smd17").numeric();
		   $("#qaipl4smd18").numeric();
		   $("#qaipl4smd19").numeric();
		   $("#qaipl4smeqaipl5sm").numeric();
		   $("#qaipl4smetotal").numeric();
		   $("#qaipl4sme15").numeric();
		   $("#qaipl4sme16").numeric();
		   $("#qaipl4sme17").numeric();
		   $("#qaipl4sme18").numeric();
		   $("#qaipl4sme19").numeric();
		   $("#qaipl4smfqaipl5sm").numeric();
		   $("#qaipl4smftotal").numeric();
		   $("#qaipl4smf15").numeric();
		   $("#qaipl4smf16").numeric();
		   $("#qaipl4smf17").numeric();
		   $("#qaipl4smf18").numeric();
		   $("#qaipl4smf19").numeric();
		   $("#qaipl4smgqaipl5sm").numeric();
		   $("#qaipl4smgtotal").numeric();
		   $("#qaipl4smg15").numeric();
		   $("#qaipl4smg16").numeric();
		   $("#qaipl4smg17").numeric();
		   $("#qaipl4smg18").numeric();
		   $("#qaipl4smg19").numeric();
		   $("#qaipl4smhqaipl5sm").numeric();
		   $("#qaipl4smhtotal").numeric();
		   $("#qaipl4smh15").numeric();
		   $("#qaipl4smh16").numeric();
		   $("#qaipl4smh17").numeric();
		   $("#qaipl4smh18").numeric();
		   $("#qaipl4smh19").numeric();
		   $("#qaipl4smiqaipl5sm").numeric();
		   $("#qaipl4smitotal").numeric();
		   $("#qaipl4smi15").numeric();
		   $("#qaipl4smi16").numeric();
		   $("#qaipl4smi17").numeric();
		   $("#qaipl4smi18").numeric();
		   $("#qaipl4smi19").numeric();
		   $("#qaipl4smjqaipl5sm").numeric();
		   $("#qaipl4smjtotal").numeric();
		   $("#qaipl4smj15").numeric();
		   $("#qaipl4smj16").numeric();
		   $("#qaipl4smj17").numeric();
		   $("#qaipl4smj18").numeric();
		   $("#qaipl4smj19").numeric();
		   $("#qaipl4smkqaipl5sm").numeric();
		   $("#qaipl4smktotal").numeric();
		   $("#qaipl4smk15").numeric();
		   $("#qaipl4smk16").numeric();
		   $("#qaipl4smk17").numeric();
		   $("#qaipl4smk18").numeric();
		   $("#qaipl4smk19").numeric();
		   $("#qaipl4smlqaipl5sm").numeric();
		   $("#qaipl4smltotal").numeric();
		   $("#qaipl4sml15").numeric();
		   $("#qaipl4sml16").numeric();
		   $("#qaipl4sml17").numeric();
		   $("#qaipl4sml18").numeric();
		   $("#qaipl4sml19").numeric();
		   $("#qaipl4smmqaipl5sm").numeric();
		   $("#qaipl4smmtotal").numeric();
		   $("#qaipl4smm15").numeric();
		   $("#qaipl4smm16").numeric();
		   $("#qaipl4smm17").numeric();
		   $("#qaipl4smm18").numeric();
		   $("#qaipl4smm19").numeric();
		   $("#qaipl4smnqaipl5sm").numeric();
		   $("#qaipl4smntotal").numeric();
		   $("#qaipl4smn15").numeric();
		   $("#qaipl4smn16").numeric();
		   $("#qaipl4smn17").numeric();
		   $("#qaipl4smn18").numeric();
		   $("#qaipl4smn19").numeric();
		   $("#qaipl4smoqaipl5sm").numeric();
		   $("#qaipl4smototal").numeric();
		   $("#qaipl4smo15").numeric();
		   $("#qaipl4smo16").numeric();
		   $("#qaipl4smo17").numeric();
		   $("#qaipl4smo18").numeric();
		   $("#qaipl4smo19").numeric();
		   
		   $(".decimal").keypress(function(){
		   	if(this.type == "text" && this.className != "numero_livre"){
			if(this.value.length > 1){
				if(isNaN(this.value.replace(",", ".")) == false){
					if((this.value.indexOf("0") == 0) && (this.value.indexOf(",") != 1)){
						this.value = this.value.substring(1);
					}
				}
			}
			}
		   });
		   
		   $(".fator_soma").keypress(function(){
		   	if(this.type == "text" && this.className != "numero_livre"){
			if(this.value.length > 1){
				if(isNaN(this.value.replace(",", ".")) == false){
					if((this.value.indexOf("0") == 0) && (this.value.indexOf(",") != 1)){
						this.value = this.value.substring(1);
					}
				}
			}
			}
		   });
		   
		   $(".numero").keypress(function(){
		   	if(this.type == "text" && this.className != "numero_livre"){
			if(this.value.length > 1){
				if(isNaN(this.value.replace(",", ".")) == false){
					if((this.value.indexOf("0") == 0) && (this.value.indexOf(",") != 1)){
						this.value = this.value.substring(1);
					}
				}
			}
			}
		   });
		   
		   $(".decimal").change(function(){
		   if(this.value.indexOf(",") < 0){
		   	this.value = this.value + ",00";	
		   } else {
		 	if(this.value.split("").reverse().join("").indexOf(",") == 1){
				this.value = this.value+"0";
			}
			if(this.value.split("").reverse().join("").indexOf(",") > 2){
				this.value = parseFloat(this.value.replace(",", ".")).toFixed(2).replace(".", ",");
			}
		   }
		   
		   });
		   $(".fator_soma").change(function(){
		   	var resultado = 0;
			var classeArr = "";
			var parte = "";
			classeArr = this.className.split(" ");
			parte = classeArr[1];
			$(".fator_soma."+parte).each(function(){
				resultado = parseFloat(this.value.replace(",", ".")) + parseFloat(resultado);
			});		
			$(".resultado_soma."+parte).each(function(){
				this.value = resultado;
				if(classeArr[2] == "decimal"){
					this.value = this.value.replace(".", ",");
				}
			});
		   });
		   		});
		
		</script>
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=SICI">Ferramentas</a></li>
            <li class="active">SICI ANATEL</li>
          </ul>
        </div>
        
        <?php if($permissao['fr1'] == S) { ?>
        
        <div class="page-header">
          <h1>Ferramentas<small> Coleta de Dados (SICI)</small></h1>
        </div>
        
        <div class="powerwidget yellow" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Ferramentas<small>SICI</small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" method="POST" class="orb-form">
                  <fieldset>
                  
                   <section class="col col-4">
                      <label class="label">Ano do Período da Coleta</label>
                      <label class="select">
                      <select id="ano" name="ano" class="formcontrol" required>
		      <option>Selecione</option>
		      <option value="2014" <?php if (@$campo['ano'] == 2014) { echo "selected"; } ?>>2014</option>
		      <option value="2015" <?php if (@$campo['ano'] == 2015) { echo "selected"; } ?>>2015</option>
		      <option value="2016" <?php if (@$campo['ano'] == 2016) { echo "selected"; } ?>>2016</option>
		      <option value="2017" <?php if (@$campo['ano'] == 2017) { echo "selected"; } ?>>2017</option>
		      <option value="2018" <?php if (@$campo['ano'] == 2018) { echo "selected"; } ?>>2018</option>
		      <option value="2019" <?php if (@$campo['ano'] == 2019) { echo "selected"; } ?>>2019</option>
		      <option value="2020" <?php if (@$campo['ano'] == 2020) { echo "selected"; } ?>>2020</option>
 		      </select>
                      </label>
                    </section>
                    
                 <section class="col col-4">
                      <label class="label">Mês da Coleta</label>
                      <label class="select">
                      <select id="mes" name="mes" class="formcontrol" required>
		      <option>Selecione</option>
		      <option value="01" <?php if (@$campo['mes'] == 1) { echo "selected"; } ?>>Janeiro</option>
		      <option value="02" <?php if (@$campo['mes'] == 2) { echo "selected"; } ?>>Fevereiro</option>
		      <option value="03" <?php if (@$campo['mes'] == 3) { echo "selected"; } ?>>Março</option>
		      <option value="04" <?php if (@$campo['mes'] == 4) { echo "selected"; } ?>>Abril</option>
		      <option value="05" <?php if (@$campo['mes'] == 5) { echo "selected"; } ?>>Maio</option>
		      <option value="06" <?php if (@$campo['mes'] == 6) { echo "selected"; } ?>>Junho</option>
		      <option value="07" <?php if (@$campo['mes'] == 7) { echo "selected"; } ?>>Julho</option>
		      <option value="08" <?php if (@$campo['mes'] == 8) { echo "selected"; } ?>>Agosto</option>
		      <option value="09" <?php if (@$campo['mes'] == 9) { echo "selected"; } ?>>Setembro</option>
		      <option value="10" <?php if (@$campo['mes'] == 10) { echo "selected"; } ?>>Outubro</option>
		      <option value="11" <?php if (@$campo['mes'] == 11) { echo "selected"; } ?>>Novembro</option>
		      <option value="12" <?php if (@$campo['mes'] == 12) { echo "selected"; } ?>>Dezembro</option>
 		      </select>
                      </label>
                    </section>
                   
                    <section class="col col-2">
                      <label class="label">FISTEL</label>
                      <label class="input">
                        <input type="text" name="outorga"  maxlength="11" value="<?php echo @$campo['outorga']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Número</label>
                      <label class="input">
                        <input type="text" name="num_cat" value="<?php echo @$campo['num_cat']; ?>">
                      </label>
                    </section>
                    
                    <section class="col col-11">
                    <b>IPL1 Rede de Fibra Ótica (Quantidade de Cabos) </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Prestadora</label>
                      <label class="input">
                    <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl1a']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="ipl1a" id="ipl1a" title="Total em quilômetros de cabo da rede de fibra óptica implantada de propriedade da prestadora. Obrigatório ser decimal. Ex: (0,00)" maxlength="21" size="21">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Terceiros</label>
                      <label class="input">
                    <input type="text" name="ipl1b" class="decimal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl1b']; ?><?php } else { ?>0,00<?php } ?>" id="ipl1b" maxlength="21" size="21" title="Total em quilômetros de cabo da rede de fibra óptica implantada de propriedade de terceiros. Obrigatório ser decimal. Ex: (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Crescimento Anual</label>
                      <label class="input">
                    <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl1c']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="ipl1c" id="ipl1c" maxlength="21" size="21" title="Crescimento anual previsto em quilômetros de cabo da rede de fibra óptica de propriedade da prestadora. Obrigatório ser decimal. Ex: (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Crescimento Anual Terceiros</label>
                      <label class="input">
                    <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl1d']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="ipl1d" id="ipl1d" maxlength="21" size="21" title="Crescimento anual previsto em quilômetros de cabo da rede de fibra óptica de propriedade de terceiros. Obrigatório ser decimal. Ex: (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-11">
                    <b>IPL2 Rede de Fibra Ótica (Quantidade de Fibras) </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Prestadora</label>
                      <label class="input">
                    <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl2a']; ?><?php } else { ?>0,00<?php } ?>" name="ipl2a" id="ipl2a" class="decimal" size="21" maxlength="21" title="Total em quilômetros de fibra óptica implantada de propriedade da prestadora. Obrigatório ser decimal. Ex (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Terceiros</label>
                      <label class="input">
                   <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl2b']; ?><?php } else { ?>0,00<?php } ?>" size="21" name="ipl2b" class="decimal" id="ipl2b" maxlength="21" title="Total em quilômetros de fibra óptica implantada de propriedade de terceiros. Obrigatório ser decimal. Ex (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Crescimento Anual</label>
                      <label class="input">
                    <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl2c']; ?><?php } else { ?>0,00<?php } ?>" size="21" name="ipl2c" class="decimal" id="ipl2c" maxlength="21" title="Crescimento anual previsto em quilômetros de fibra óptica de propriedade da prestadora. Obrigatório ser decimal. Ex (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Crescimento Anual Terceiros</label>
                      <label class="input">
                    <input type="text" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl2d']; ?><?php } else { ?>0,00<?php } ?>" size="21" name="ipl2d" class="decimal" id="ipl2d" maxlength="21" title="Crescimento anual previsto em quilômetros de fibra óptica de propriedade de terceiros. Obrigatório ser decimal. Ex (0,00)">
                      </label>
                    </section>
                    
                    <section class="col col-11">
                    <b> IPL3 Distribuição do quantitativo total de acessos fisícos em serviço por tipo de usuário  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Codigo Municipio</label>
                      <label class="input">
                    <input type="text" name="ipl3codm" id="ipl3codm" class="numero_livre" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl3codm']; ?><?php } else { ?>0000000<?php } ?>" maxlength="7" size="7">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Acesso físico P.F.</label>
                      <label class="input">
            <input type="text" name="ipl3pf" id="ipl3pf" class="numero" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl3pf']; ?><?php } else { ?>0<?php } ?>" maxlength="18" size="18" title="Quantitativo de Acesso físico em serviço pelo tipo da Pessoa Física">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Acesso físico P.J.</label>
                      <label class="input">
            <input type="text" name="ipl3pj" id="ipl3pj" class="numero" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl3pj']; ?><?php } else { ?>0<?php } ?>" maxlength="18" size="18" title="Quantitativo de Acesso físico em serviço pelo tipo da Pessoa Jurídica">
                      </label>
                    </section>
                    
                    <section class="col col-11">
                    <b> IPL6IM Capacidade total do sistema instalada em Mbps por município onde a autorizada tem POP (Ponto de Presença) instalado  referente ao indicador IPL6 especificado no Manual do SICI  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Codigo Municipio</label>
                      <label class="input">
            <input type="text" name="ipl6imcodm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl6imcodm']; ?><?php } else { ?>0000000<?php } ?>" class="numero_livre" id="ipl6imcodm" maxlength="7" size="7">
                      </label>
                    </section>
                    
                     <section class="col col-3">
                      <label class="label">Capacidade Total</label>
                      <label class="input">
            <input type="text" name="ipl6imvalor" id="ipl6imvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['ipl6imvalor']; ?><?php } else { ?>0<?php } ?>" class="numero" maxlength="18" size="18" title="Capacidade total do sistema instalada e em serviço em Mbps por município;">
                      </label>
                    </section>
                    
                    
                    <section class="col col-4">
                      <label class="label"><b>IEM1 Total Investimento na Planta</b></label>
                      <label class="input">
            <input type="text" name="iem1avalor" id="iem1avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1avalor']; ?><?php } else { ?>0,00<?php } ?>" readonly="readonly" class="resultado_soma 16 decimal" size="21" maxlength="21" title="Valor total em reais de capital aplicado incluindo rede de transporte de telecomunicações, equipamentos, software, hardware e serviços.">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">Marketing/Propaganda</label>
                      <label class="input">
            <input type="text" name="iem1bvalor" id="iem1bvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1bvalor']; ?><?php } else { ?>0,00<?php } ?>" class="fator_soma 16 decimal" maxlength="21" size="21" title="Valor total em Reais de capital aplicado em Marketing/Propaganda">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Equipamentos</label>
                      <label class="input">
            <input type="text" name="iem1cvalor" id="iem1cvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1cvalor']; ?><?php } else { ?>0,00<?php } ?>" class="fator_soma 16 decimal" maxlength="21" size="21" title="Valor total em Reais de capital aplicado em equipamentos">
                      </label>
                    </section>
                    
                     <section class="col col-3">
                      <label class="label">Softwares</label>
                      <label class="input">
            <input type="text" name="iem1dvalor" id="iem1dvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1dvalor']; ?><?php } else { ?>0,00<?php } ?>" class="fator_soma 16 decimal" maxlength="21" size="21" title="Valor total em Reais de capital aplicado em software">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label">(Pesquisa e Desenvolvimento)</label>
                      <label class="input">
            <input type="text" name="iem1evalor" id="iem1evalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1evalor']; ?><?php } else { ?>0,00<?php } ?>" class="fator_soma 16 decimal" maxlength="21" size="21" title="Valor total em Reais de capital aplicado em P&D (Pesquisa e Desenvolvimento)">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Serviços</label>
                      <label class="input">
            <input type="text" name="iem1fvalor" id="iem1fvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1fvalor']; ?><?php } else { ?>0,00<?php } ?>" class="fator_soma 16 decimal" maxlength="21" size="21" title="Valor total em Reais de capital aplicado em serviços">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">CallCenter</label>
                      <label class="input">
            <input value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem1gvalor']; ?><?php } else { ?>0,00<?php } ?>" class="fator_soma 16 decimal" type="text" name="iem1gvalor" id="iem1gvalor" maxlength="21" size="21" title="Valor total em Reais de capital aplicado em CallCenter ou qualquer tipo de central de atendimento">
                      </label>
                    </section>
                    
            
                    
                    <section class="col col-11">
                    <b>IEM2 Faturamento com a Prestação do serviço</b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Prestação de serviços de telecomunicações</label>
                      <label class="input">
           	<input type="text" name="iem2avalor" id="iem2avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem2avalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" maxlength="21" size="21" title="Faturamento bruto decorrente da prestação de serviços de telecomunicações, excetuandose o faturamento decorrente da exploração industrial de serviços">
                      </label>
                    </section>
                    
              
                    <section class="col col-4">
                      <label class="label">Exploração industrial de serviços de telecomunicações</label>
                      <label class="input">
           	<input type="text" name="iem2bvalor" id="iem2bvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem2bvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" maxlength="21" size="21" title="Faturamento bruto decorrente da exploração industrial de serviços de telecomunicações">
                      </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Provimento de serviços de valor adicionado</label>
                      <label class="input">
           	<input type="text" name="iem2cvalor" id="iem2cvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem2cvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" maxlength="21" size="21" title="Faturamento bruto decorrente do provimento de serviços de valor adicionado">
                      </label>
                    </section>
                    
                    <section class="col col-4">
                      <label class="label"><b> IEM3 Investimentos realizados </b></label>
                      <label class="input">
            <input type="text" name="iem3avalor" id="iem3avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem3avalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" size="21" maxlength="21" title="Valor consolidado do investimento realizado no semestre da coleta em questão">
                      </label>
                    </section> 
                    
                    
                    <section class="col col-11">
                    <b> IEM4 Evolução do Número de Postos de Trabalho Diretos, por Unidade da Federação </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-5">
                      <label class="label"> Estado (UF) </label>
                      <label class="select">
            <select name="iem4auf" id="iem4auf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem4auf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem4auf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem4auf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem4auf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem4auf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem4auf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem4auf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem4auf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem4auf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem4auf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem4auf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem4auf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem4auf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem4auf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem4auf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem4auf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem4auf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem4auf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem4auf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem4auf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem4auf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem4auf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem4auf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem4auf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem4auf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem4auf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem4auf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    <section class="col col-4">
                      <label class="label">Empregados contratados pela empresa</label>
                      <label class="input">
            <input type="text" name="iem4avalor" id="iem4avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem4avalor']; ?><?php } else { ?>0<?php } ?>" class="numero" maxlength="18" size="18" title="Quantidade de empregados contratados diretamente pela empresa que atuam na prestação do serviço por Unidade da Federação">
                      </label>
                    </section>
                    
                    
                    <section class="col col-11">
                    <b> IEM5 Evolução do Número de Postos de Trabalho Indiretos, por Unidade da Federação </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-5">
                      <label class="label"> Estado (UF) </label>
                      <label class="select">
            <select name="iem5auf" id="iem5auf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem5auf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem5auf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem5auf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem5auf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem5auf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem5auf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem5auf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem5auf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem5auf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem5auf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem5auf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem5auf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem5auf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem5auf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem5auf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem5auf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem5auf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem5auf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem5auf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem5auf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem5auf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem5auf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem5auf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem5auf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem5auf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem5auf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem5auf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    <section class="col col-4">
                      <label class="label">Empregados de empresas terceirizadas</label>
                      <label class="input">
            <input type="text" name="iem5avalor" id="iem5avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem5avalor']; ?><?php } else { ?>0<?php } ?>" class="numero" maxlength="18" size="18" title="Quantidade de empregados de empresas terceirizadas que prestam serviço à autorizada com vistas à prestação do serviço de telecomunicações por Unidade da Federação">
                      </label>
                    </section>
                    
                    
                    
                    
                    <section class="col col-4">
                      <label class="label"><b>IEM6 Receita Operacional Bruta</b></label>
                      <label class="input">
            <input type="text" name="iem6avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem6avalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" id="iem6avalor" size="21" maxlength="21">
                      </label>
                    </section>
                    
            
                    
                    <section class="col col-4">
                      <label class="label"><b>IEM7 Receita Operacional Líquida</b></label>
                      <label class="input">
            <input type="text" name="iem7avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem7avalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" id="iem7avalor" size="21" maxlength="21">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-11">
                    <b>IEM8 Despesas envolvendo operação e manutenção, publicidade e vendas e interconexão</b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Valor Total</label>
                      <label class="input">
           		<input type="text" name="iem8avalor" id="iem8avalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem8avalor']; ?><?php } else { ?>0,00<?php } ?>" readonly="readonly" class="resultado_soma 18 decimal" maxlength="21" size="21" title="Valor total em reais dos custos envolvendo operação, manutenção e interconexão e as despesas de publicidade e vendas.">
                      </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Operação</label>
                      <label class="input">
           		<input type="text" name="iem8bvalor" id="iem8bvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem8bvalor']; ?><?php } else { ?>0,00<?php } ?>" maxlength="21" class="fator_soma 18 decimal" size="21" title="Valor total em Reais dos custos envolvendo operação e manutenção">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Publicidade</label>
                      <label class="input">
           			<input type="text" name="iem8cvalor" id="iem8cvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem8cvalor']; ?><?php } else { ?>0,00<?php } ?>" maxlength="21" class="fator_soma 18 decimal" size="21" title="Valor total em Reais de despesa envolvendo publicidade">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Vendas</label>
                      <label class="input">
           			<input type="text" name="iem8dvalor" id="iem8dvalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem8dvalor']; ?><?php } else { ?>0,00<?php } ?>" maxlength="21" class="fator_soma 18 decimal" size="21" title="Valor total em Reais de despesa envolvendo vendas">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Interconexão</label>
                      <label class="input">
           			<input type="text" name="iem8evalor" id="iem8evalor" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem8evalor']; ?><?php } else { ?>0,00<?php } ?>" maxlength="21" class="fator_soma 18 decimal" size="21" title="Valor total em Reais dos custos envolvendo interconexão">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-11">
                    <b>  IEM9 Preço Médio  Pessoa Física /  Pessoa Jurídica  </b> 
                    <label class="input">
                    <input type="hidden"  name="">
                    </label>
                    </section>
                    
                    <section class="col col-11">
                    <b>  Acesso menor ou igual a 512 kBps  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                      
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem9fauf" id="iem9fauf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9fauf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9fauf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9fauf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9fauf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9fauf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9fauf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9fauf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9fauf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9fauf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9fauf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9fauf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9fauf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9fauf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9fauf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9fauf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9fauf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9fauf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9fauf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9fauf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9fauf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9fauf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9fauf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9fauf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9fauf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9fauf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9fauf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9fauf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9favalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9favalor" id="iem9favalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem9jauf" id="iem9jauf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9jauf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9jauf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9jauf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9jauf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9jauf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9jauf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9jauf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9jauf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9jauf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9jauf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9jauf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9jauf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9jauf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9jauf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9jauf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9jauf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9jauf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9jauf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9jauf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9jauf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9jauf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9jauf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9jauf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9jauf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9jauf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9jauf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9jauf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9javalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9javalor" id="iem9javalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-11">
                    <b> Acesso entre 512 kbps e 2Mbps  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                      
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem9fbuf" id="iem9fbuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9fbuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9fbuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9fbuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9fbuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9fbuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9fbuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9fbuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9fbuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9fbuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9fbuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9fbuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9fbuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9fbuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9fbuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9fbuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9fbuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9fbuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9fbuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9fbuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9fbuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9fbuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9fbuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9fbuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9fbuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9fbuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9fbuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9fbuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9fbvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9fbvalor" id="iem9fbvalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem9jbuf" id="iem9jbuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9jbuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9jbuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9jbuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9jbuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9jbuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9jbuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9jbuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9jbuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9jbuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9jbuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9jbuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9jbuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9jbuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9jbuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9jbuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9jbuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9jbuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9jbuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9jbuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9jbuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9jbuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9jbuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9jbuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9jbuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9jbuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9jbuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9jbuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9jbvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9jbvalor" id="iem9jbvalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-11">
                    <b> Acesso entre 2 Mbps e 12 Mbps  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                      
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem9fcuf" id="iem9fcuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9fcuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9fcuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9fcuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9fcuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9fcuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9fcuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9fcuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9fcuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9fcuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9fcuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9fcuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9fcuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9fcuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9fcuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9fcuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9fcuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9fcuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9fcuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9fcuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9fcuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9fcuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9fcuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9fcuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9fcuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9fcuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9fcuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9fcuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9fcvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9fcvalor" id="iem9fcvalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem9jcuf" id="iem9jcuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9jcuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9jcuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9jcuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9jcuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9jcuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9jcuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9jcuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9jcuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9jcuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9jcuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9jcuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9jcuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9jcuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9jcuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9jcuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9jcuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9jcuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9jcuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9jcuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9jcuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9jcuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9jcuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9jcuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9jcuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9jcuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9jcuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9jcuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9jcvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9jcvalor" id="iem9jcvalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-11">
                    <b> Preço médio para conexões com velocidade de acesso entre 12 Mbps e 34 Mbps  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                      
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem9fduf" id="iem9fduf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9fduf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9fduf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9fduf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9fduf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9fduf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9fduf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9fduf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9fduf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9fduf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9fduf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9fduf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9fduf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9fduf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9fduf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9fduf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9fduf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9fduf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9fduf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9fduf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9fduf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9fduf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9fduf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9fduf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9fduf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9fduf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9fduf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9fduf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9fdvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9fdvalor" id="iem9fdvalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem9jduf" id="iem9jduf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9jduf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9jduf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9jduf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9jduf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9jduf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9jduf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9jduf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9jduf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9jduf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9jduf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9jduf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9jduf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9jduf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9jduf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9jduf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9jduf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9jduf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9jduf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9jduf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9jduf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9jduf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9jduf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9jduf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9jduf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9jduf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9jduf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9jduf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9jdvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9jdvalor" id="iem9jdvalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-11">
                    <b> Preço médio para conexões com velocidade de acesso acima de 34 Mbps </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                      
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem9feuf" id="iem9feuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9feuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9feuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9feuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9feuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9feuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9feuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9feuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9feuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9feuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9feuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9feuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9feuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9feuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9feuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9feuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9feuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9feuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9feuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9feuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9feuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9feuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9feuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9feuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9feuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9feuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9feuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9feuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9fevalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9fevalor" id="iem9fevalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem9jeuf" id="iem9jeuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem9jeuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem9jeuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem9jeuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem9jeuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem9jeuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem9jeuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem9jeuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem9jeuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem9jeuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem9jeuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem9jeuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem9jeuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem9jeuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem9jeuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem9jeuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem9jeuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem9jeuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem9jeuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem9jeuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem9jeuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem9jeuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem9jeuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem9jeuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem9jeuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem9jeuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem9jeuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem9jeuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem9jevalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem9jevalor" id="iem9jevalor" title="Preço médio para conexões com velocidade de acesso menor ou igual a 512 kBps">
                      </label>
                    </section>
                    
                    <section class="col col-11">
                    <b> IEM10 Menor e maior preço por 1 Mbps Pessoa Física / Pessoa Jurídica  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-11">
                    <b> Menor preço por 1Mbps (não dedicado)   </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem10fauf" id="iem10fauf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10fauf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10fauf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10fauf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10fauf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10fauf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10fauf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10fauf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10fauf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10fauf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10fauf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10fauf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10fauf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10fauf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10fauf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10fauf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10fauf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10fauf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10fauf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10fauf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10fauf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10fauf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10fauf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10fauf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10fauf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10fauf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10fauf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10fauf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10favalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10favalor" id="iem10favalor" title="Menor preço por 1Mbps (não dedicado) ofertado e
comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem10jauf" id="iem10jauf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10jauf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10jauf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10jauf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10jauf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10jauf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10jauf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10jauf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10jauf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10jauf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10jauf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10jauf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10jauf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10jauf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10jauf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10jauf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10jauf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10jauf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10jauf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10jauf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10jauf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10jauf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10jauf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10jauf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10jauf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10jauf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10jauf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10jauf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10javalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10javalor" id="iem10javalor" title="Menor preço por 1Mbps (não dedicado) ofertado e
comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    
                    
                     <section class="col col-11">
                    <b> Menor preço por 1Mbps (dedicado)  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem10fbuf" id="iem10fbuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10fbuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10fbuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10fbuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10fbuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10fbuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10fbuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10fbuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10fbuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10fbuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10fbuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10fbuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10fbuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10fbuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10fbuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10fbuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10fbuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10fbuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10fbuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10fbuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10fbuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10fbuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10fbuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10fbuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10fbuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10fbuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10fbuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10fbuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10fbvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10fbvalor" id="iem10fbvalor" title="Menor preço por 1Mbps (dedicado) ofertado e comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem10jbuf" id="iem10jbuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10jbuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10jbuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10jbuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10jbuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10jbuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10jbuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10jbuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10jbuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10jbuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10jbuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10jbuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10jbuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10jbuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10jbuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10jbuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10jbuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10jbuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10jbuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10jbuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10jbuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10jbuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10jbuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10jbuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10jbuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10jbuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10jbuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10jbuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10jbvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10jbvalor" id="iem10jbvalor" title="Menor preço por 1Mbps (dedicado) ofertado e comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-11">
                    <b> Maior preço por 1Mbps (não dedicado)  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem10fcuf" id="iem10fcuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10fcuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10fcuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10fcuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10fcuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10fcuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10fcuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10fcuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10fcuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10fcuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10fcuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10fcuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10fcuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10fcuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10fcuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10fcuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10fcuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10fcuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10fcuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10fcuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10fcuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10fcuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10fcuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10fcuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10fcuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10fcuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10fcuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10fcuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10fcvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10fcvalor" id="iem10fcvalor" title="Maior preço por 1Mbps (não dedicado) ofertado e comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem10jcuf" id="iem10jcuf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10jcuf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10jcuf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10jcuf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10jcuf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10jcuf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10jcuf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10jcuf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10jcuf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10jcuf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10jcuf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10jcuf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10jcuf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10jcuf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10jcuf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10jcuf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10jcuf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10jcuf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10jcuf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10jcuf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10jcuf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10jcuf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10jcuf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10jcuf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10jcuf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10jcuf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10jcuf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10jcuf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10jcvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10jcvalor" id="iem10jcvalor" title="Maior preço por 1Mbps (não dedicado) ofertado e comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    <section class="col col-11">
                    <b> Maior preço por 1Mbps (dedicado)  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Física ) </label>
                      <label class="select">
            <select name="iem10fduf" id="iem10fduf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10fduf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10fduf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10fduf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10fduf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10fduf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10fduf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10fduf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10fduf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10fduf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10fduf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10fduf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10fduf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10fduf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10fduf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10fduf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10fduf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10fduf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10fduf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10fduf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10fduf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10fduf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10fduf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10fduf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10fduf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10fduf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10fduf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10fduf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Física )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10fdvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10fdvalor" id="iem10fdvalor" title="Maior preço por 1Mbps (dedicado) ofertado e comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    <section class="col col-3">
                      <label class="label"> Estado ( Pessoa Jurídica ) </label>
                      <label class="select">
            <select name="iem10jduf" id="iem10jduf">
<option value>Estados</option>
<option value="AC" <?php if (@$campo['iem10jduf'] == 'AC') { echo "selected"; } ?>>Acre</option>
<option value="AL" <?php if (@$campo['iem10jduf'] == 'AL') { echo "selected"; } ?>>Alagoas</option>
<option value="AM" <?php if (@$campo['iem10jduf'] == 'AM') { echo "selected"; } ?>>Amazonas</option>
<option value="AP" <?php if (@$campo['iem10jduf'] == 'AP') { echo "selected"; } ?>>Amapá</option>
<option value="BA" <?php if (@$campo['iem10jduf'] == 'BA') { echo "selected"; } ?>>Bahia</option>
<option value="CE" <?php if (@$campo['iem10jduf'] == 'CE') { echo "selected"; } ?>>Ceará</option>
<option value="DF" <?php if (@$campo['iem10jduf'] == 'DF') { echo "selected"; } ?>>Distrito Federal</option>
<option value="ES" <?php if (@$campo['iem10jduf'] == 'ES') { echo "selected"; } ?>>Espírito Santo</option>
<option value="GO" <?php if (@$campo['iem10jduf'] == 'GO') { echo "selected"; } ?>>Goiás</option>
<option value="MA" <?php if (@$campo['iem10jduf'] == 'MA') { echo "selected"; } ?>>Maranhão</option>
<option value="MT" <?php if (@$campo['iem10jduf'] == 'MT') { echo "selected"; } ?>>Mato Grosso</option>
<option value="MS" <?php if (@$campo['iem10jduf'] == 'MS') { echo "selected"; } ?>>Mato Grosso do Sul</option>
<option value="MG" <?php if (@$campo['iem10jduf'] == 'MG') { echo "selected"; } ?>>Minas Gerais</option>
<option value="PA" <?php if (@$campo['iem10jduf'] == 'PA') { echo "selected"; } ?>>Pará</option>
<option value="PB" <?php if (@$campo['iem10jduf'] == 'PB') { echo "selected"; } ?>>Paraíba</option>
<option value="PR" <?php if (@$campo['iem10jduf'] == 'PR') { echo "selected"; } ?>>Paraná</option>
<option value="PE" <?php if (@$campo['iem10jduf'] == 'PE') { echo "selected"; } ?>>Pernambuco</option>
<option value="PI" <?php if (@$campo['iem10jduf'] == 'PI') { echo "selected"; } ?>>Piauí</option>
<option value="RJ" <?php if (@$campo['iem10jduf'] == 'RJ') { echo "selected"; } ?>>Rio de Janeiro</option>
<option value="RN" <?php if (@$campo['iem10jduf'] == 'RN') { echo "selected"; } ?>>Rio Grande do Norte</option>
<option value="RO" <?php if (@$campo['iem10jduf'] == 'RO') { echo "selected"; } ?>>Rondônia</option>
<option value="RS" <?php if (@$campo['iem10jduf'] == 'RS') { echo "selected"; } ?>>Rio Grande do Sul</option>
<option value="RR" <?php if (@$campo['iem10jduf'] == 'RR') { echo "selected"; } ?>>Roraima</option>
<option value="SC" <?php if (@$campo['iem10jduf'] == 'SC') { echo "selected"; } ?>>Santa Catarina</option>
<option value="SE" <?php if (@$campo['iem10jduf'] == 'SE') { echo "selected"; } ?>>Sergipe</option>
<option value="SP" <?php if (@$campo['iem10jduf'] == 'SP') { echo "selected"; } ?>>São Paulo</option>
<option value="TO" <?php if (@$campo['iem10jduf'] == 'TO') { echo "selected"; } ?>>Tocantins</option>
</select>
                      </label>
                    </section> 
                    
                    
                    <section class="col col-3">
                      <label class="label">Valor ( Pessoa Jurídica )</label>
                      <label class="input">
           <input type="text" size="21" maxlength="21" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['iem10jdvalor']; ?><?php } else { ?>0,00<?php } ?>" class="decimal" name="iem10jdvalor" id="iem10jdvalor" title="Maior preço por 1Mbps (dedicado) ofertado e comercializado pela prestadora">
                      </label>
                    </section>
                    
                    
                    <section class="col col-13">
                    <b>  Quantidade de acessos físicos em serviço que usam tecnologia ETHERNET e suas variações (Fastethernet, GigabitEthernet, 10Gigabitethernet). As redes metroethernet devem ser inseridas nesse campo.  </b> 
                    <label class="input">
                    <input type="hidden" name="">
                    </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smmqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smmqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smmqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smmtotal" readonly="readonly" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smmtotal']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smmtotal" class="resultado_soma 13" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smm15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smm15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smm15" class="fator_soma 13" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smm16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smm16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smm16" class="fator_soma 13" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smm17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smm17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smm17" class="fator_soma 13" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smm18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smm18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smm18" class="fator_soma 13" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smm19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smm19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smm19" class="fator_soma 13" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-13">
                    <b>  Quantidade de acessos físicos em serviço que usam tecnologia FRAMERELAY.  </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smnqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smnqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smnqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smntotal" readonly="readonly" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smntotal']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smntotal" class="resultado_soma 14" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smn15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smn15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smn15" class="fator_soma 14" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smn16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smn16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smn16" class="fator_soma 14" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smn17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smn17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smn17" class="fator_soma 14" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smn18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smn18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smn18" class="fator_soma 14" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smn19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smn19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smn19" class="fator_soma 14" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-13">
                    <b> Quantidade de acessos físicos em serviço que usam tecnologia ATM (Asynchronous Transfer Mode). </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smoqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smoqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smoqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smototal" readonly="readonly" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smototal']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smototal" class="resultado_soma 15" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smo15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smo15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smo15" class="fator_soma 15" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smo16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smo16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smo16" class="fator_soma 15" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smo17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smo17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smo17" class="fator_soma 15" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smo18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smo18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smo18" class="fator_soma 15" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smo19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smo19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smo19" class="fator_soma 15" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-13">
                    <b> QAIPL4SM Distribuição do quantitativo de acessos fisicos em serviço  referente ao indicador IPL4 especificado no Manual do SICI </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-3">
                      <label class="label">Codigo do Municipio</label>
                      <label class="input">
		      <input type="text" name="qaipl4smcodm" value="<?php echo @$campo['qaipl4smcodm']; ?>" id="qaipl4smcodm" maxlength="7" size="7">
                      </label>
                    </section>
                    
                    <section class="col col-13">
                    <b> Quantidade de acessos físicos em serviço disponibilizados via Sistema Digital Subscriber Line (xDSL). </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smaqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smaqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smoqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smatotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smatotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smatotal" rel="1" class="resultado_soma 1" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4sma15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sma15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sma15" class="fator_soma 1" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sma16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sma16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sma16" class="fator_soma 1" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sma17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sma17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sma17" class="fator_soma 1" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sma18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sma18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sma18" class="fator_soma 1" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sma19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sma19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sma19" class="fator_soma 1" maxlength="18" size="18">
                      </label>
                    </section>
                     
                     
                     
                    <section class="col col-13">
                    <b> Quantidade de acessos físicos em serviço disponibilizados por meio das redes de transmissão de TV a cabo (Cable Modem).  </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smbqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smbqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smbqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smbtotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smbtotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smbtotal" rel="1" class="resultado_soma 2" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smb15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smb15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smb15" class="fator_soma 2" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smb16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smb16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smb16" class="fator_soma 2" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smb17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smb17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smb17" class="fator_soma 2" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smb18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smb18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smb18" class="fator_soma 2" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smb19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smb19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smb19" class="fator_soma 2" maxlength="18" size="18">
                      </label>
                    </section> 
                     
                     
                     
                    <section class="col col-13">
                    <b>  Quantidade de acessos físicos em serviço que usam tecnologia de espalhamento espectral, WiFi (Wireless Fidelity) ou outras tecnologias de modulação digital nas faixas de 900 MHz, 2,4 GHz e/ou 5,8 GHz. (Spread Spectrum)  </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smcqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smcqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smcqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smctotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smctotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smctotal" rel="1" class="resultado_soma 3" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smc15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smc15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smc15" class="fator_soma 3" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smc16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smc16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smc16" class="fator_soma 3" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smc17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smc17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smc17" class="fator_soma 3" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smc18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smc18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smc18" class="fator_soma 3" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smc19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smc19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smc19" class="fator_soma 3" maxlength="18" size="18">
                      </label>
                    </section>  
                     
                     
                     <section class="col col-13">
                    <b>   Quantidade de acessos físicos em serviço disponibilizados por meio de sistema Fixed Wireless Access (FWA), aplicações pontomultiponto, radioenlaces pontoaponto convergentes, para faixas de radiofreqüências diferentes de 900 MHz, 2,4 GHz , 3,5GHz, 5,8 GHz e 10,5GHz. (FWA)  </b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smdqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smdqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smdqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smdtotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smdtotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smdtotal" rel="1" class="resultado_soma 4" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smd15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smd15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smd15" class="fator_soma 4" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smd16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smd16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smd16" class="fator_soma 4" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smd17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smd17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smd17" class="fator_soma 4" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smd18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smd18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smd18" class="fator_soma 4" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smd19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smd19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smd19" class="fator_soma 4" maxlength="18" size="18">
                      </label>
                    </section>  
                    
                    
                    
                    <section class="col col-13">
                    <b> Quantidade de acessos físicos em serviço disponibilizados via
tecnologia que se utiliza de redes do Serviço de Distribuição de
Sinais Multiponto/Multicanal .(MMDS)
F) Quantidade de acessos físicos em serviço</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smeqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smeqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smeqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smetotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smetotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smetotal" rel="1" class="resultado_soma 5" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4sme15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sme15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sme15" class="fator_soma 5" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sme16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sme16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sme16" class="fator_soma 5" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sme17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sme17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sme17" class="fator_soma 5" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sme18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sme18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sme18" class="fator_soma 5" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sme19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sme19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sme19" class="fator_soma 5" maxlength="18" size="18">
                      </label>
                    </section>  
                    
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço disponibilizados por meio
de Tecnologia que se utiliza de Redes do Serviço de Distribuição de
Sinais de Televisão e de Áudio por Assinatura. (DTH)</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smfqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smfqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smfqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smftotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smftotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smftotal" rel="1" class="resultado_soma 6" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smf15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smf15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smf15" class="fator_soma 6" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smf16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smf16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smf16" class="fator_soma 6" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smf17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smf17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smf17" class="fator_soma 6" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smf18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smf18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smf18" class="fator_soma 6" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smf19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smf19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smf19" class="fator_soma 6" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço disponibilizados por meio
de satélite, exceto DTH.(Satélite)</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smgqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smgqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smgqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smgtotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smgtotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smgtotal" rel="1" class="resultado_soma 7" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smg15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smg15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smg15" class="fator_soma 7" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smg16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smg16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smg16" class="fator_soma 7" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smg17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smg17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smg17" class="fator_soma 7" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smg18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smg18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smg18" class="fator_soma 7" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smg19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smg19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smg19" class="fator_soma 7" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço disponibilizados por meio
de Fibra Óptica (Fibra)</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smhqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smhqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smhqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smhtotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smhtotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smhtotal" rel="1" class="resultado_soma 8" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smh15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smh15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smh15" class="fator_soma 8" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smh16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smh16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smh16" class="fator_soma 8" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smh17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smh17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smh17" class="fator_soma 8" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smh18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smh18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smh18" class="fator_soma 8" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smh19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smh19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smh19" class="fator_soma 8" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço disponibilizados por meio
de PLC – Power Line Communication – Sistema de Banda Larga por
meio de Redes de Energia Elétrica (Res. Nº 527, de 8 de abril de
2009). Os modelos híbridos que utilizem PLC/Fibra também devem
ser informados neste indicador. (PLC)</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smiqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smiqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smiqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smitotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smitotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smitotal" rel="1" class="resultado_soma 9" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smi15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smi15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smi15" class="fator_soma 9" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smi16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smi16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smi16" class="fator_soma 9" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smi17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smi17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smi17" class="fator_soma 9" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smi18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smi18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smi18" class="fator_soma 9" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smi19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smi19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smi19" class="fator_soma 9" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço disponibilizados por meio
de Acesso Híbrido (Fibra e Cabo Coaxial). (HFC)</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smjqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smjqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smjqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smjtotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smjtotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smjtotal" rel="1" class="resultado_soma 10" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smj15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smj15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smj15" class="fator_soma 10" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smj16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smj16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smj16" class="fator_soma 10" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smj17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smj17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smj17" class="fator_soma 10" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smj18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smj18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smj18" class="fator_soma 10" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smj19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smj19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smj19" class="fator_soma 10" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço que usam tecnologia de
Wimax (Worldwide Interoperability for Microwave
Access/Interoperabilidade Mundial para Acesso de Microondas). ou
outras tecnologias de modulação digital nas faixas 3,5 GHz e/ou
10,5GHz. (WIMAX)</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smkqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smkqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smkqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smktotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smktotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smktotal" rel="1" class="resultado_soma 11" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4smk15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smk15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smk15" class="fator_soma 11" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smk16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smk16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smk16" class="fator_soma 11" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smk17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smk17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smk17" class="fator_soma 11" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smk18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smk18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smk18" class="fator_soma 11" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4smk19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smk19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4smk19" class="fator_soma 11" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    
                    <section class="col col-13">
                    <b>Quantidade de acessos físicos em serviço que usam tecnologia de LTE (Long Term Evolution).</b> 
                    <label class="input">
                    <input type="hidden" sty name="">
                    <div style="width:900px;"></div>
                    </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Capacidade</label>
                      <label class="input">
		      <input type="text" name="qaipl4smlqaipl5sm" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4smlqaipl5sm']; ?><?php } else { ?>0<?php } ?>" class="numero" id="qaipl4smlqaipl5sm" title="QAIPL5SM Capacidade total do sistema implantada e em serviço (Mbps)  referente ao indicador IPL5 especificado no Manual do SICI" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    <section class="col col-1">
                      <label class="label">Total</label>
                      <label class="input">
		      <input type="text" name="qaipl4smltotal" value="<?php if (@$campo['id'] <> '') { ?><?php echo $campo['qaipl4smltotal']; ?><?php } else { ?>0<?php } ?>" readonly="readonly" id="qaipl4smltotal" rel="1" class="resultado_soma 12" maxlength="18" size="18" title="Total é a soma dos valores das faixas de velocidade">
                      </label>
                    </section>
                    
                    <section class="col col-1">
                      <label class="label"> 512K</label>
                      <label class="input">
		      <input type="text" name="qaipl4sml15" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sml15']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sml15" class="fator_soma 12" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">512K Até 2M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sml16" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sml16']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sml16" class="fator_soma 12" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">2M Até 12M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sml17" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sml17']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sml17" class="fator_soma 12" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">12M Até 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sml18" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sml18']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sml18" class="fator_soma 12" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    <section class="col col-2">
                      <label class="label">Acima de 34M</label>
                      <label class="input">
		      <input type="text" name="qaipl4sml19" value="<?php if (@$campo['id'] <> '') { ?><?php echo @$campo['qaipl4sml19']; ?><?php } else { ?>0<?php } ?>" id="qaipl4sml19" class="fator_soma 12" maxlength="18" size="18">
                      </label>
                    </section>
                    
                    
                    
                    
                  </fieldset>
                  <footer>
                  <?php if (@$campo['id'] <> '') { ?>

		  <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
		  <input type="hidden" name="siciid" value="<?php echo @$campo['id']; ?>"> 
		  <?php } else { ?>
		  <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar">
		  <?php } ?>

                  </footer>
                </form>
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
            