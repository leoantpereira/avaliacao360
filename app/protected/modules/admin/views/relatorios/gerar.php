<h1>Questionário: <small><?php echo $questionario->descricao . "<br>"; ?></small></h1><br/>

<?php
$i = 1;
foreach ($questoes as $q) {
    ?>
    <h3>Questão <?php echo $i; ?>: <small><?php echo $q->pergunta; ?></small></h3>
    <?php
    $i++;
}
?>
<div>
    <div id="page-wrapper">
        <div class="container-fluid">      
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Gráfico de respostas ao questionário</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                            <div class="text-right">
                                <a href="#">Visualizar detalhes<i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<!-- Morris Charts JavaScript -->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/themes/sb-admin/plugins/morris/raphael.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/themes/sb-admin/plugins/morris/morris.min.js', CClientScript::POS_END); ?>