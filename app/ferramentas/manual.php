
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.php?app=Dashboard">Dashboard</a></li>
            <li><a href="">Ferramentas</a></li>
            <li class="active">Regras</li>
          </ul>
        </div>
        
        
        
        <div class="page-header">
          <h1>Ferramentas <small>Dicas de Regras</small></h1>
        </div>
        
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid"> 
            
             <div class="powerwidget orange" id="most-form-elements" data-widget-editbutton="false">
              <header>
                <h2>Dicas<small> Regras Para Firewall</small></h2>
              </header>
              <div class="inner-spacer">
            
          <h3>Bloquear acesso externo ao proxy e ao DNS</h3>
	  
	  <div class="highlight"><pre><code class="language-css" data-lang="css">/ip firewall filter
add chain=input in-interface=”wan” protocol=tcp dst-port=3128 action=drop comment=”Bloqueia Acesso Externo Proxy” disabled=no
add chain=input in-interface=”wan” protocol=tcp dst-port=53 action=drop comment=”Bloqueia Acesso Externo ao DNS” disabled=no</code></pre></div> No nosso exemplo a porta definida para o proxy é a "3128" caso utilize uma porta diferente altere a regra.
           <hr>
       
       <h3>Script automático para regras de conexão simultânea</h3>
	  
	  <div class="highlight"><pre><code class="language-css" data-lang="css">/ip firewall filter
: for i from=2 to=254 do={ add chain=forward src-address=(“192.168.0.” . $i) protocol=tcp tcp-flags=syn connection-limit=30,32 action=drop comment=”Controle de conexoes simultaneas”}</code></pre></div> Esse script gera as regras para controle de conexões simultâneas para cada IP começando no IP 192.168.0.2 até o IP 192.168.0.254, você pode alterar a faixa de IP’s caso utilize uma faixa diferente:
           <hr>
       
       
       <h3>Bloquear todas as portas</h3>
	  
	  <div class="highlight"><pre><code class="language-css" data-lang="css">/ip firewall filter
add chain=forward protocol=tcp dst-port=0-65535 action=drop comment=”Bloqueio geral” disabled=no</code></pre></div> Essa dica é para quem deseja bloquear todas as portas da 0 a 65535, ela pode ser utilizada em conjunto com outras regras que liberam acesso a algumas portas e em seguida ela bloqueia todas as outras que não foram liberadas:
           <hr>
       
       
      <h3>Bloqueio ASK Toolbar, FunMods, Iminent, 22Find, Baidu, PC Reformer</h3>
	  
	  <div class="highlight"><pre><code class="language-css" data-lang="css">/ip firewall filter add chain=output dst-address=180.76.2.25 action=drop comment=BAIDU /ip firewall filter add chain=output dst-address=220.181.111.86 action=drop /ip firewall filter add chain=output dst-address=46.28.209.15 action=drop comment=PC-PERFORMER-DRIVER-SCANNER /ip firewall filter add chain=output dst-address=96.45.82.5 action=drop /ip firewall filter add chain=output dst-address=208.94.116.112 action=drop comment=DEALPLY /ip firewall filter add chain=output dst-address=66.77.197.179 action=drop comment=DELTA-TOOL-BAR /ip firewall filter add chain=output dst-address=69.28.58.74 action=drop comment=22FIND /ip firewall filter add chain=output dst-address=95.130.75.74 action=drop comment=IMINENT /ip firewall filter add chain=output dst-address=50.23.103.20 action=drop comment=FUNMOODS /ip firewall filter add chain=output dst-address=173.255.138.100 action=drop /ip firewall filter add chain=output dst-address=174.37.174.84 action=drop /ip firewall filter add chain=output dst-address=174.127.102.228 action=drop /ip firewall filter add chain=output dst-address=66.235.120.127 action=drop comment=ASK-TOOL-BAR</code></pre></div> 
           <hr> 
       
       
   
            
             </div>
        </div> 
      </div>