<html>
<title>ETIQUETA <?php echo $_GET['et']; ?></title>
<head>

</head>
<style>
@font-face {
    font-family: "codigo";
    src: url("../assets/BarcodeFont.ttf") format("truetype");
}
</style>
<!--[if IE]>
<style>
@font-face {
    font-family: "codigo";
    src: url("../assets/BarcodeFont.eot");
}
</style>
<![endif]-->
<style media="print">
.botao {
display: none;
}
</style>
<span style="font-family:codigo;font-size:110px;"><?php echo $_GET['et']; ?></span>
<br><br><br>
<a href="" onClick="window.print();return false" class="botao"><img src="../assets/images/print.png"></a>