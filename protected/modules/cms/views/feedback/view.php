<?php$this->breadcrumbs=array(	'留言反馈'=>array('index'),	$model->Name,);$this->menu=array(	array('label'=>'回复留言', 'icon'=>'pencil','url'=>array('update', 'id'=>$model->ID)),	array('label'=>'删除留言', 'icon'=>'trash', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),	array('label'=>'管理留言', 'icon'=>'cog','url'=>array('admin')),);?><h1>查看留言 #<?php echo $model->id; ?></h1><?php $this->widget('bootstrap.widgets.TbDetailView', array(	'data'=>$model,	'attributes'=>array(		'ID',		'Name',		'Tel',		'Email',		'Content',		'Reply',		'CreateTime',		'UpdateTime',	),)); ?>