<?php
$idpuser = $logado['nome']; // pegar nome do login da sessão

$idempresa = $_SESSION['empresa'];
@$getId = base64_decode($_GET['id']);
if(@$getId){

    $alterar = $mysqli->query("SELECT * FROM notafiscal WHERE id = + $getId");
    $campo = mysqli_fetch_array($alterar);
    $dataemissao = date('d/m/Y',strtotime($campo['emissao']));



}

if(isset ($_POST['editar'])){
    $nnota = $_POST['nnota'];
    $clientenome = $_POST['clientenome'];
    $clientecpf = $_POST['clientecpf'];
    $clienterg = $_POST['clienterg'];
    $descricao = $_POST['descricao'];
    $valorservicos = $_POST['valorservicos'];
    $situacao = $_POST['situacao'];

    $crud = new crud('notafiscal'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("clientenome='$clientenome',clientecpf='$clientecpf',clienterg='$clienterg',descricao='$descricao',valorservicos='$valorservicos',situacao='$situacao',emissao='$dataemissao'", "id='$getId'");

    $getCliente = base64_encode($_GET['id']);

    header("Location: index.php?app=NFSe&reg=5");
}

?>
<script src="https://raw.githubusercontent.com/digitalBush/jquery.maskedinput/1.4.0/dist/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
    function BuscarLogin(){
        var cliente = $('#cliente').val();
        if(cliente){
            var UrlSearch = 'app/os/busca_login_cliente.php?cliente='+cliente;
            $.get(UrlSearch, function(dataReturn){
                $('#load_login_cliente').html(dataReturn);
            });
        }
    }
</script>
<script>
    $(function() {
        $('.cpf').focusout(function() {
            var cpfcnpj, element;
            element = $(this);
            element.unmask();
            cpfcnpj = element.val().replace(/\D/g, '');
            if (cpfcnpj.length > 11) {
                element.mask("99.999.999/999?9-99");
            } else {
                element.mask("999.999.999-99?9-99");
            }
        }).trigger('focusout');


    });
    jQuery(function($){
        $(".data").mask("99/99/9999");
    });

    jQuery(function($){
        $(".hora").mask("99:99:99");
    });

</script>
<script type="text/javascript" src="http://cidades-estados-js.googlecode.com/files/cidades-estados-1.0.js"></script>
<script type="text/javascript">
    window.onload = function() {
        new dgCidadesEstados({
            estado: document.getElementById('estado'),
            cidade: document.getElementById('cidade')
        });
    }
</script>
<script type="text/javascript" src="ajax/funcslogin.js"></script>
<script type="text/javascript" src="ajax/funcscpf.js"></script>


<div class="breadcrumb clearfix">
    <ul>
        <li><a href="dashboard">Dashboard</a></li>
        <li><a href="?app=NFSe">Nota Fiscal</a></li>
        <li class="active">Editar</li>
    </ul>
</div>

<?php if($permissao['os2'] == S) { ?>

    <div class="page-header">
        <h1>Editar<small> Nota Fiscal</small></h1>
    </div>

    <div class="powerwidget blue" id="most-form-elements" data-widget-editbutton="false">
        <header>
            <h2>Editar<small>Nota Fiscal</small></h2>
        </header>
        <div class="inner-spacer">
            <form action="" method="POST" class="orb-form">
                <fieldset>
                    <section class="col col-2">
                        <label class="label">Número da Nota</label>
                        <label class="input">
                            <input type="text" name="nnota" readonly value="<?php echo @$campo['nnota']; ?>">
                        </label>
                    </section>

                    <section class="col col-6">
                        <label class="label">Nome/Razão Social</label>
                        <label class="input">
                            <input type="text" name="clientenome" readonly value="<?php echo @$campo['clientenome']; ?>">
                        </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">CPF/CNPJ </label>
                        <label class="input">
                            <input type="text" name="clientecpf" readonly value="<?php echo @$campo['clientecpf']; ?>">
                        </label>
                    </section>

                    <section class="col col-2">
                        <label class="label">RG/IE</label>
                        <label class="input">
                            <input type="text" name="clienterg" readonly value="<?php echo @$campo['clienterg']; ?>">
                        </label>
                    </section>

                    <section class="col col-4">
                        <label class="label">Serviço Prestado</label>
                        <label class="input">
                            <input type="text" name="descricao"  readonly value="<?php echo @$campo['descricao']; ?>">
                        </label>
                    </section>

                    <section class="col col-3">
                        <label class="label">Data Prestação do Serviço</label>
                        <label class="input">
                            <input type="text" name="emissao"  readonly class="data" value="<?php echo $dataemissao; ?>">
                        </label>
                    </section>

                    <section class="col col-2">
                        <label class="label">Valor R$</label>
                        <label class="input">
                            <input type="text" name="valorservicos"  readonly onKeyUp="moeda(this);" value="<?php echo @$campo['valorservicos']; ?>">
                        </label>
                    </section>


                    <section class="col col-3">
                        <label class="label">Situação da Nota</label>
                        <div class="inline-group">
                            <label class="radio">
                                <input type="radio" name="situacao" value="N" <?php if ($campo['situacao'] == 'N') { echo "checked"; } ?> required>
                                <i></i>Normal</label>

                            <label class="radio">
                                <input type="radio" name="situacao" value="S" <?php if ($campo['situacao'] == 'S') { echo "checked"; } ?>>
                                <i></i>Cancelada</label>
                        </div>
                    </section>

                </fieldset>
                <footer>
                    <?php if (@$campo['id'] <> '') { ?>

                        <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
                        <input type="hidden" name="osid" value="<?php echo @$campo['id']; ?>">
                        <input type="hidden" name="codigo" value="<?php echo @$campo['codigo']; ?>">
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
            