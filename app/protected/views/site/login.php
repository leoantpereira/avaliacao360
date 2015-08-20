<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-4 col-lg-3 col-lg-offset-4">
                    <?php
                    $form = $this->beginWidget(
                            'booster.widgets.TbActiveForm', array(
                        'id' => 'verticalForm',
                        'htmlOptions' => array('class' => 'well'), // for inset effect
                            )
                    );

                    echo $form->textFieldGroup($model, 'email');
                    echo $form->passwordFieldGroup($model, 'senha');
                    echo $form->checkboxGroup($model, 'lembrarMe');
                    $this->widget(
                            'booster.widgets.TbButton', array('buttonType' => 'submit', 'label' => 'Login')
                    );

                    $this->endWidget();
                    unset($form);
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
