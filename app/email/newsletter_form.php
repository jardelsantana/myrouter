<?php

?>

<script src="assets/tinymce/tinymce.min.js"></script>
<script>tinymce.init({

        mode : "textareas",
        editor_selector : "mceEditor",
        theme: "modern",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "preview media | forecolor backcolor emoticons",
        image_advtab: true,
        removed_menuitems: 'newdocument'});</script>
<!--<script>tinymce.init({selector:'textarea'});</script> -->


<div class="breadcrumb clearfix">
    <ul>
        <li><a href="?app=Dashboard">Dashboard</a></li>
        <li><a href="?app=Newsletter">Newsletter</a></li>
        <li class="active">Newsletter</li>
    </ul>
</div>

<?php if($permissao['c2'] == S) { ?>

    <?php if ($_GET['reg'] == '1') { ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Seu Newsletter Foi Enviado Com Sucesso. </div>
    <?php } ?>
    <?php if ($_GET['reg'] == '2') { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Seu Newsletter Não Enviado. </div>
    <?php } ?>

    <?php if ($_GET['reg'] == '3') { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times-circle"></i></button>
            <strong>Atenção!</strong> Os Campos Assunto e Mensagem devem ser Preenchidos. </div>
    <?php } ?>


    <div class="page-header">
        <h1>Newsletter<small> Envie sua Mala Direta</small></h1>
    </div>

    <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
        <header>
            <h2>Newsletter<small>* Beta</small></h2>
        </header>
        <div class="inner-spacer">
            <form action="app/email/newsletter.php" method="POST" class="orb-form">
                <fieldset>
                    <section class="col col-11">
                    <label class="label">Enviar Para:</label>
                    <label class="radio-inline"><input type="radio" name="opcao" checked="true" value="total">Todos Cliente</label >
                    <label class="radio-inline"><input type="radio" name="opcao" value="ativos">Cliente Ativos</label >
                    </section>

                    <section class="col col-4">
                        <label class="label">Assunto</label>
                        <label class="input">
                            <input type="text" name="assunto" required>
                        </label>
                    </section>

                    <section class="col col-11">
                        <label class="label">Mensagem</label>
                        <label class="textarea">
                            <textarea class="mceEditor" class="form-control" name="text" rows="20"></textarea>
                        </label>
                    </section>


                </fieldset>
                <footer>
                        <input type="submit" name="submit" class="btn btn-success" value="Enviar">

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
