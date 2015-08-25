<?php
/* @var $this Controller */
Yii::app()->clientScript->registerCssFile('css/main.css');
?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
    <div id="content">
<?php echo $content; ?>
    </div><!-- content -->
</div>
<div class="span-5 last">
    <div id="sidebar">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => 'Menu',
        ));
        $this->widget('booster.widgets.TbMenu', array(
            'items' => $this->menu,
            'htmlOptions' => array('class' => 'operations'),
        ));
        $this->endWidget();
        ?>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>