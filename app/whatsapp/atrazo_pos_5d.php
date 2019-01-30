<?PHP
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ERROR | E_PARSE | E_WARNING );


        require_once '../../config/conexao.class.php';
        require_once '../../config/crud.class.php';
        require_once '../../config/mikrotik.class.php';


        $sql5 = $mysqli->query("SELECT * FROM empresa WHERE id = '1'");
        $emp = mysqli_fetch_array($sql5);
        $NomeEmpresa = $emp['empresa'];
        $EmailEmpresa = $emp['email'];
        $dias_bloc = $emp['dias_bloc'];

        $sxd = $mysqli->query("select * from financeiro where date_add(vencimento, interval '5' day) < now() and situacao = 'N'");
        while($daa = mysqli_fetch_array($sxd)) {

     //   echo '<pre>';
    //    print_r($daa);

            $verificazeros = mysqli_num_rows($sxd);

            if ($verificazeros > 0) {

                $codass = $daa['pedido'];
                $ccss = $mysqli->query("SELECT * FROM assinaturas WHERE pedido = '$codass'");
                $cliente = mysqli_fetch_array($ccss);

                $ccvbv = $cliente['cliente'];
                $ccsscv = $mysqli->query("SELECT * FROM clientes WHERE id = '$ccvbv'");
                $vcsms = mysqli_fetch_array($ccsscv);
                $celular = preg_replace("/\D+/", "", $vcsms['cel']);

            }

            $mensagem = "Prezado Cliente existe fatura em aberto superior a 5 dias evite o corte da sua internet";
            shell_exec("yowsup-cli demos -s 55{$celular} \"Informativo: {$NomeEmpresa}, {$mensagem}\" -c /etc/whatsapp/whatsapp.conf");
        }

        mysqli_free_result($result);
?>