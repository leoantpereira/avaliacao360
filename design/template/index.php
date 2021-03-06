<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Avaliação de desempenho 360º</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/estilo.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" id="cabecalho">
                <div class="col-xs-4" id="logo">AVALIAÇÃO 360º</div>
                <div class="col-xs-8" id="menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#criador">Criador</a></li>
                                    <li><a href="#como-funciona">Como funciona?</a></li>
                                    <li><a href="#contato">Contato</a></li>
                                    <li><a href="#cadastre-se">Cadastre-se</a></li>
                                    <li><a href="login.php">Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row" id="slide">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="./img/slide01.jpg" alt="...">
                            <div class="carousel-caption">
                            </div>
                        </div>
                        <div class="item">
                            <img src="./img/slide02.jpg" alt="...">
                            <div class="carousel-caption">
                            </div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="row" id="conteudo">
                <div class="col-xs-12" id="criador">
                    <h1 class="text-center">Criador</h1>
                    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de 
                        impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido 
                        pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. 
                        Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração 
                        eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, 
                        quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente 
                        quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
                    </p>
                </div>
                <div class="col-xs-12" id="como-funciona">
                    <h1 class="text-center">Como funciona?</h1>   
                    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de 
                        impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido 
                        pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. 
                        Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração 
                        eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, 
                        quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente 
                        quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
                    </p>
                </div>
                <div class="col-xs-12" id="contato">
                    <h1 class="text-center">Contato</h1>
                    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de 
                        impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido 
                        pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. 
                        Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração 
                        eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, 
                        quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente 
                        quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
                    </p>
                </div>
                <div class="col-xs-12" id="cadastre-se">
                    <h1 class="text-center">Cadastre-se</h1>
                    <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de 
                        impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido 
                        pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. 
                        Lorem Ipsum sobreviveu não só a cinco séculos, como também ao salto para a editoração 
                        eletrônica, permanecendo essencialmente inalterado. Se popularizou na década de 60, 
                        quando a Letraset lançou decalques contendo passagens de Lorem Ipsum, e mais recentemente 
                        quando passou a ser integrado a softwares de editoração eletrônica como Aldus PageMaker.
                    </p>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>