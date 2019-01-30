<?php
/*
Função CRUD
Cadastro, Edição, Exclusão de Clientes.
Ultima Atualização: 18/11/2014
*/

$idempresa = $_SESSION['empresa'];
@$getId = base64_decode($_GET['id']);
if(@$getId){

    $alterar = $mysqli->query("SELECT * FROM fib_elementos WHERE id = + $getId AND empresa = '$idempresa'");
    $campo = mysqli_fetch_array($alterar);
}
@$getIdno = base64_decode($_GET['idno']);
if(@$getIdno){

    $alterar = $mysqli->query("SELECT * FROM fib_no WHERE id = + $getIdno AND empresa = '$idempresa'");
    $campo = mysqli_fetch_array($alterar);
}
if(isset ($_POST['cadastrar'])){

    $empresa    = $_POST['empresa'];
    $id_no      = $_POST['id_no'];
    $descricao  = $_POST['descricao'];
    $lat        = $_POST['lat'];
    $lon        = $_POST['lon'];

    $crud = new crud('fib_elementos');  // tabela como parametro
    $crud->inserir("empresa,id_no,descricao,lat,lon","'$empresa','$id_no','$descricao','$lat','$lon'");

    header("Location: index.php?app=ListaNo&reg=1");
}

if(isset ($_POST['editar'])){

    $id         = $_POST['id'];
    $empresa    = $_POST['empresa'];
    $id_no      = $_POST['id_no'];
    $descricao  = $_POST['descricao'];
    $lat        = $_POST['lat'];
    $lon        = $_POST['lon'];

    $crud = new crud('fib_elementos'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("empresa='$empresa',id_no='$id_no',descricao='$descricao',lat='$lat',lon='$lon'", "id='$idcliente'");

    header("Location: index.php?app=ListaNo&reg=2");
}

if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "Del")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista

    $assvalida = $mysqli->query("SELECT * FROM fib_no WHERE id = '$id'");
    $assvld = mysqli_fetch_array($assvalida);
    $row = mysqli_num_rows($assvalida);

    if($row > 0) {
        header("Location: index.php?app=ListaNos&reg=4");
    } else {

        $crud = new crud('clientes'); // tabela como parametro
        $crud->excluir("id = $id"); // exclui o registro com o id que foi passado

        header("Location: index.php?app=ListaNo&reg=3");
    }
}

?>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script>
    jQuery(function($){
        $(".data").mask("99/99/9999");
    });
</script>

<script src="assets/js/jquery.maskedinput.min.js"></script>
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

    $(function() {
        $('.maskcel').focusout(function() {
            var maskcelular, element;
            element = $(this);
            element.unmask();
            maskcelular = element.val().replace(/\D/g, '');
            if (maskcelular.length > 11) {
                element.mask("(999)99999-9999");
            } else {
                element.mask("(999)9999-9999?9");
            }
        }).trigger('focusout');


    });

    jQuery(function($){
        $(".nascimento").mask("99/99/9999");
        $(".cel").mask("(999) 99999-9999");
        $(".tel").mask("(999) 9999-9999");
        $(".cep").mask("99999-999");
    });
</script>
<script type="text/javascript" src="assets/js/cidades-estados-1.0.js"></script>
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
        <li><a href="?app=Dashboard">Dashboard</a></li>
        <li><a href="?app=Fibra">Fibra</a></li>
        <li class="active">Cadastro</li>
    </ul>
</div>

<?php if($permissao['c2'] == S) { ?>

    <div class="page-header">
        <h1>Cadastro<small> Novo No</small></h1>
    </div>

    <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
        <header>
            <h2>Cadastro<small>No</small></h2>
        </header>
        <div class="inner-spacer">
            <form action="" method="POST" class="orb-form">
                <fieldset>

                    <section class="col col-4">
                        <label class="label">Nome do Elemento</label>
                        <label class="input">
                            <input type="hidden" name="empresa" value="<?php if(empty($campo['empresa'])){ echo '1'; }else{ echo @$campo['empresa']; }; ?>" required>
                            <input type="text" name="descricao" value="<?php echo @$campo['descricao']; ?>" required>
                            <input type="hidden" name="id_no" value="<?php echo @$campo['id']; ?>" required>
                        </label>
                    </section>
                    <section class="col col-2">
                        <label class="label">Latitude</label>
                        <label class="input">
                            <input type="text" name="lat" value="<?php echo @$campo['lat']; ?>" required>
                        </label>
                    </section>
                    <section class="col col-2">
                        <label class="label">Longitude</label>
                        <label class="input">
                            <input type="text" name="lon" value="<?php echo @$campo['lon']; ?>" required>
                        </label>
                    </section>

                </fieldset>
                <footer>
                    <?php if (@$getId <> '') { ?>
                        <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
                        <input type="text" name="idno" value="<?php echo @$campo['id']; ?>">
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
            