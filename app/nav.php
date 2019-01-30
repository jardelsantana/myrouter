 <!--<a class="navbar-brand" href="dashboard"> -->
 <a class="navbar-brand" href="index.php">
    <span class="text-red">MyRouter</span></a>

      <div class="site-search">
        <form action="#" id="inline-search">
          <i class="fa fa-search"></i>
          <input type="search" placeholder="Pesquisar">
        </form>
      </div>

      
      <div class="navbar-content">

          <!--Sidebar Toggler-->
          <a href="#" class="btn btn-default left-toggler"><i class="fa fa-bars"></i></a>

          <!--Right Userbar Toggler-->
          <a href="#" class="btn btn-user right-toggler pull-right"><i class="entypo-vcard"></i> <span class="logged-as hidden-xs">Logged as</span><span class="logged-as-name hidden-xs">Anton Durant</span></a>
          <!--Fullscreen Trigger-->
          <button type="button" class="btn btn-default hidden-xs pull-right" id="toggle-fullscreen"> <i class=" entypo-popup"></i> </button>


          <a href="app/sair.php" class="btn btn-default hidden-xs pull-right"> <i class="entypo-lock"></i> </a>

        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <i class="entypo-megaphone"></i><span class="new"></span></button>
          <div id="notification-dropdown" class="dropdown-menu">
            <div class="dropdown-header">Notificações <span class="badge pull-right">0</span></div>
            <div class="dropdown-container">
              <div class="nano">
                <div class="nano-content">

                    <script>
                        var Requisitar = function(){
                            $.post('app/notificacao.php', function(data) {
                                $('.result').html(data);
                                setTimeout(function(){ Requisitar(); },100000);//1000=a um segundo, altere conforme o necessario
                            });
                        };
                        Requisitar();//Dispara
                    </script>
                    <div class="result">Aguarde...</div>

                </div>
              </div>
            </div>
            <div class="dropdown-footer"><a class="btn btn-dark" href="#">Ver Todas</a></div>
          </div>

            <!--Inbox Dropdown-->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="entypo-mail"></i><span class="new"></span></button>
                <div id="inbox-dropdown" class="dropdown-menu inbox">
                    <div class="dropdown-header">Mensagem<span class="badge pull-right">0</span></div>
                    <div class="dropdown-container">
                        <div class="nano">
                            <div class="nano-content">
                                <ul class="inbox-dropdown">


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer"><a class="btn btn-dark" href="#">Ver Todas</a></div>
                </div>
            </div>
        </div>
        </div>

