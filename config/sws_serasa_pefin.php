<?php
	
	class SERASA extends WebService
	{
		/* URL de Test-Drive */

		const URI_LOCATION      = 'http://www.soawebservices.com.br/webservices/test-drive/serasa/pefin.asmx';
		const URI_LOCATION_WSDL = 'http://www.soawebservices.com.br/webservices/test-drive/serasa/pefin.asmx?WSDL';

		/* URL de Producao */

	//	const URI_LOCATION      = 'http://www.soawebservices.com.br/webservices/producao/serasa/pefin.asmx';
	//	const URI_LOCATION_WSDL = 'http://www.soawebservices.com.br/webservices/producao/serasa/pefin.asmx?WSDL';

		
		private $_traceEnabled  = 1;
		
		public function __construct()
		{
			$options = array
			(
				'location' => SERASA::URI_LOCATION,
		        'trace'    => $this->_traceEnabled,
				'style'    => SOAP_RPC,
		        'use'      => SOAP_ENCODED,
			);
			
			parent::__construct(SERASA::URI_LOCATION_WSDL, $options);
		}
		
		public function getSerasaPefin(Pefin $Pefin)
		{
			$result = $this->callMethod('Pefin', array('parameters' => Util::objectToArray($Pefin)));
			return Util::arrayToObject($result->{$this->getLastCalledMethod() . 'Result'}, $Pefin);
		}
	}

	class Credenciais
	{
		public $Email;
		public $Senha;
	}
	
	class AlertaDocumentos extends ClassMap
	{
		public $Mensagem;
		public $DDD1;
		public $Fone1;
		public $DDD2;
		public $Fone2;
		public $DDD3;
		public $Fone3;
		public function __construct()
		{
			parent::__construct(array(
				'Mensagem'  => 'string',
				'DDD1'      => 'string',
				'Fone1'     => 'string',
				'DDD2'     	=> 'string',
				'Fone2'     => 'string',
				'DDD3'      => 'string',
				'Fone3'     => 'string'
			));
		}
	}	


	class PendenciasFinanceiras extends ClassMap
	{
		public $DataOcorrencia;
		public $Modalidade;
		public $Avalista;
		public $Valor;
		public $Contrato;
		public $Origem;
		public $Sigla;
		public function __construct()
		{
			parent::__construct(array(
				'DataOcorrencia'  => 'string',
				'Modalidade'      => 'string',
				'Avalista'     		=> 'string',
				'Valor'     			=> 'string',
				'Contrato'     		=> 'string',
				'Origem'      		=> 'string',
				'Sigla'    				=> 'string'
			));
		}
	}	
	
	class PendenciasVarejo extends ClassMap
	{
		public $CodigoCompensacaoBanco;
		public $NumeroAgencia;
		public $OrigemOcorrencia;
		public $Sigla;
		public $NumeroLojaFilial;

		public function __construct()
		{
			parent::__construct(array(
				'CodigoCompensacaoBanco'  => 'string',
				'NumeroAgencia'      			=> 'string',
				'OrigemOcorrencia'     		=> 'string',
				'Sigla'     							=> 'string',
				'NumeroLojaFilial'     		=> 'string'
			));
		}
	}	

	class PendenciasBacen extends ClassMap
	{
		public $TotalChequesSemFundo;
		public $DataOcorrenciaAntiga;
		public $DataOcorrenciaRecente;
		public $CodigoCompensacao;
		public $NumeroAgencia;
		public $NomeFantasiaBanco;

		public function __construct()
		{
			parent::__construct(array(
				'TotalChequesSemFundo'  => 'string',
				'DataOcorrenciaAntiga'  => 'string',
				'DataOcorrenciaRecente' => 'string',
				'CodigoCompensacao'     => 'string',
				'NumeroAgencia'     		=> 'string',
				'NomeFantasiaBanco'     => 'string'
			));
		}
	}	


	class Pefin extends ClassMap
	{
		public $Documento;
		public $Nome;
		public $NomeMae;
		public $NomeFantasia;
		public $DataNascimento;
		public $DataFundacao;
		public $SituacaoRFB;
		public $SituacaoDescricaoRFB;
		public $DataSituacaoRFB;
		public $TotalOcorrencias;
		public $AlertaDocumentos;
		public $PendenciasFinanceiras;
		public $PendenciasVarejo;
		public $PendenciasBacen;
		public $Mensagem;
		public $Status;
		
		public function __construct()
		{
			parent::__construct(array(
				'Documento'             => 'string',
				'Nome'                  => 'string',
				'NomeMae'               => 'string',
				'NomeFantasia'               => 'string',
				'DataNascimento'        => 'string',
				'DataFundacao'        => 'string',
				'SituacaoRFB'        => 'string',
				'SituacaoDescricaoRFB'        => 'string',
				'DataSituacaoRFB'        => 'string',
				'TotalOcorrencias'      => 'integer',
				'AlertaDocumentos'			=> 'AlertaDocumentos',
				'PendenciasFinanceiras'	=> 'PendenciasFinanceiras',
				'PendenciasVarejo'			=> 'PendenciasVarejo',
				'PendenciasBacen'				=> 'PendenciasBacen',
				'Mensagem'              => 'string',
				'Status'                => 'boolean',
			));
		}
	}
?>