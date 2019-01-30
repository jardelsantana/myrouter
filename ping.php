<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
<meta name="keywords" content="Sistema de Gestão de Provedores">
<meta name="author" content="MyRouter ERP">
<meta name="description" content="MyRouter ERP - Sistema de Gestão de Provedores">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>MyRouter ERP</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<!--JQuery--> 
<script type="text/javascript" src="assets/js/vendors/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/jquery/jquery-ui.min.js"></script> 
<script type="text/javascript" src="assets/js/vendors/modernizr/modernizr.custom.js"></script>
</head>
<script type='text/javascript'>
		      $(document).ready(function() {
 	 	      $("#up<?php echo $i; ?>").load("app/ping.php?ip=<?php echo $_GET['ip']; ?>&login=<?php echo $_GET['login']; ?>&senha=<?php echo $_GET['senha']; ?>&ping=<?php echo $_GET['ping']; ?>");
   		      var refreshId = setInterval(function() {
      		      $("#up<?php echo $i; ?>").load("app/ping.php?ip=<?php echo $_GET['ip']; ?>&login=<?php echo $_GET['login']; ?>&senha=<?php echo $_GET['senha']; ?>&ping=<?php echo $_GET['ping']; ?>");
   		      }, 1000);
   		      $.ajaxSetup({ cache: false });
   		      });
   		      </script>
   		      <div id="up"></div>
</html>