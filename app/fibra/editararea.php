<?php

    $alterararea = $mysqli->query("SELECT * FROM fib_conf WHERE id = '1'");
    $campo = mysqli_fetch_array($alterararea);

if(isset ($_POST['editararea'])){
    $partida = $_POST['partida'];
    $lat     = $_POST['lat'];
    $longitude  = $_POST['longitude'];
    $zoom    = $_POST['zoom'];
    $maxzoom = $_POST['maxzoom'];
    $minzoom = $_POST['minzoom'];

    $crud = new crud('fib_conf'); // instancia classe com as operações crud, passando o nome da tabela como parametro
    $crud->atualizar("lat='$lat',partida='$partida',longitude='$longitude',zoom='$zoom',maxzoom='$maxzoom',minzoom='$minzoom'","id='1'");


    header("Location: index.php?app=ListaAreaFibra&reg=2");
}

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
        <h1>Editar<small>Area</small></h1>
    </div>

    <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
        <header>
            <h2>Editar<small>Area de Cobertura</small></h2>
        </header>
        <div class="inner-spacer">
            <form action="" method="POST" class="orb-form">
                <fieldset>

                    <section class="col col-4">
                        <label class="label">Area</label>
                        <label class="input">
                            <input type="text" name="partida" value="<?php echo @$campo['partida']; ?>">
                        </label>
                    </section>

                    <section class="col col-4">
                        <label class="label">Latitude</label>
                        <label class="input">
                            <input type="text" name="lat" value="<?php echo @$campo['lat'];?>">
                        </label>
                    </section>

                    <section class="col col-4">
                        <label class="label">Longitude</label>
                        <label class="input">
                            <input type="text" name="longitude" value="<?php echo @$campo['longitude'];?>">
                        </label>
                    </section>

                    <section class="col col-2">
                        <label class="label">Zoom</label>
                        <label class="input">
                            <input type="text" name="zoom" value="<?php echo @$campo['zoom'];?>">
                        </label>
                    </section>

                    <section class="col col-2">
                        <label class="label">Máx. Zoom</label>
                        <label class="input">
                            <input type="text" name="maxzoom" value="<?php echo @$campo['maxzoom']; ?>">
                        </label>
                    </section>

                    <section class="col col-2">
                        <label class="label">Min. Zoom</label>
                        <label class="input">
                            <input type="text" name="minzoom" value="<?php echo @$campo['minzoom']; ?>">
                        </label>
                    </section>

                </fieldset>
                <footer>
                        <input type="submit" name="editararea" class="btn btn-primary" value="Atualizar">
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
