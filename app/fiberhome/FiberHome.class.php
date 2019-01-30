<?php
/**
* Classe de Acesso ao TL1 Server no ANM2000
*
* @package    FiberHome
* @author     Benedicto Jr
* @version    1.0 ELO Internet
*/
class FiberHome
{
	private $fp;
	private $ipTL1;
	private $DEBUG;

	/**
	 * Construtor
	 * 
	 * Abre um socket com o servidor TL1 e realiza o LOGIN
	 *
	 * @param ipv4	 $ipAdmin IP de Administração
	 * @param ipv4   $ipTL1 IP do TL1 Server
	 * @param string $User Usuário
	 * @param string $Pass Senha
	 * @param logic  $debug Modo depuração 
	 * @return void
	 */
	function __construct($ipAdmin, $ipTL1, $User, $Pass, $debug=false)
	{
		$this->DEBUG = $debug;

		$this->fp = fsockopen($ipAdmin, 3337, $errno, $errstr, 30);
		if (!$this->fp) {
			die("$errstr ($errno)\n");
		} else {
			$this->cmd("LOGIN:::CTAG::UN={$User},PWD={$Pass};");
			$this->ipTL1 = $ipTL1;
		}
	}

	/**
	 * Executa um comando no servidor
	 *
	 * @param string $cmd Comando completo
	 * @return array $ret Array multidimensional linhas com as colunas separadas do resultado do comando
	 */
	public function cmd($cmd)
	{
		$ret = array();

		$this->msg($cmd);
		fwrite($this->fp, "$cmd\n");

		while (true) {
			$c = fread($this->fp, 1);
			if ($this->DEBUG) echo $c;
			if ($c == ';') break;
			$lin = trim($c . fgets($this->fp));
			$ret[] = split("\t", $lin);
			$this->msg($lin);
		}
		return $ret;
	}

	/**
	 * Exibe uma mensagem de depuração
	 *
	 * @param string $msg Mensagem
	 * @return void
	 */
	private function msg($msg)
	{
		if ($this->DEBUG) {
			echo trim($msg)."\n";
		}
	}

	/**
	 * Lista as ONUs registradas
	 *
	 * @param void
	 * @return array $ret Matriz associativa usando o MAC da ONU como chave
	 */
	public function ONUList()
	{
		$ret = array();

		$list = $this->cmd("LST-ONU::OLTID={$this->ipTL1}:CTAG::;");
		if (preg_match("/block_records\=(\d+)/", $list[5][0], $match)) {
			$nONUs = $match[1];
			$header = $list[9];
			for ($n=0; $n<$nONUs; $n++) {
				$mac = strtoupper(trim($list[10+$n][8]));
				for ($c=0; $c<count($header); $c++) {
					$ret[$mac][strtoupper(trim($header[$c]))] = trim($list[10+$n][$c]);
				}
				if (preg_match("/^([\w\-]*)\-PON\[(\d+)\]/", $ret[$mac]['NAME'], $match)) {
					$ret[$mac]['NAME'] = (empty($match[1])?'--':$match[1]);
					$ret[$mac]['PON'] = $match[2];
				}
			}
		}
		return $ret;
	}

	/**
	 * Complementa a lista as ONUs registradas com os seus estados
	 *
	 * @param array $onuArr Matriz de ONUs registradas
	 * @return array $ret Matriz associativa usando o MAC da ONU como chave
	 */
	public function ONUStates(&$onuArr)
	{
		foreach ($onuArr as $mac => $reg) {
			$list = $this->cmd("LST-ONUSTATE::OLTID={$this->ipTL1},PONID={$reg['PONID']},ONUIDTYPE=MAC,ONUID={$mac}:CTAG::;");
			$header = $list[9];
			for ($c=0; $c<count($header); $c++) {
				$onuArr[$mac][strtoupper($header[$c])] = $list[10][$c];
			}
		}

		return $onuArr;
	}

	/**
	 * Complementa a lista as ONUs registradas com informações de potência de entrada e saída
	 *
	 * @param array $onuArr Matriz de ONUs registradas
	 * @return array $ret Matriz associativa usando o MAC da ONU como chave
	 */
	public function ONUInfos(&$onuArr)
	{
		foreach ($onuArr as $mac => $reg) {
			$list = $this->cmd("LST-OMDDM::OLTID={$this->ipTL1},PONID={$reg['PONID']},ONUIDTYPE=MAC,ONUID={$mac}:CTAG::;");
			$header = $list[9];
			for ($c=0; $c<count($header); $c++) {
				$onuArr[$mac][strtoupper($header[$c])] = $list[10][$c];
			}
		}

		return $onuArr;
	}

	/**
	 * Lista as ONUs não registradas
	 * 
	 * NÃO FUNCIONOU!
	 *
	 * @param void
	 * @return array $ret Matriz associativa usando o MAC da ONU como chave
	 */
	public function ONUUnregistered()
	{
		$list = $this->cmd("LST-UNREGONU::OLTID={$this->ipTL1}:CTAG::;");
		var_dump($list);
	}


}
