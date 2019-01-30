<?php

require_once("../../config/conexao.php");

//mysql
$conecta = mysql_connect("$host", "$usuario", "$senha") or print (mysql_error());
mysql_select_db("$banco", $conecta) or print(mysql_error());

if (mysqli_connect_errno()) 
{
	header('HTTP/1.1 500 Error: Não foi possível conectar ao Banco de Dados!');
	exit();
}

################ Save & delete markers #################
if($_POST) //run only if there's a post data
{
	//make sure request is comming from Ajax
	$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
	if (!$xhr){ 
		header('HTTP/1.1 500 Erro: Pedido deve vir do Ajax!');
		exit();	
	}
	
	// get marker position and split it for database
	$mLatLang	= explode(',',$_POST["latlang"]);
	$mLat 		= filter_var($mLatLang[0], FILTER_VALIDATE_FLOAT);
	$mLng 		= filter_var($mLatLang[1], FILTER_VALIDATE_FLOAT);

	//Delete Marker
	if(isset($_POST["del"]) && $_POST["del"]==true)
	{
        $sql="DELETE FROM fib_markers WHERE lat=$mLat AND lng=$mLng";

        if (!mysql_query($sql,$conecta))
        {
            die('Erro: ' . mysql_error());
        }
        exit("Registro Excluído!");

    //    mysql_close($conecta);
	}
	
	$mName 		= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$mAddress 	= filter_var($_POST["address"], FILTER_SANITIZE_STRING);
	$mType		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);


    $insert="INSERT INTO fib_markers (name, address, lat, lng, type) VALUES ('$mName','$mAddress',$mLat, $mLng, '$mType')";

    if (!mysql_query($insert,$conecta))
    {
        die('Erro: ' . mysql_error());
    }
    exit("Registro Adicionado!");

  //  mysql_close($conecta);
	
	$output = '<h1 class="marker-heading">'.$mName.'</h1><p>'.$mAddress.'</p>';
	exit($output);
}




$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Select all the rows in the markers table

$query = "SELECT * FROM fib_markers WHERE 1";
$result = mysql_query($query,$conecta);
if (!$result) {
    die('Erro: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
    // ADD TO XML DOCUMENT NODE
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name",$row['name']);
    $newnode->setAttribute("address", $row['address']);
    $newnode->setAttribute("lat", $row['lat']);
    $newnode->setAttribute("lng", $row['lng']);
    $newnode->setAttribute("type", $row['type']);
}

echo $dom->saveXML();
?>
