<?php
	require_once '../../config/conexao.class.php';
	$con = new conexao(); // instancia classe de conxao
	$con->connect(); // abre conexao com o banco
	
	$cliente = addslashes($_GET['cliente']);
	
	$sql_cliente = $mysqli->query("SELECT * FROM assinaturas WHERE cliente = '".$cliente."'");
	$count_cliente = mysqli_num_rows($sql_cliente);
	if($count_cliente > 0){	
?>
<section class="col col-3">
	<label class="label">login</label>
  	<label class="select">
    	<select id="login" name="login" class="selectpicker form-control" data-live-search="true" required>
        	<?php
            	while($res_cliente = mysqli_fetch_assoc($sql_cliente)){
			?>
            <option value="<?php echo $res_cliente['id'];?>"><?php echo $res_cliente['login'];?></option>
            <?php
				}
			?>
      	</select>
  	</label>
</section>
<?php
	}
?>