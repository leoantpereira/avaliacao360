<?php
$this->breadcrumbs = array(
    'Questionários',
);

$this->menu = array(
    array('label' => 'Create Questionario', 'url' => array('create')),
    array('label' => 'Manage Questionario', 'url' => array('admin')),
);
?>

<h1>Questionários</h1>

<?php
$this->widget('booster.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));
?>
