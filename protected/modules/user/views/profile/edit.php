<?php
$this->pageTitle = Yii::app()->name . ' - ' . UserModule::t("Profile");
$this->breadcrumbs = array(
    UserModule::t("Profile") => array('profile'),
    UserModule::t("Edit"),
);
$this->menu = array(
    ((UserModule::isAdmin()) ? array('label' => UserModule::t('Manage Users'), 'icon' => 'cog', 'url' => array('/user/admin')) : array()),
    array('label' => UserModule::t('List User'), 'icon' => 'list', 'url' => array('/user')),
    array('label' => UserModule::t('Profile'), 'icon' => 'user', 'url' => array('/user/profile')),
    array('label' => UserModule::t('Change password'), 'icon' => 'pencil', 'url' => array('changepassword')),
    array('label' => UserModule::t('Logout'), 'icon' => 'off', 'url' => array('/user/logout')),
);
?>

<h1 class='title title-dashed'><?php echo UserModule::t('Edit profile'); ?></h1>

<?php if (Yii::app()->user->hasFlash('profileMessage')): ?>
    <div class="successmessage">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
    </div>
<?php endif; ?>
<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
	'id' => 'profile-form',
	'enableAjaxValidation' => true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

    <?php echo $form->errorSummary(array($model, $profile)); ?>

    <?php
    $profileFields = Profile::getFields();
    if ($profileFields) {
	foreach ($profileFields as $field) {
	    ?>
	    <div class="row">
		<?php
		echo $form->labelEx($profile, $field->varname);

		if ($widgetEdit = $field->widgetEdit($profile)) {
		    echo $widgetEdit;
		} elseif ($field->range) {
		    echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
		} elseif ($field->field_type == "TEXT") {
		    echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
		} else {
		    echo $form->textField($profile, $field->varname, array('size' => 60, 'maxlength' => (($field->field_size) ? $field->field_size : 255)));
		}
		echo $form->error($profile, $field->varname);
		?>
	    </div>	
	    <?php
	}
    }
    ?>
    <!-- 
    <div class="row">
	<?php //echo $form->labelEx($model, 'username'); ?>
	<?php //echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20)); ?>
	<?php //echo $form->error($model, 'username'); ?>
    </div>
     -->

    <div class="row">
	<?php echo $form->labelEx($model, 'email'); ?>
	<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
	<?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row submit">
    <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class'=>'submit')); ?>
    <a class='btn' href='javascript:window.history.go(-1)'>返回</a>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
