<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/estilo.css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div class="container-fluid" id="page">
            <div class="row" id="cabecalho">
                <div class="col-xs-4" id="logo">AVALIAÇÃO 360º</div>
                <div class="col-xs-8" id="menu">
                    <?php
                    $this->widget(
                            'booster.widgets.TbNavbar', array(
                        'brand' => '',
                        'fixed' => false,
                        'fluid' => true,
                        'items' => array(
                            array(
                                'class' => 'booster.widgets.TbMenu',
                                'type' => 'navbar',
                                'items' => array(
                                    array(
                                        'label' => 'Criador',
                                        'url' => Yii::app()->createUrl('#criador'),
                                        'visible' => true,
                                    ),
                                    array(
                                        'label' => 'Como funciona?',
                                        'url' => Yii::app()->createUrl('#como-funciona'),
                                        'visible' => true,
                                    ),
                                    array(
                                        'label' => 'Contato',
                                        'url' => Yii::app()->createUrl('#contato'),
                                        'visible' => true,
                                    ),
                                    array(
                                        'label' => 'Cadastre-se',
                                        'url' => Yii::app()->createUrl('#cadastre-se'),
                                        'visible' => true,
                                    ),
                                    array(
                                        'label' => 'Login',
                                        'url' => Yii::app()->createUrl('site/login'),
                                        'visible' => true,
                                    ),
                                )
                            )
                        )
                            )
                    );
                    ?>
                </div><!-- menu -->
            </div>

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('booster.widgets.TbBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => 'Início'
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <footer>
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
                <?php echo Yii::powered(); ?>
            </footer>
        </div>
    </body>
</html>
