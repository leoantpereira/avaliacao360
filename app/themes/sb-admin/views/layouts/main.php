<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="leonardo">

        <title>Avaliação 360º - Área Administrativa</title>

        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/sb-admin/sb-admin.css" />

        <!-- Morris Charts CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/sb-admin/plugins/morris.css" />

        <!-- Custom Fonts -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/themes/sb-admin/font-awesome/font-awesome.min.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Avaliação 360º</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo Yii::app()->user->getName(); ?>  <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('admin/funcionario/perfil'); ?>"><i class="fa fa-fw fa-user"></i> Perfil</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Mensagens</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('admin/relatorios'); ?>"><i class="fa fa-fw fa-bar-chart-o"></i> Relatórios</a>
                        </li>
                        <li <?php if (!Yii::app()->authManager->checkAccess('viewAvaliacao', Yii::app()->user->id)) { ?> 
                            style="display: none;"
                            <?php } ?>>
                            <a href="javascript:;" data-toggle="collapse" data-target="#avaliacoes"><i class="fa fa-fw fa-table"></i> Avaliação de Desempenho<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="avaliacoes" class="collapse">
                                <li <?php if (!Yii::app()->authManager->checkAccess('createAvaliacao', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/avaliacao/create'); ?>">Cadastrar</a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('admin/avaliacao/admin'); ?>">Gerenciar</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if (!Yii::app()->authManager->checkAccess('viewQuestionario', Yii::app()->user->id)) { ?> 
                                style="display: none;"
                            <?php } ?>>
                            <a href="javascript:;" data-toggle="collapse" data-target="#questionarios"><i class="fa fa-fw fa-edit"></i> Questionários <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="questionarios" class="collapse">
                                <li <?php if (!Yii::app()->authManager->checkAccess('createQuestionario', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/questionario/create'); ?>">Cadastrar Questionário</a>
                                </li>
                                <li <?php if (!Yii::app()->authManager->checkAccess('createQuestao', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/questao/create'); ?>">Cadastrar Questão</a>
                                </li>
                                <li <?php if (!Yii::app()->authManager->checkAccess('responderQuestionario', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/questionario/escolher'); ?>">Responder Questionário</a>
                                </li>
                                <li <?php if (!Yii::app()->authManager->checkAccess('viewQuestionario', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/questionario/admin'); ?>">Gerenciar Questionários</a>
                                </li>
                                <li <?php if (!Yii::app()->authManager->checkAccess('adminQuestao', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/questao/admin'); ?>">Gerenciar Questões</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if (!Yii::app()->authManager->checkAccess('adminDepartamento', Yii::app()->user->id)) { ?> 
                                style="display: none;"
                            <?php } ?>>
                            <a href="javascript:;" data-toggle="collapse" data-target="#departamentos"><span class="fa fa-fw fa-wrench" aria-hidden="true"></span> Departamentos<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="departamentos" class="collapse">
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('admin/departamento/create'); ?>">Cadastrar</a>
                                </li>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('admin/departamento/admin'); ?>">Gerenciar</a>
                                </li>
                            </ul>
                        </li>
                        <li <?php if (!Yii::app()->authManager->checkAccess('viewFuncionario', Yii::app()->user->id)) { ?> 
                                style="display: none;"
                            <?php } ?>>
                            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Funcionários <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="demo" class="collapse">
                                <li <?php if (!Yii::app()->authManager->checkAccess('createFuncionario', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/funcionario/create'); ?>">Cadastrar</a>
                                </li>
                                <li <?php if (!Yii::app()->authManager->checkAccess('viewFuncionario', Yii::app()->user->id)) { ?> 
                                        style="display: none;"
                                    <?php } ?>>
                                    <a href="<?php echo Yii::app()->createUrl('admin/funcionario/admin'); ?>">Gerenciar</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">

                    <?php if (isset($this->breadcrumbs)): ?>
                        <?php
                        $this->widget('booster.widgets.TbBreadcrumbs', array(
                            'links' => $this->breadcrumbs,
                            'homeLink' => 'Início'
                        ));
                        ?><!-- breadcrumbs -->
                    <?php endif ?>

                    <?php echo $content; ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <!-- <script src="js/themes/sb-admin/jquery.js"></script> -->

        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="js/themes/sb-admin/bootstrap.min.js"></script> -->

        <!-- Morris Charts JavaScript -->
        <!-- <script src="js/themes/sb-admin/plugins/morris/raphael.min.js"></script> -->
        <!-- <script src="js/themes/sb-admin/plugins/morris/morris.min.js"></script> -->
        <!-- <script src="js/themes/sb-admin/plugins/morris/morris-data.js"></script> -->
    </body>

</html>
