<?php$this->breadcrumbs = array(    '单页' => array('index'),    $model->Title => array('view', 'id' => $model->ID),    '更新',);$this->menu = array(    array('label' => '创建单页', 'icon' => 'plus', 'url' => array('create')),    array('label' => '单页管理', 'icon'=>'cog','icon'=>'cog','url'=>array('admin')),);?><h1>更新单页 <?php echo $model->Title; ?></h1>    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>