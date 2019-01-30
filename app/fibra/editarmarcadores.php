<?php

@$getId = base64_decode($_GET['id']);
if(@$getId){

    $alterar = $mysqli->query("SELECT * FROM fib_markers WHERE id = + $getId");
    $campo = mysqli_fetch_array($alterar);
}

if(isset ($_POST['editar'])){

    $name  = $_POST['name'];
    $address = $_POST['address'];

    $crud = new crud('fib_markers'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("name='$name',address='$address'", "id='$getId'");

    header("Location: index.php?app=ListaMarcadores&reg=2");
}

/// Deletar Marcadores

if ((isset($_GET["Ex"])) && ($_GET["Ex"] == "DelMarcadores")) {
    $id = base64_decode($_GET['id']); // pega id para exclusao caso exista

    $crud = new crud('fib_markers'); // tabela como parametro
    $crud->excluir("id = $id"); // exclui o registro com o id que foi passado


    header("Location: index.php?app=ListaMarcadores&reg=3");

}


/////

?>

<div class="breadcrumb clearfix">
    <ul>
        <li><a href="?app=Dashboard">Dashboard</a></li>
        <li><a href="?app=Fibra">Fibra</a></li>
        <li class="active">Cadastro</li>
    </ul>
</div>

<?php if($permissao['c2'] == S) { ?>

    <div class="page-header">
        <h1>Gerenciar<small> Marcadores</small></h1>
    </div>

    <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
        <header>
            <h2>Editar<small>Marcadores</small></h2>
        </header>
        <div class="inner-spacer">
            <form action="" method="POST" class="orb-form">
                <fieldset>

                    <section class="col col-4">
                        <label class="label">Nome</label>
                        <label class="input">
                            <input type="text" name="name" value="<?php echo @$campo['name']; ?>" required>
                        </label>
                    </section>

                    <section class="col col-2">
                        <label class="label">Endereço</label>
                        <label class="input">
                            <input type="text" name="address" value="<?php echo @$campo['address']; ?>" required>
                        </label>
                    </section>
                </fieldset>
                <footer>
                        <input type="submit" name="editar" class="btn btn-primary" value="Atualizar">
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
