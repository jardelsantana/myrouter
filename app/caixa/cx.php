<?php
$dia_lanc = date("d");
$mes_atual = date("m");
$verifica_data = $mysqli->query("SELECT * FROM lc_fixas WHERE dia_vencimento <= $dia_lanc");
$contar = mysqli_num_rows($verifica_data);
if($contar >= 1){

    while($ins = mysqli_fetch_array($verifica_data)){

        $dia_vencimento = $ins['dia_vencimento'];
        $valor_fixa = $ins['valor_fixa'];
        $descr_fixa = $ins['descricao_fixa'];
        $cat = $ins['cat'];
        $dataagora = date('Y-m-').$dia_vencimento;


        $dia = date('d',strtotime($dataagora));
        $mes = date('m',strtotime($dataagora));
        $ano = date('Y',strtotime($dataagora));

        $sel = $mysqli->query("SELECT * FROM lc_movimento WHERE data = '$dataagora' AND descricao = '$descr_fixa'") or die(mysqli_error());
        $cont = mysqli_num_rows($sel);
        $confere = mysqli_fetch_array($sel);
        if($cont < 1){
            $lanca_automatico = $mysqli->query("INSERT INTO lc_movimento (data,dia,mes,ano,tipo,descricao,cat,valor)VALUES('$dataagora','$dia','$mes','$ano','0','$descr_fixa','$cat','$valor_fixa')");

        }

    }
}

?>


<div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="index.php?app=LivroCaixa">Financeiro</a></li>
            <li class="active">Livro Caixa</li>
          </ul>
        </div>

<div class="page-header">
          <h1>Livro Caixa</h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">
              <a href="index.php?app=ContasFixas" class="btn btn-info">Lista Contas Fixas</a>
              <a href="index.php?app=CadastroContasFixas" class="btn btn-info">Cadastrar Contas Fixas</a>

              <p></p>
            
            <div class="powerwidget" id="" data-widget-editbutton="false">
             
              <div class="inner-spacer">


<iframe src="app/caixa/index.php" width="100%" height="900" frameborder="no"></iframe>

</div></div></div>