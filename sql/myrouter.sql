CREATE DATABASE myrouter;
use myrouter;

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;


-- ----------------------------
-- Estrutura da tabela `boletos_arquivos`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `boletos_arquivos` (
  `boletos_arquivos_codigo` int(11) NOT NULL,
  `bancos_codigo` int(11) NOT NULL,
  `boletos_arquivos_datahora` datetime DEFAULT NULL,
  `situacao` varchar(3) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Indexes for table `boletos_arquivos`
-- ----------------------------
ALTER TABLE `boletos_arquivos`
  ADD PRIMARY KEY (`boletos_arquivos_codigo`,`bancos_codigo`);

-- ----------------------------
--  Table structure for `assinaturas`
-- ----------------------------
DROP TABLE IF EXISTS `assinaturas`;
CREATE TABLE `assinaturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(11) DEFAULT NULL,
  `cliente` varchar(11) DEFAULT NULL,
  `login` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `servidor` varchar(100) DEFAULT NULL,
  `endereco` varchar(160) DEFAULT NULL,
  `numero` varchar(11) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `complemento` varchar(120) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `cep` varchar(16) DEFAULT NULL,
  `plano` varchar(11) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `routeip` varchar(60) DEFAULT NULL,
  `ipv6` varchar(100) DEFAULT NULL,
  `mac` varchar(60) DEFAULT NULL,
  `vencimento` varchar(11) DEFAULT NULL,
  `bloqueio` varchar(11) DEFAULT '2',
  `macwireless` varchar(60) DEFAULT NULL,
  `chavewpa` varchar(100) DEFAULT NULL,
  `observacao` varchar(200) DEFAULT NULL,
  `insento` varchar(2) DEFAULT 'N',
  `autobloqueio` varchar(2) DEFAULT 'S',
  `alterarsenha` varchar(2) DEFAULT 'S',
  `desconto` varchar(11) DEFAULT NULL,
  `acrescimo` varchar(11) DEFAULT NULL,
  `ippool` varchar(50) DEFAULT NULL,
  `ip_ubnt` varchar(60) DEFAULT NULL,
  `porta_ubnt` varchar(6) DEFAULT NULL,
  `login_ubnt` varchar(30) DEFAULT NULL,
  `senha_ubnt` varchar(30) DEFAULT NULL,
  `situacao` varchar(2) DEFAULT 'S',
  `datavencimento` varchar(60) DEFAULT NULL,
  `pedido` varchar(60) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'S',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `backups`
-- ----------------------------
DROP TABLE IF EXISTS `backups`;
CREATE TABLE `backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servidor` varchar(160) DEFAULT NULL,
  `arquivo` varchar(60) DEFAULT NULL,
  `data` varchar(36) DEFAULT NULL,
  `idmk` varchar(11) DEFAULT NULL,
  `regkey` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `clientes`
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(16) DEFAULT NULL,
  `empresa` varchar(11) DEFAULT NULL,
  `nome` varchar(160) DEFAULT NULL,
  `login` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `cpf` varchar(60) DEFAULT NULL,
  `rg` varchar(60) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `cel` varchar(60) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pai` varchar(60) DEFAULT NULL,
  `mae` varchar(60) DEFAULT NULL,
  `nascimento` varchar(60) DEFAULT NULL,
  `estadocivil` varchar(60) DEFAULT NULL,
  `naturalidade` varchar(100) DEFAULT NULL,
  `dataentrada` date DEFAULT NULL,
  `vctocontrato` date DEFAULT NULL,
  `endereco` varchar(160) DEFAULT NULL,
  `numero` varchar(11) DEFAULT NULL,
  `referencia` varchar(200) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `cep` varchar(36) DEFAULT NULL,
  `nf` varchar(2) DEFAULT 'N',
  `cfop` varchar(10) DEFAULT '5307',
  `tipoassinante` varchar(2) DEFAULT NULL,
  `tipoutilizacao` varchar(2) DEFAULT NULL,
  `grupo` varchar(60) DEFAULT 'N',
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `controlebanda`
-- ----------------------------
DROP TABLE IF EXISTS `controlebanda`;
CREATE TABLE `controlebanda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(11) DEFAULT NULL,
  `plano` varchar(11) DEFAULT NULL,
  `pedido` varchar(60) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `download` varchar(16) DEFAULT NULL,
  `upload` varchar(16) DEFAULT NULL,
  `burstdownload` varchar(16) DEFAULT NULL,
  `burstupload` varchar(16) DEFAULT NULL,
  `inicio` varchar(26) DEFAULT NULL,
  `fim` varchar(26) DEFAULT NULL,
  `seg` varchar(6) DEFAULT NULL,
  `ter` varchar(6) DEFAULT NULL,
  `qua` varchar(6) DEFAULT NULL,
  `qui` varchar(6) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `sab` varchar(6) DEFAULT NULL,
  `dom` varchar(6) DEFAULT NULL,
  `burst1` varchar(60) DEFAULT NULL,
  `burst2` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `maile`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `maile` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `empresa` int(1) NOT NULL,
  `url` varchar(250) NOT NULL,
  `servidor` varchar(255) NOT NULL,
  `porta` varchar(20) NOT NULL,
  `smtpsecure` varchar(3) DEFAULT NULL,
  `endereco` varchar(250) NOT NULL,
  `limitemail` varchar(30) NOT NULL,
  `aviso` varchar(250) NOT NULL,
  `avisofataberto` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `text1` longtext NOT NULL,
  `text2` longtext NOT NULL,
  `text3` longtext NOT NULL,
  `text4` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `maile`
-- ----------------------------
BEGIN;
INSERT INTO `maile` (`id`, `empresa`, `url`, `servidor`, `porta`, `smtpsecure`, `endereco`, `limitemail`, `aviso`, `avisofataberto`, `email`, `senha`, `text1`, `text2`, `text3`, `text4`) VALUES
(1, 1, 'http://localhost/myrouter', 'smtp.gmail.com', '465', 'ssl', 'http://www.myrouter.com.br', '250', 'Aviso de Fatura gerada', 'Reaviso de Fatura em Aberto', 'email@gmail.com', '123456', '<h2>[NomeEmpresa]</h2>\r\n<hr />\r\n<p><strong>Ol&aacute; [NomeCliente] ,</strong></p>\r\n<p><strong>Voc&ecirc; tem uma nova fatura.<br /></strong></p>\r\n<ul>\r\n<li><strong>Valor do Plano:</strong> [valor]</li>\r\n<li><strong>Vencimento:</strong> [vencimento]</li>\r\n<li><strong>N&ordm; da Fatura: </strong>[numeroFatura]</li>\r\n</ul>\r\n<p><strong>Refer&ecirc;nte a:</strong> [referencia]</p>\r\n<p><strong>Para efetuar o pagamento, clique no bot&atilde;o abaixo "Realizar Pagamento"</strong></p>\r\n<p>[link]</p>\r\n<p>ou aceacesse o portal do <strong>[endereco]</strong></p>\r\n<p>- Central de atendimento no e-mail: [email]<br /> - 2&ordm; Via do Boleto, solicite no portal:&nbsp;<strong>[endereco]</strong></p>\r\n<hr />\r\n<p><strong>AVISO LEGAL</strong>: Esta mensagem &eacute; destinada exclusivamente para a(s) pessoa(s) a quem &eacute; dirigida, podendo conter informa&ccedil;&atilde;o confidencial e/ou legalmente privilegiada. Se voc&ecirc; n&atilde;o for destinat&aacute;rio desta mensagem, desde j&aacute; fica notificado de abster-se a divulgar, copiar, distribuir, examinar ou, de qualquer forma, utilizar a informa&ccedil;&atilde;o contida nesta mensagem, por ser ilegal. Caso voc&ecirc; tenha recebido esta mensagem por engano, pedimos que nos retorne este E-Mail, promovendo, desde logo, a elimina&ccedil;&atilde;o do seu conte&uacute;do em sua base de dados, registros ou sistema de controle. Fica desprovida de efic&aacute;cia e validade a mensagem que contiver v&iacute;nculos obrigacionais, expedida por quem n&atilde;o detenha poderes de representa&ccedil;&atilde;o.</p>', '<h2>[NomeEmpresa]</h2>\r\n<hr />\r\n<p><strong>Ol&aacute; [NomeCliente] ,</strong></p>\r\n<p><strong>Ainda n&atilde;o identificamos o pagamento da fatura descrita a baixo:</strong></p>\r\n<ul>\r\n<li><strong>Valor:</strong> [valor]</li>\r\n<li><strong>Vencimento:</strong> [vencimento]</li>\r\n<li><strong>N&ordm; da Fatura: </strong>[numeroFatura]</li>\r\n</ul>\r\n<p><strong>Refer&ecirc;nte a:</strong> [referencia]</p>\r\n<p><strong>Para efetuar o pagamento, clique no bot&atilde;o abaixo "Realizar Pagamento"</strong></p>\r\n<p>[link]</p>\r\n<p>ou acesse o portal do&nbsp;<strong>[endereco]</strong></p>\r\n<p>- Central de atendimento no e-mail:&nbsp;<strong>[email]</strong><br />- 2&ordm; Via do Boleto, solicite no portal:&nbsp;<strong>[endereco]</strong></p>\r\n<hr />\r\n<p><strong>AVISO LEGAL</strong>: Esta mensagem &eacute; destinada exclusivamente para a(s) pessoa(s) a quem &eacute; dirigida, podendo conter informa&ccedil;&atilde;o confidencial e/ou legalmente privilegiada. Se voc&ecirc; n&atilde;o for destinat&aacute;rio desta mensagem, desde j&aacute; fica notificado de abster-se a divulgar, copiar, distribuir, examinar ou, de qualquer forma, utilizar a informa&ccedil;&atilde;o contida nesta mensagem, por ser ilegal. Caso voc&ecirc; tenha recebido esta mensagem por engano, pedimos que nos retorne este E-Mail, promovendo, desde logo, a elimina&ccedil;&atilde;o do seu conte&uacute;do em sua base de dados, registros ou sistema de controle. Fica desprovida de efic&aacute;cia e validade a mensagem que contiver v&iacute;nculos obrigacionais, expedida por quem n&atilde;o detenha poderes de representa&ccedil;&atilde;o.</p>', '<p>Seu cadastro foi efetuado com sucesso em nosso sistema.</p>\r\n<p>Segue seus dados de acesso:</p>', '<h2>[NomeEmpresa]</h2>\r\n<hr />\r\n<p><strong>Ol&aacute; [NomeCliente] ,</strong></p>\r\n<p><strong>Ainda n&atilde;o identificamos o pagamento da fatura descrita a baixo:</strong></p>\r\n<ul>\r\n<li><strong>Valor:</strong> [valor]</li>\r\n<li><strong>Vencimento:</strong> [vencimento]</li>\r\n<li><strong>N&ordm; da Fatura: </strong>[numeroFatura]</li>\r\n</ul>\r\n<p><strong>Refer&ecirc;nte a:</strong> [referencia]</p>\r\n<p><strong>Para efetuar o pagamento, clique no bot&atilde;o abaixo "Realizar Pagamento"</strong></p>\r\n<p>[link]</p>\r\n<p>ou acesse o portal do&nbsp;<strong>[endereco]</strong></p>\r\n<p>- Central de atendimento no e-mail:&nbsp;<strong>[email]</strong><br />- 2&ordm; Via do Boleto, solicite no portal:&nbsp;<strong>[endereco]</strong></p>\r\n<hr />\r\n<p><strong>AVISO LEGAL</strong>: Esta mensagem &eacute; destinada exclusivamente para a(s) pessoa(s) a quem &eacute; dirigida, podendo conter informa&ccedil;&atilde;o confidencial e/ou legalmente privilegiada. Se voc&ecirc; n&atilde;o for destinat&aacute;rio desta mensagem, desde j&aacute; fica notificado de abster-se a divulgar, copiar, distribuir, examinar ou, de qualquer forma, utilizar a informa&ccedil;&atilde;o contida nesta mensagem, por ser ilegal. Caso voc&ecirc; tenha recebido esta mensagem por engano, pedimos que nos retorne este E-Mail, promovendo, desde logo, a elimina&ccedil;&atilde;o do seu conte&uacute;do em sua base de dados, registros ou sistema de controle. Fica desprovida de efic&aacute;cia e validade a mensagem que contiver v&iacute;nculos obrigacionais, expedida por quem n&atilde;o detenha poderes de representa&ccedil;&atilde;o.</p>');
COMMIT;

-- ----------------------------
--  Table structure for `empresa`
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `empresa` varchar(160) DEFAULT NULL,
  `endereco` varchar(160) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `cep` varchar(16) DEFAULT NULL,
  `tel1` varchar(60) DEFAULT NULL,
  `tel2` varchar(60) DEFAULT NULL,
  `site` varchar(160) DEFAULT NULL,
  `skype` varchar(80) NOT NULL,
  `email` varchar(160) DEFAULT NULL,
  `dias_bloc` int(2) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `contratocliente` varchar(255) DEFAULT NULL,
  `contratoassinatura` varchar(255) DEFAULT NULL,
  `cnpj` varchar(160) DEFAULT NULL,
  `fistel` varchar(160) DEFAULT NULL,
  `chave` varchar(1024) DEFAULT NULL,
  `regkey` varchar(255) DEFAULT NULL,
  `banco` varchar(11) DEFAULT NULL,
  `bancos_codigo` int(10) DEFAULT NULL,
  `bancos_layout` varchar(200) DEFAULT NULL,
  `smslogin` varchar(60) DEFAULT NULL,
  `smssenha` varchar(60) DEFAULT NULL,
  `emailspc` varchar(160) DEFAULT NULL,
  `senhaspc` varchar(60) DEFAULT NULL,
  `codtributo` varchar(160) DEFAULT NULL,
  `ie` varchar(60) DEFAULT NULL,
  `im` varchar(60) DEFAULT NULL,
  `serie` varchar(60) DEFAULT NULL,
  `modelonota` varchar(3) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `naturezaop` varchar(60) DEFAULT NULL,
  `opsimples` varchar(60) DEFAULT NULL,
  `ic` varchar(60) DEFAULT NULL,
  `codmunicipio` varchar(60) DEFAULT NULL,
  `codservico` varchar(60) DEFAULT NULL,
  `apikey` varchar(160) DEFAULT NULL,
  `receberate` varchar(160) DEFAULT NULL,
  `instrucoes1` varchar(160) DEFAULT NULL,
  `instrucoes2` varchar(160) DEFAULT NULL,
  `instrucoes3` varchar(160) DEFAULT NULL,
  `instrucoes4` varchar(160) DEFAULT NULL,
  `token_gnet` varchar(255) DEFAULT NULL,
  `carteira` varchar(60) DEFAULT NULL,
  `agencia` varchar(60) DEFAULT NULL,
  `digito_ag` varchar(60) DEFAULT NULL,
  `conta` varchar(60) DEFAULT NULL,
  `digito_co` varchar(60) DEFAULT NULL,
  `tipo_carteira` varchar(60) DEFAULT NULL,
  `convenio` varchar(60) DEFAULT NULL,
  `convenio_dv` varchar(3) DEFAULT NULL,
  `contrato` varchar(60) DEFAULT NULL,
  `especie` varchar(60) DEFAULT NULL,
  `lancarfaturas` varchar(2) DEFAULT NULL,
  `obs` text,
  `versao` varchar(20) DEFAULT NULL,
  `avisotemporario` longtext NOT NULL,
  `avisopermanente` longtext NOT NULL,
  `whatsapp1` longtext,
  `whatsapp2` longtext,
  `qtddiasrenovacaoboleto` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `empresa`
-- ----------------------------
BEGIN;
INSERT INTO `empresa` (`id`, `empresa`, `endereco`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `tel1`, `tel2`, `site`, `skype`, `email`, `dias_bloc`, `foto`, `contratocliente`, `contratoassinatura`, `cnpj`, `fistel`, `chave`, `regkey`, `banco`, `bancos_codigo`, `bancos_layout`, `smslogin`, `smssenha`, `emailspc`, `senhaspc`, `codtributo`, `ie`, `im`, `serie`, `modelonota`, `tipo`, `naturezaop`, `opsimples`, `ic`, `codmunicipio`, `codservico`, `apikey`, `receberate`, `instrucoes1`, `instrucoes2`, `instrucoes3`, `instrucoes4`, `token_gnet`, `carteira`, `agencia`, `digito_ag`, `conta`, `digito_co`, `tipo_carteira`, `convenio`, `convenio_dv`, `contrato`, `especie`, `lancarfaturas`, `obs`, `versao`, `avisotemporario`, `avisopermanente`, `whatsapp1`, `whatsapp2`, `qtddiasrenovacaoboleto`) VALUES
(1, 'MyRouter Soluções ERP', 'RUA TAL', '45', 'Ponte Alta Norte', 'BRASILIA', 'DF', '71880-144', '(061) 4063-8485', '06182036581', 'http://www.myrouter.com.br', 'edielsonps', 'contato@myrouter.com.br', 10, 'empresa.png', 'contrato.rtf', NULL, '00.000.300/0001-23', '1234567890', 'IzE5ODI5ODI5ODI3MzAwMTA4OTM4Mzk0ODk4UjIwMTUtMDEtMjA==', 'IzE5ODI5ODI5ODI3MzAwMTA4OTM4Mzk0ODk4UjIwMTUtMDEtMjA', '3', 104, 'cnab240_SIGCB', 'myrouter', '898989899', 'contato@myrouter.com.br', 'CUVNxjmyL', '', '1234567890', '1234567890', 'A', '21', '1', '1', '1', '2', '', '', 'bbae2b725c369836424b0195dda34c1379385548', 'Não receber após 10 dias de vencimento', 'Cobrar 2% de Multa por dia', 'Em caso de dúvidas entre em contato conosco.', 'MyRouter Soluções ERP', NULL, '76af2332a23aa5ee850e873f5c5aaa2d', '02', '4331', '0', '472102', '0', 'CR', '47210', '2', '000012',  'DM', '4', '', '4.0', '<h1 style="text-align: center;"><span style="color: #ff0000;">ATEN&Ccedil;&Atilde;O!</span></h1>\r\n<p style="text-align: center;"><strong>SUA INTERNET <span style="color: #ff0000;">N&Atilde;O</span> ESTA BLOQUEADA</strong></p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">Informativo:</p>\r\n<p style="text-align: center;">Prezado cliente,</p>\r\n<p style="text-align: center;">Constam boleto(s) em aberto em nosso sistema, favor regularize e evite o bloqueio de sua internet.</p>\r\n<p style="text-align: center;">Para acesso ao(s) boleto(s) clique aqui: Central do Assinante</p>\r\n<p style="text-align: center;">Ap&oacute;s 3 minutos feche o navegador e abra novamente para ter acesso a internet.</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;">&nbsp;Central de Atendimento &nbsp;(XX) XXXX-XXXX</p>', '<h1 style="font-family: -apple-system-font;" align="center"><span style="color: #ff0000;">CONEX&Atilde;O INTERROMPIDA!</span></h1>\r\n<h3 style="font-family: -apple-system-font; text-align: center;">Informativo:&nbsp;</h3>\r\n<h3 style="font-family: -apple-system-font; text-align: center;">Prezado cliente,</h3>\r\n<p style="font-family: -apple-system-font; font-size: 12px; line-height: 16px; text-align: center;">Consta(m) boleto(s) em aberto com data superior a 05 (CINCO) dias em nosso sistema. Acesso bloqueado conforme clausula contratual.</p>\r\n<p style="font-family: -apple-system-font; font-size: 12px; line-height: 16px; text-align: center;">Para acesso ao(s) boleto(s) clique aqui:&nbsp;<a href="http://www.myrouter.com.br/central">Central do Assinante</a></p>\r\n<p style="font-family: -apple-system-font; font-size: 12px; line-height: 16px; text-align: center;">&nbsp;</p>\r\n<p style="font-family: -apple-system-font; font-size: 12px; line-height: 16px; text-align: center;">Central do Assinante:</p>', '', '', '3');
COMMIT;


-- ----------------------------
--  Table structure for `fabricante`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `fabricante` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `empresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- ----------------------------
--  Records of `equipamentos`
-- ----------------------------
BEGIN;
INSERT INTO `fabricante` (`id`, `nome`, `empresa`) VALUES
(3, 'MIKROTIK', 1),
(4, 'UBIQUITI', 1),
(5, 'TPLINK', 1),
(6, 'INTELBRAS', 1),
(8, 'FIBERHOME', 1);
COMMIT;


-- ----------------------------
--  Table structure for `equipamentos`
-- ----------------------------
DROP TABLE IF EXISTS `equipamentos`;
CREATE TABLE `equipamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(11) DEFAULT NULL,
  `equipamento` varchar(160) DEFAULT NULL,
  `notafiscal` varchar(60) DEFAULT NULL,
  `modelo` varchar(160) DEFAULT NULL,
  `fabricante` varchar(160) DEFAULT NULL,
  `fornecedor` int(11) DEFAULT NULL,
  `aquisicao` varchar(36) DEFAULT NULL,
  `barcode` varchar(60) DEFAULT NULL,
  `garantia` varchar(60) DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  `venda` decimal(10,2) DEFAULT NULL,
  `nserie` varchar(60) DEFAULT NULL,
  `qtd` varchar(11) DEFAULT NULL,
  `disponivel` varchar(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `equipamentos`
-- ----------------------------
BEGIN;
INSERT INTO `equipamentos` (`id`, `empresa`, `equipamento`, `notafiscal`, `modelo`, `fabricante`, `fornecedor`, `aquisicao`, `barcode`, `garantia`, `custo`, `venda`, `nserie`, `qtd`, `disponivel`, `status`) VALUES
(1, '1', 'NANO LOCO M5', '010203040506', 'NANO LOCO M5', '4', 3, '01/01/2015', '45638782', '12', 10.00, 100.00, '', '100', '100', 'S');
COMMIT;


-- ----------------------------
--  Table structure for `faturas`
-- ----------------------------
DROP TABLE IF EXISTS `faturas`;
CREATE TABLE `faturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(16) DEFAULT NULL,
  `formapagto` varchar(160) DEFAULT NULL,
  `referencia` varchar(60) DEFAULT NULL,
  `assinatura` varchar(11) DEFAULT NULL,
  `cliente` varchar(11) DEFAULT NULL,
  `plano` varchar(11) DEFAULT NULL,
  `valor` varchar(11) DEFAULT NULL,
  `lancamento` varchar(60) DEFAULT NULL,
  `vencimento` varchar(60) DEFAULT NULL,
  `situacao` varchar(2) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `financeiro`
-- ----------------------------
DROP TABLE IF EXISTS `financeiro`;
CREATE TABLE `financeiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` int(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `nfatura` varchar(11) DEFAULT NULL,
  `cliente` varchar(11) DEFAULT NULL,
  `pedido` varchar(60) DEFAULT NULL,
  `vencimento` varchar(60) DEFAULT NULL,
  `cadastro` varchar(26) DEFAULT NULL,
  `dia` varchar(2) DEFAULT NULL,
  `mes` varchar(2) DEFAULT NULL,
  `ano` varchar(4) DEFAULT NULL,
  `plano` varchar(11) DEFAULT NULL,
  `login` varchar(160) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `mac` varchar(60) DEFAULT NULL,
  `valor` varchar(60) DEFAULT NULL,
  `mesparcela` varchar(2) DEFAULT NULL,
  `boleto` int(60) DEFAULT NULL,
  `vencimento_fn` date NOT NULL,
  `pagamento_fn` date NOT NULL,
  `status_fn` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `data_fn` date NOT NULL,
  `hora_fn` time NOT NULL,
  `financ_data_fn` varchar(60) DEFAULT NULL,
  `financ_hora_fn` varchar(60) DEFAULT NULL,
  `retorno_fn` varchar(50) NOT NULL,
  `competencia_fn` int(11) NOT NULL,
  `situacao` varchar(2) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `avulso` int(11) NOT NULL,
  `admin` varchar(60) DEFAULT NULL,
  `chave` varchar(200) NOT NULL,
  `linkGerencia` varchar(255) NOT NULL,
  `recebido` varchar(60) DEFAULT NULL,
  `remessa` int(11) NOT NULL,
  `boletos_arquivos_codigo` varchar(20) NOT NULL,
  `migracaodebanco` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `financeiro`
-- ----------------------------


-- ----------------------------
--  Table structure for `firewall`
-- ----------------------------
DROP TABLE IF EXISTS `firewall`;
CREATE TABLE IF NOT EXISTS `firewall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(11) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `action` varchar(60) DEFAULT NULL,
  `chain` varchar(60) DEFAULT NULL,
  `srcaddress` varchar(60) DEFAULT NULL,
  `dstaddress` varchar(60) DEFAULT NULL,
  `naosrcaddresslist` varchar(1) DEFAULT NULL,
  `srcaddresslist` varchar(200) DEFAULT NULL,
  `naodstaddresslist` varchar(1) DEFAULT NULL,
  `dstaddresslist` varchar(200) DEFAULT NULL,
  `protocolo` varchar(50) DEFAULT NULL,
  `naointerfacein` varchar(1) DEFAULT NULL,
  `interfacein` varchar(60) DEFAULT NULL,
  `naointerfaceout` varchar(1) DEFAULT NULL,
  `interfaceout` varchar(60) DEFAULT NULL,
  `dstport` varchar(6) DEFAULT NULL,
  `toaddresses` varchar(60) DEFAULT NULL,
  `toports` varchar(6) DEFAULT NULL,
  `conteudo` varchar(1024) DEFAULT NULL,
  `comentario` varchar(160) DEFAULT NULL,
  `disabled` varchar(3) DEFAULT NULL,
  `servidor` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `fornecedores`
-- ----------------------------
DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(16) DEFAULT NULL,
  `empresa` varchar(11) DEFAULT NULL,
  `nome` varchar(160) DEFAULT NULL,
  `razao` varchar(160) DEFAULT NULL,
  `cpf` varchar(60) DEFAULT NULL,
  `rg` varchar(60) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `cel` varchar(60) DEFAULT NULL,
  `endereco` varchar(160) DEFAULT NULL,
  `numero` varchar(11) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `cep` varchar(36) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `hotspots`
-- ----------------------------
DROP TABLE IF EXISTS `hotspots`;
CREATE TABLE `hotspots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servidor` varchar(11) DEFAULT NULL,
  `plano` varchar(11) DEFAULT NULL,
  `login` varchar(36) DEFAULT NULL,
  `senha` varchar(36) DEFAULT NULL,
  `comentario` varchar(160) DEFAULT NULL,
  `uptime` varchar(60) DEFAULT NULL,
  `bytesin` varchar(60) DEFAULT NULL,
  `bytesout` varchar(60) DEFAULT NULL,
  `valor` varchar(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `instalacao_equipamentos`
-- ----------------------------
DROP TABLE IF EXISTS `instalacao_equipamentos`;
CREATE TABLE `instalacao_equipamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assinatura` int(16) DEFAULT NULL,
  `equipamento` varchar(160) DEFAULT NULL,
  `qtd` varchar(11) DEFAULT NULL,
  `obs` varchar(160) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `instalacao_equipamentos`
-- ----------------------------


-- ----------------------------
--  Table structure for `ippool`
-- ----------------------------
DROP TABLE IF EXISTS `ippool`;
CREATE TABLE `ippool` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `ranges` varchar(60) DEFAULT NULL,
  `servidor` varchar(11) DEFAULT NULL,
  `pedido` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `lc_cat`
-- ----------------------------
DROP TABLE IF EXISTS `lc_cat`;
CREATE TABLE `lc_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `lc_cat`
-- ----------------------------
BEGIN;
INSERT INTO `lc_cat` VALUES ('1', 'Mensalidades');
COMMIT;

-- ----------------------------
--  Table structure for `lc_movimento`
-- ----------------------------
DROP TABLE IF EXISTS `lc_movimento`;
CREATE TABLE `lc_movimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `dia` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `cat` int(11) DEFAULT NULL,
  `descricao` longtext,
  `valor` decimal(10,2) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `pedido` varchar(60) DEFAULT NULL,
  `admin` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


-- ----------------------------
--  Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin` varchar(200) DEFAULT NULL,
  `ip` varchar(80) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `acao` varchar(200) DEFAULT NULL,
  `detalhes` varchar(255) DEFAULT NULL,
  `query` longtext,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Estrutura da tabela `lc_fixas`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `lc_fixas` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `descricao_fixa` varchar(200) NOT NULL,
  `dia_vencimento` varchar(2) NOT NULL,
  `valor_fixa` decimal(10,2) NOT NULL,
  `cat` int(11) DEFAULT NULL,
  `empresa` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- ----------------------------
--  Table structure for `nas`
-- ----------------------------
DROP TABLE IF EXISTS `nas`;
CREATE TABLE `nas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client',
  `idservidorerpmk` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `notafiscal`
-- ----------------------------
DROP TABLE IF EXISTS `notafiscal`;
CREATE TABLE `notafiscal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lote` varchar(60) DEFAULT NULL,
  `nlote` varchar(11) DEFAULT NULL,
  `nnota` varchar(255) DEFAULT NULL,
  `assinaturadigital` varchar(255) DEFAULT NULL,
  `inscricaomunicipal` varchar(60) DEFAULT NULL,
  `qtdrps` varchar(60) DEFAULT NULL,
  `infrps` varchar(60) DEFAULT NULL,
  `numero` varchar(60) DEFAULT NULL,
  `serie` varchar(60) DEFAULT NULL,
  `tipo` varchar(60) DEFAULT NULL,
  `emissao` varchar(60) DEFAULT NULL,
  `naturezaop` varchar(60) DEFAULT NULL,
  `opsimples` varchar(36) DEFAULT NULL,
  `ic` varchar(36) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `valorservicos` varchar(11) DEFAULT NULL,
  `valordeducoes` varchar(11) DEFAULT NULL,
  `valorpis` varchar(11) DEFAULT NULL,
  `valorcofins` varchar(11) DEFAULT NULL,
  `valorinss` varchar(11) DEFAULT NULL,
  `valorir` varchar(11) DEFAULT NULL,
  `valoresisentos` varchar(11) DEFAULT NULL,
  `outrosvalores` varchar(11) DEFAULT NULL,
  `valorcsll` varchar(11) DEFAULT NULL,
  `issretido` varchar(11) DEFAULT NULL,
  `valoriss` varchar(11) DEFAULT NULL,
  `valoroutros` varchar(11) DEFAULT NULL,
  `aliquota` varchar(11) DEFAULT NULL,
  `icms` varchar(11) DEFAULT NULL,
  `descontoi` varchar(11) DEFAULT NULL,
  `descontoc` varchar(11) DEFAULT NULL,
  `vscom` varchar(11) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `codmunicipio` varchar(36) DEFAULT NULL,
  `cnpj` varchar(36) DEFAULT NULL,
  `cliente` varchar(11) DEFAULT NULL,
  `clientecpf` varchar(36) DEFAULT NULL,
  `clienterg` varchar(30) DEFAULT NULL,
  `clientenome` varchar(160) DEFAULT NULL,
  `clienteendereco` varchar(160) DEFAULT NULL,
  `clientenumero` varchar(11) DEFAULT NULL,
  `clientecomplemento` varchar(160) DEFAULT NULL,
  `clientebairro` varchar(160) DEFAULT NULL,
  `clientecidade` varchar(160) DEFAULT NULL,
  `clienteuf` varchar(2) DEFAULT NULL,
  `clientecep` varchar(26) DEFAULT NULL,
  `clienteemail` varchar(255) DEFAULT NULL,
  `anorps` varchar(4) DEFAULT NULL,
  `mesrps` varchar(2) DEFAULT NULL,
  `codtributo` varchar(60) DEFAULT NULL,
  `codservico` varchar(60) DEFAULT NULL,
  `diavencimento` varchar(2) DEFAULT NULL,
  `cfop` varchar(10) DEFAULT NULL,
  `tipoassinante` varchar(2) DEFAULT NULL,
  `tipoutilizacao` varchar(2) DEFAULT NULL,
  `clientetelefone` varchar(18) DEFAULT NULL,
  `quantidadecontratada` varchar(18) DEFAULT NULL,
  `quantidadefornecida` varchar(18) DEFAULT NULL,
  `grupotensao` varchar(2) DEFAULT NULL,
  `nome_arquivo` varchar(20) DEFAULT NULL,
  `cod_digital_registro` varchar(32) DEFAULT NULL,
  `situacao` varchar(1) DEFAULT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `ordemservicos`
-- ----------------------------
DROP TABLE IF EXISTS `ordemservicos`;
CREATE TABLE `ordemservicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(16) DEFAULT NULL,
  `situacao` varchar(2) DEFAULT NULL,
  `cliente` varchar(11) DEFAULT NULL,
  `assinatura` varchar(11) DEFAULT NULL,
  `plano` varchar(11) DEFAULT NULL,
  `tecnico` varchar(11) DEFAULT NULL,
  `tipo` varchar(2) DEFAULT NULL,
  `emissao` varchar(16) DEFAULT NULL,
  `horaabertura` varchar(60) DEFAULT NULL,
  `orcamento` varchar(16) DEFAULT NULL,
  `aprovacao` varchar(16) DEFAULT NULL,
  `saida` varchar(16) DEFAULT NULL,
  `dataagendamento` varchar(60) DEFAULT NULL,
  `horaagendamento` varchar(60) DEFAULT NULL,
  `servico` varchar(255) DEFAULT NULL,
  `problema` longtext NOT NULL,
  `diagnostico` longtext NOT NULL,
  `solucao` longtext NOT NULL,
  `atendente` varchar(160) DEFAULT NULL,
  `tiposervico` varchar(2) DEFAULT NULL,
  `preco` varchar(11) DEFAULT NULL,
  `empresa` varchar(11) DEFAULT NULL,
  `serie` varchar(60) DEFAULT NULL,
  `encerrado` varchar(2) DEFAULT 'N',
  `status` varchar(2) DEFAULT 'S',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `permissoes`
-- ----------------------------
DROP TABLE IF EXISTS `permissoes`;
CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(11) DEFAULT NULL,
  `financeiro` varchar(2) DEFAULT 'N',
  `f1` varchar(2) DEFAULT 'N',
  `f2` varchar(2) DEFAULT 'N',
  `f3` varchar(2) DEFAULT 'N',
  `assinaturas` varchar(2) DEFAULT 'N',
  `a1` varchar(2) DEFAULT 'N',
  `a2` varchar(2) DEFAULT 'N',
  `faturas` varchar(2) DEFAULT 'N',
  `ft1` varchar(2) DEFAULT 'N',
  `ft2` varchar(2) DEFAULT 'N',
  `clientes` varchar(2) DEFAULT 'N',
  `c1` varchar(2) DEFAULT 'N',
  `c2` varchar(2) DEFAULT 'N',
  `tecnicos` varchar(2) DEFAULT 'N',
  `t1` varchar(2) DEFAULT 'N',
  `t2` varchar(2) DEFAULT 'N',
  `fornecedores` varchar(2) DEFAULT 'N',
  `fo1` varchar(2) DEFAULT 'N',
  `fo2` varchar(2) DEFAULT 'N',
  `ordemservico` varchar(2) DEFAULT 'N',
  `os1` varchar(2) DEFAULT 'N',
  `os2` varchar(2) DEFAULT 'N',
  `planos` varchar(2) DEFAULT 'N',
  `p1` varchar(2) DEFAULT 'N',
  `p2` varchar(2) DEFAULT 'N',
  `equipamentos` varchar(2) DEFAULT 'N',
  `e1` varchar(2) DEFAULT 'N',
  `e2` varchar(2) DEFAULT 'N',
  `ferramentas` varchar(2) DEFAULT 'N',
  `fr1` varchar(2) DEFAULT 'N',
  `fr2` varchar(2) DEFAULT 'N',
  `fr3` varchar(2) DEFAULT 'N',
  `fr4` varchar(2) DEFAULT 'N',
  `fr5` varchar(2) DEFAULT 'N',
  `fr6` varchar(2) DEFAULT 'N',
  `mikrotik` varchar(2) DEFAULT 'N',
  `mk1` varchar(2) DEFAULT 'N',
  `mk2` varchar(2) DEFAULT 'N',
  `mk3` varchar(2) DEFAULT 'N',
  `mk4` varchar(2) DEFAULT 'N',
  `mk5` varchar(2) DEFAULT 'N',
  `mk6` varchar(2) DEFAULT 'N',
  `mk7` varchar(2) DEFAULT 'N',
  `mk8` varchar(2) DEFAULT 'N',
  `mk9` varchar(2) DEFAULT 'N',
  `mk10` varchar(2) DEFAULT 'N',
  `cupons` varchar(2) DEFAULT 'N',
  `cu1` varchar(2) DEFAULT 'N',
  `cu2` varchar(2) DEFAULT 'N',
  `relatorios` varchar(2) DEFAULT 'N',
  `r1` varchar(2) DEFAULT 'N',
  `r2` varchar(2) DEFAULT 'N',
  `r3` varchar(2) DEFAULT 'N',
  `r4` varchar(2) DEFAULT 'N',
  `r5` varchar(2) DEFAULT 'N',
  `r6` varchar(2) DEFAULT 'N',
  `r7` varchar(2) DEFAULT 'N',
  `home` varchar(2) DEFAULT 'N',
  `codigo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `permissoes`
-- ----------------------------
BEGIN;
INSERT INTO `permissoes` VALUES
('1', '1', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S','S', '1'),
('2', '2', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S','S', '2');
COMMIT;

-- ----------------------------
--  Table structure for `planos`
-- ----------------------------
DROP TABLE IF EXISTS `planos`;
CREATE TABLE `planos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servidor` varchar(11) DEFAULT NULL,
  `tiposervidor` varchar(60) DEFAULT NULL,
  `empresa` varchar(11) DEFAULT NULL,
  `nome` varchar(160) DEFAULT NULL,
  `preco` varchar(11) DEFAULT NULL,
  `download` varchar(11) DEFAULT NULL,
  `upload` varchar(11) DEFAULT NULL,
  `pool` varchar(160) DEFAULT NULL,
  `addresslist` varchar(100) DEFAULT NULL,
  `simultaneous` varchar(10) DEFAULT NULL,
  `urladvertise` varchar(255) DEFAULT NULL,
  `advertiseintervalo` varchar(30) DEFAULT NULL,
  `maxsession` varchar(30) DEFAULT NULL,
  `policein` varchar(100) DEFAULT NULL,
  `policeout` varchar(100) DEFAULT NULL,
  `aviso` varchar(160) DEFAULT NULL,
  `tela` varchar(160) DEFAULT NULL,
  `pppoe` varchar(2) DEFAULT NULL,
  `hotspot` varchar(2) DEFAULT NULL,
  `interface` varchar(60) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `radacct`
-- ----------------------------
DROP TABLE IF EXISTS `radacct`;
CREATE TABLE `radacct` (
  `radacctid` bigint(21) NOT NULL AUTO_INCREMENT,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(15) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctsessiontime` int(12) DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(50) DEFAULT NULL,
  `connectinfo_stop` varchar(50) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `acctstartdelay` int(12) DEFAULT NULL,
  `acctstopdelay` int(12) DEFAULT NULL,
  `xascendsessionsvrkey` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`radacctid`),
  KEY `username` (`username`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `acctsessionid` (`acctsessionid`),
  KEY `acctsessiontime` (`acctsessiontime`),
  KEY `acctuniqueid` (`acctuniqueid`),
  KEY `acctstarttime` (`acctstarttime`),
  KEY `acctstoptime` (`acctstoptime`),
  KEY `nasipaddress` (`nasipaddress`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radcheck`
-- ----------------------------
DROP TABLE IF EXISTS `radcheck`;
CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  `pedido` varchar(60) DEFAULT NULL,
  `obs` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radgroupcheck`
-- ----------------------------
DROP TABLE IF EXISTS `radgroupcheck`;
CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  `idplanoerpmk` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radgroupreply`
-- ----------------------------
DROP TABLE IF EXISTS `radgroupreply`;
CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  `idplanoerpmk` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radippool`
-- ----------------------------
DROP TABLE IF EXISTS `radippool`;
CREATE TABLE `radippool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pool_name` varchar(30) NOT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `calledstationid` varchar(30) NOT NULL,
  `callingstationid` varchar(30) NOT NULL,
  `expiry_time` datetime DEFAULT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pool_key` varchar(30) NOT NULL,
  `pedido` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `radippool_poolname_expire` (`pool_name`,`expiry_time`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `radippool_nasip_poolkey_ipaddress` (`nasipaddress`,`pool_key`,`framedipaddress`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radpostauth`
-- ----------------------------
DROP TABLE IF EXISTS `radpostauth`;
CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radreply`
-- ----------------------------
DROP TABLE IF EXISTS `radreply`;
CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  `pedido` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `radusergroup`
-- ----------------------------
DROP TABLE IF EXISTS `radusergroup`;
CREATE TABLE `radusergroup` (
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '1',
  `pedido` varchar(60) DEFAULT NULL,
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `retornos`
-- ----------------------------
DROP TABLE IF EXISTS `retornos`;
CREATE TABLE `retornos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `juros` float DEFAULT NULL,
  `codigo` int(26) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `dataefetivacao` varchar(26) DEFAULT NULL,
  `dataocorrencia` varchar(26) DEFAULT NULL,
  `datavencimento` varchar(25) DEFAULT NULL,
  `dataprocessado` varchar(26) DEFAULT NULL,
  `horaprocessado` varchar(16) DEFAULT NULL,
  `admin` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `scripts`
-- ----------------------------
DROP TABLE IF EXISTS `scripts`;
CREATE TABLE `scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(11) DEFAULT NULL,
  `nome` varchar(160) DEFAULT NULL,
  `obs` varchar(160) DEFAULT NULL,
  `script` longtext,
  `p1` varchar(80) DEFAULT NULL,
  `p2` varchar(80) DEFAULT NULL,
  `p3` varchar(80) DEFAULT NULL,
  `p4` varchar(80) DEFAULT NULL,
  `p5` varchar(80) DEFAULT NULL,
  `p6` varchar(80) DEFAULT NULL,
  `p7` varchar(80) DEFAULT NULL,
  `p8` varchar(80) DEFAULT NULL,
  `p9` varchar(80) DEFAULT NULL,
  `p10` varchar(80) DEFAULT NULL,
  `p11` varchar(80) DEFAULT NULL,
  `p12` varchar(80) DEFAULT NULL,
  `ows` varchar(160) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `scripts`
-- ----------------------------
BEGIN;
INSERT INTO `scripts` VALUES ('1', '1', 'AutoMac_HotSpot', 'Captura Automaticamente MAC do Cliente no Primeiro Acesso', ':foreach h in=[/ip hotspot active find] do={:global address [/ ip hotspot active get $h address];:global user [/ip hotspot active get $h user];:global mac [/ip (+)', 'ftp,', 'reboot,', 'read,', 'write,', 'policy,', 'test,', 'winbox,', 'password,', 'sniff,', 'sensitive,', 'romon,', 'dude,', '');
COMMIT;

-- ----------------------------
--  Table structure for `servidores`
-- ----------------------------
DROP TABLE IF EXISTS `servidores`;
CREATE TABLE `servidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(11) DEFAULT NULL,
  `servidor` varchar(160) DEFAULT NULL,
  `ip` varchar(60) DEFAULT NULL,
  `porta` varchar(60) DEFAULT NULL,
  `login` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `secret` varchar(60) DEFAULT NULL,
  `tipo` varchar(160) DEFAULT NULL,
  `lat` varchar(26) DEFAULT NULL,
  `lng` varchar(26) DEFAULT NULL,
  `interface` varchar(60) DEFAULT NULL,
  `tiporouter` varchar(30) DEFAULT NULL,
  `portaftp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sici`
-- ----------------------------
DROP TABLE IF EXISTS `sici`;
CREATE TABLE `sici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(11) DEFAULT NULL,
  `ano` varchar(60) DEFAULT NULL,
  `mes` varchar(60) DEFAULT NULL,
  `outorga` varchar(60) DEFAULT NULL,
  `num_cat` varchar(60) DEFAULT NULL,
  `ipl1a` varchar(60) DEFAULT NULL,
  `ipl1b` varchar(60) DEFAULT NULL,
  `ipl1c` varchar(60) DEFAULT NULL,
  `ipl1d` varchar(60) DEFAULT NULL,
  `ipl2a` varchar(60) DEFAULT NULL,
  `ipl2b` varchar(60) DEFAULT NULL,
  `ipl2c` varchar(60) DEFAULT NULL,
  `ipl2d` varchar(60) DEFAULT NULL,
  `ipl3codm` varchar(60) DEFAULT NULL,
  `ipl3pf` varchar(60) DEFAULT NULL,
  `ipl3pj` varchar(60) DEFAULT NULL,
  `ipl6imcodm` varchar(60) DEFAULT NULL,
  `ipl6imvalor` varchar(60) DEFAULT NULL,
  `iem1avalor` varchar(60) DEFAULT NULL,
  `iem1bvalor` varchar(60) DEFAULT NULL,
  `iem1cvalor` varchar(60) DEFAULT NULL,
  `iem1dvalor` varchar(60) DEFAULT NULL,
  `iem1evalor` varchar(60) DEFAULT NULL,
  `iem1fvalor` varchar(60) DEFAULT NULL,
  `iem1gvalor` varchar(60) DEFAULT NULL,
  `iem2avalor` varchar(60) DEFAULT NULL,
  `iem2bvalor` varchar(60) DEFAULT NULL,
  `iem2cvalor` varchar(60) DEFAULT NULL,
  `iem3avalor` varchar(60) DEFAULT NULL,
  `iem4auf` varchar(60) DEFAULT NULL,
  `iem4avalor` varchar(60) DEFAULT NULL,
  `iem5auf` varchar(60) DEFAULT NULL,
  `iem5avalor` varchar(60) DEFAULT NULL,
  `iem6avalor` varchar(60) DEFAULT NULL,
  `iem7avalor` varchar(60) DEFAULT NULL,
  `iem8avalor` varchar(60) DEFAULT NULL,
  `iem8bvalor` varchar(60) DEFAULT NULL,
  `iem8cvalor` varchar(60) DEFAULT NULL,
  `iem8dvalor` varchar(60) DEFAULT NULL,
  `iem8evalor` varchar(60) DEFAULT NULL,
  `iem9fauf` varchar(60) DEFAULT NULL,
  `iem9favalor` varchar(60) DEFAULT NULL,
  `iem9jauf` varchar(60) DEFAULT NULL,
  `iem9javalor` varchar(60) DEFAULT NULL,
  `iem9fbuf` varchar(60) DEFAULT NULL,
  `iem9fbvalor` varchar(60) DEFAULT NULL,
  `iem9jbuf` varchar(60) DEFAULT NULL,
  `iem9jbvalor` varchar(60) DEFAULT NULL,
  `iem9fcuf` varchar(60) DEFAULT NULL,
  `iem9fcvalor` varchar(60) DEFAULT NULL,
  `iem9jcuf` varchar(60) DEFAULT NULL,
  `iem9jcvalor` varchar(60) DEFAULT NULL,
  `iem9fduf` varchar(60) DEFAULT NULL,
  `iem9fdvalor` varchar(60) DEFAULT NULL,
  `iem9jduf` varchar(60) DEFAULT NULL,
  `iem9jdvalor` varchar(60) DEFAULT NULL,
  `iem9feuf` varchar(60) DEFAULT NULL,
  `iem9fevalor` varchar(60) DEFAULT NULL,
  `iem9jeuf` varchar(60) DEFAULT NULL,
  `iem9jevalor` varchar(60) DEFAULT NULL,
  `iem10fauf` varchar(60) DEFAULT NULL,
  `iem10favalor` varchar(60) DEFAULT NULL,
  `iem10jauf` varchar(60) DEFAULT NULL,
  `iem10javalor` varchar(60) DEFAULT NULL,
  `iem10fbuf` varchar(60) DEFAULT NULL,
  `iem10fbvalor` varchar(60) DEFAULT NULL,
  `iem10jbuf` varchar(60) DEFAULT NULL,
  `iem10jbvalor` varchar(60) DEFAULT NULL,
  `iem10fcuf` varchar(60) DEFAULT NULL,
  `iem10fcvalor` varchar(60) DEFAULT NULL,
  `iem10jcuf` varchar(60) DEFAULT NULL,
  `iem10jcvalor` varchar(60) DEFAULT NULL,
  `iem10fduf` varchar(60) DEFAULT NULL,
  `iem10fdvalor` varchar(60) DEFAULT NULL,
  `iem10jduf` varchar(60) DEFAULT NULL,
  `iem10jdvalor` varchar(60) DEFAULT NULL,
  `qaipl4smmqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smmtotal` varchar(60) DEFAULT NULL,
  `qaipl4smm15` varchar(60) DEFAULT NULL,
  `qaipl4smm16` varchar(60) DEFAULT NULL,
  `qaipl4smm17` varchar(60) DEFAULT NULL,
  `qaipl4smm18` varchar(60) DEFAULT NULL,
  `qaipl4smm19` varchar(60) DEFAULT NULL,
  `qaipl4smnqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smntotal` varchar(60) DEFAULT NULL,
  `qaipl4smn15` varchar(60) DEFAULT NULL,
  `qaipl4smn16` varchar(60) DEFAULT NULL,
  `qaipl4smn17` varchar(60) DEFAULT NULL,
  `qaipl4smn18` varchar(60) DEFAULT NULL,
  `qaipl4smn19` varchar(60) DEFAULT NULL,
  `qaipl4smoqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smototal` varchar(60) DEFAULT NULL,
  `qaipl4smo15` varchar(60) DEFAULT NULL,
  `qaipl4smo16` varchar(60) DEFAULT NULL,
  `qaipl4smo17` varchar(60) DEFAULT NULL,
  `qaipl4smo18` varchar(60) DEFAULT NULL,
  `qaipl4smo19` varchar(60) DEFAULT NULL,
  `qaipl4smcodm` varchar(60) DEFAULT NULL,
  `qaipl4smaqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smatotal` varchar(60) DEFAULT NULL,
  `qaipl4sma15` varchar(60) DEFAULT NULL,
  `qaipl4sma16` varchar(60) DEFAULT NULL,
  `qaipl4sma17` varchar(60) DEFAULT NULL,
  `qaipl4sma18` varchar(60) DEFAULT NULL,
  `qaipl4sma19` varchar(60) DEFAULT NULL,
  `qaipl4smbqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smbtotal` varchar(60) DEFAULT NULL,
  `qaipl4smb15` varchar(60) DEFAULT NULL,
  `qaipl4smb16` varchar(60) DEFAULT NULL,
  `qaipl4smb17` varchar(60) DEFAULT NULL,
  `qaipl4smb18` varchar(60) DEFAULT NULL,
  `qaipl4smcqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smctotal` varchar(60) DEFAULT NULL,
  `qaipl4smc15` varchar(60) DEFAULT NULL,
  `qaipl4smc16` varchar(60) DEFAULT NULL,
  `qaipl4smc17` varchar(60) DEFAULT NULL,
  `qaipl4smc18` varchar(60) DEFAULT NULL,
  `qaipl4smc19` varchar(60) DEFAULT NULL,
  `qaipl4smdqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smdtotal` varchar(60) DEFAULT NULL,
  `qaipl4smd15` varchar(60) DEFAULT NULL,
  `qaipl4smd16` varchar(60) DEFAULT NULL,
  `qaipl4smd17` varchar(60) DEFAULT NULL,
  `qaipl4smd18` varchar(60) DEFAULT NULL,
  `qaipl4smd19` varchar(60) DEFAULT NULL,
  `qaipl4smeqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smetotal` varchar(60) DEFAULT NULL,
  `qaipl4sme15` varchar(60) DEFAULT NULL,
  `qaipl4sme16` varchar(60) DEFAULT NULL,
  `qaipl4sme17` varchar(60) DEFAULT NULL,
  `qaipl4sme18` varchar(60) DEFAULT NULL,
  `qaipl4sme19` varchar(60) DEFAULT NULL,
  `qaipl4smfqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smftotal` varchar(60) DEFAULT NULL,
  `qaipl4smf15` varchar(60) DEFAULT NULL,
  `qaipl4smf16` varchar(60) DEFAULT NULL,
  `qaipl4smf17` varchar(60) DEFAULT NULL,
  `qaipl4smf18` varchar(60) DEFAULT NULL,
  `qaipl4smf19` varchar(60) DEFAULT NULL,
  `qaipl4smgqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smgtotal` varchar(60) DEFAULT NULL,
  `qaipl4smg15` varchar(60) DEFAULT NULL,
  `qaipl4smg16` varchar(60) DEFAULT NULL,
  `qaipl4smg17` varchar(60) DEFAULT NULL,
  `qaipl4smg18` varchar(60) DEFAULT NULL,
  `qaipl4smg19` varchar(60) DEFAULT NULL,
  `qaipl4smhqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smhtotal` varchar(60) DEFAULT NULL,
  `qaipl4smh15` varchar(60) DEFAULT NULL,
  `qaipl4smh16` varchar(60) DEFAULT NULL,
  `qaipl4smh17` varchar(60) DEFAULT NULL,
  `qaipl4smh18` varchar(60) DEFAULT NULL,
  `qaipl4smh19` varchar(60) DEFAULT NULL,
  `qaipl4smiqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smitotal` varchar(60) DEFAULT NULL,
  `qaipl4smi15` varchar(60) DEFAULT NULL,
  `qaipl4smi16` varchar(60) DEFAULT NULL,
  `qaipl4smi17` varchar(60) DEFAULT NULL,
  `qaipl4smi18` varchar(60) DEFAULT NULL,
  `qaipl4smi19` varchar(60) DEFAULT NULL,
  `qaipl4smjqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smjtotal` varchar(60) DEFAULT NULL,
  `qaipl4smj15` varchar(60) DEFAULT NULL,
  `qaipl4smj16` varchar(60) DEFAULT NULL,
  `qaipl4smj17` varchar(60) DEFAULT NULL,
  `qaipl4smj18` varchar(60) DEFAULT NULL,
  `qaipl4smj19` varchar(60) DEFAULT NULL,
  `qaipl4smkqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smktotal` varchar(60) DEFAULT NULL,
  `qaipl4smk15` varchar(60) DEFAULT NULL,
  `qaipl4smk16` varchar(60) DEFAULT NULL,
  `qaipl4smk17` varchar(60) DEFAULT NULL,
  `qaipl4smk18` varchar(60) DEFAULT NULL,
  `qaipl4smk19` varchar(60) DEFAULT NULL,
  `qaipl4smlqaipl5sm` varchar(60) DEFAULT NULL,
  `qaipl4smltotal` varchar(60) DEFAULT NULL,
  `qaipl4sml15` varchar(60) DEFAULT NULL,
  `qaipl4sml16` varchar(60) DEFAULT NULL,
  `qaipl4sml17` varchar(60) DEFAULT NULL,
  `qaipl4sml18` varchar(60) DEFAULT NULL,
  `qaipl4sml19` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `tecnicos`
-- ----------------------------
DROP TABLE IF EXISTS `tecnicos`;
CREATE TABLE `tecnicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(16) DEFAULT NULL,
  `empresa` varchar(11) DEFAULT NULL,
  `nome` varchar(160) DEFAULT NULL,
  `cargo` varchar(160) DEFAULT NULL,
  `admissao` varchar(60) DEFAULT NULL,
  `horario` varchar(60) DEFAULT NULL,
  `hextra` varchar(2) DEFAULT NULL,
  `ctps` varchar(60) DEFAULT NULL,
  `serie` varchar(60) DEFAULT NULL,
  `salario` varchar(60) DEFAULT NULL,
  `pis` varchar(60) DEFAULT NULL,
  `cnh` varchar(160) DEFAULT NULL,
  `login` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `nivel` varchar(1) DEFAULT NULL,
  `grupomk` varchar(60) DEFAULT NULL,
  `cpf` varchar(60) DEFAULT NULL,
  `rg` varchar(60) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `cel` varchar(60) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nascimento` varchar(60) DEFAULT NULL,
  `endereco` varchar(160) DEFAULT NULL,
  `numero` varchar(11) DEFAULT NULL,
  `complemento` varchar(60) DEFAULT NULL,
  `bairro` varchar(60) DEFAULT NULL,
  `cidade` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `cep` varchar(36) DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(160) DEFAULT NULL,
  `codigo` varchar(60) DEFAULT NULL,
  `empresa` varchar(11) DEFAULT NULL,
  `login` varchar(60) DEFAULT NULL,
  `senha` varchar(60) DEFAULT NULL,
  `salt` varchar(160) DEFAULT NULL,
  `email` varchar(160) DEFAULT NULL,
  `nivel` varchar(11) DEFAULT NULL,
  `status` varchar(2) DEFAULT 'S',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `usuarios`
-- ----------------------------
BEGIN;
INSERT INTO `usuarios` VALUES
('1', 'Administrador', '199283', null, 'admin', '202cb962ac59075b964b07152d234b70', 'MTIz', 'email@provedor.com.br', '1', 'S'),
('2', 'MyRouter', '2', NULL, 'myrouter', '7f77bcdf5596fdadb002183b4b2942dc', 'MzMjQG15cm91dGVyQCMzMw==', 'contato@myrouter.com.br', '1', 'S');
COMMIT;

-- ----------------------------
--  Table structure for `fib_conf`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `fib_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partida` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `zoom` int(11) NOT NULL,
  `maxzoom` int(11) NOT NULL,
  `minzoom` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- ----------------------------
--  Records of `fib_conf`
-- ----------------------------

INSERT INTO `fib_conf` (`id`, `partida`, `lat`, `longitude`, `zoom`, `maxzoom`, `minzoom`) VALUES
(1, 'CIDADE', '-15.960796', '-48.032770', '13', '20', '5');

-- ----------------------------
--  Table structure for `fib_elementos`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `fib_elementos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` int(11) NOT NULL,
  `id_no` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `lat` varchar(25) NOT NULL,
  `lon` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- ----------------------------
--  Table structure for `fib_no`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `fib_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` int(11) NOT NULL,
  `desc_ponto` varchar(255) NOT NULL,
  `cor` varchar(25) NOT NULL,
  `esplinha` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- ----------------------------
-- Estrutura da tabela `fib_markers`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `fib_markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- ----------------------------
--  Procedure structure for `checa_pendencias`
-- ----------------------------
DROP PROCEDURE IF EXISTS `checa_pendencias`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `checa_pendencias`(login VARCHAR(64))
    SQL SECURITY INVOKER
BEGIN

    declare sit varchar(1);

    select distinct myrouter.financeiro.situacao INTO sit
    from   myrouter.financeiro
    left join  myrouter.radcheck on (myrouter.radcheck.pedido = myrouter.financeiro.pedido)
    where radcheck.username           = login
    and   myrouter.financeiro.situacao = 'B';

    if (sit = 'B') then
        select distinct 'aviso_permanente';
    else
        select distinct 'aviso_temporario'
        from financeiro
        join  myrouter.radcheck on (myrouter.radcheck.pedido = myrouter.financeiro.pedido)
        where myrouter.radcheck.username = login
          and myrouter.financeiro.status   = 'A'
          and myrouter.financeiro.situacao = 'N'
          and myrouter.financeiro.vencimento  <= date_add(curdate(), interval - 2 day) ;
    end if;

END
 ;;
delimiter ;

-- ----------------------------
--  Procedure structure for `postauth`
-- ----------------------------
DROP PROCEDURE IF EXISTS `postauth`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `postauth`(username VARCHAR(64), macaddress VARCHAR(17))
  BEGIN
    DECLARE existe INT;
    DECLARE num_pedido VARCHAR(10);

    SELECT myrouter.assinaturas.pedido INTO num_pedido FROM myrouter.assinaturas WHERE login = username;

    SELECT count(*) INTO existe FROM radcheck WHERE radcheck.username=username AND attribute='Calling-Station-Id';
    IF NOT existe THEN
      INSERT INTO radcheck (username, attribute, op, value, pedido, obs)
        SELECT DISTINCT radcheck.username, 'Calling-Station-Id', '==', macaddress, num_pedido, 'mac-auto'
        FROM radcheck WHERE radcheck.username=username and attribute='MD5-Password';

      UPDATE myrouter.assinaturas SET mac = macaddress WHERE myrouter.assinaturas.pedido = num_pedido;
    END IF;
  END
;;
delimiter ;

-- ----------------------------
--  Function structure for `pega_recv`
-- ----------------------------
DROP FUNCTION IF EXISTS `pega_recv`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pega_recv`(`login` VARCHAR(250), `quota` BIGINT) RETURNS varchar(250) CHARSET latin1
    READS SQL DATA
BEGIN
  declare soma BIGINT;


  select ifnull(sum(acctinputoctets), 0) from radacct
  where (username=login) and (acctstoptime like concat(substr(curdate(),1,7),'-%')) into @soma;

  if @soma <= quota then
    return (quota - @soma) & 4294967295;
  else
    return '0';
  end if;
END
 ;;
delimiter ;

-- ----------------------------
--  Function structure for `pega_recv_giga`
-- ----------------------------
DROP FUNCTION IF EXISTS `pega_recv_giga`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pega_recv_giga`(`login` VARCHAR(250), `quota` BIGINT) RETURNS varchar(250) CHARSET latin1
    READS SQL DATA
BEGIN
  declare soma BIGINT;


  select ifnull(sum(acctinputoctets), 0) from radacct
  where (username=login) and (acctstoptime like concat(substr(curdate(),1,7),'-%')) into @soma;

  if @soma <= quota then
    return (quota - @soma) >> 32;
  else
    return '0';
  end if;
END
 ;;
delimiter ;

-- ----------------------------
--  Function structure for `pega_taxa`
-- ----------------------------
DROP FUNCTION IF EXISTS `pega_taxa`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pega_taxa`(`rate1` VARCHAR(250), `rate2` VARCHAR(250), `login` VARCHAR(250), `quota` BIGINT) RETURNS varchar(250) CHARSET latin1
    READS SQL DATA
BEGIN
  declare soma BIGINT;


  select ifnull(sum(acctoutputoctets), 0) from radacct
  where (username=login) and (acctstoptime like concat(substr(curdate(),1,7),'-%')) into @soma;

  if @soma <= quota then
    return rate1;
  else
    return rate2;
  end if;
END
 ;;
delimiter ;

-- ----------------------------
--  Function structure for `pega_xmit`
-- ----------------------------
DROP FUNCTION IF EXISTS `pega_xmit`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pega_xmit`(`login` VARCHAR(250), `quota` BIGINT) RETURNS varchar(250) CHARSET latin1
    READS SQL DATA
BEGIN
  declare soma BIGINT;


  select ifnull(sum(acctoutputoctets), 0) from radacct
  where (username=login) and (acctstoptime like concat(substr(curdate(),1,7),'-%')) into @soma;

  if @soma <= quota then
    return (quota - @soma) & 4294967295;
  else
    return '0';
  end if;
END
 ;;
delimiter ;

-- ----------------------------
--  Function structure for `pega_xmit_giga`
-- ----------------------------
DROP FUNCTION IF EXISTS `pega_xmit_giga`;
delimiter ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `pega_xmit_giga`(`login` VARCHAR(250), `quota` BIGINT) RETURNS varchar(250) CHARSET latin1
    READS SQL DATA
BEGIN
  declare soma BIGINT;


  select ifnull(sum(acctoutputoctets), 0) from radacct
  where (username=login) and (acctstoptime like concat(substr(curdate(),1,7),'-%')) into @soma;

  if @soma <= quota then
    return (quota - @soma) >> 32;
  else
    return '0';
  end if;
END
 ;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
