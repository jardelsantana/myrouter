<?php
/* This function show an alert message based on get return from a database manipulation */
function conditionalAlert($reg){
	if ($reg=='1') {
		$alertType = "success";
		$action = " cadastrado";
	} else if ($reg=='2') {
		$alertType = "info";
		$action = " alterado";
	} else if ($reg =='3') {
		$alertType = "danger";
		$action = " excluído";
	}

echo '<div class="alert alert-'.$alertType.' alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i>
	</button>
		<strong>Atenção!</strong> Técnico'.$action.' com sucesso. 
</div>';

}

?>