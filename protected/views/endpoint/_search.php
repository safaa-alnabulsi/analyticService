<?php
/* @var $this EndpointController */
/* @var $model Endpoint */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'referrer_url'); ?>
		<?php echo $form->textField($model,'referrer_url',array('size'=>60,'maxlength'=>550)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datetime'); ?>
		<?php echo $form->textField($model,'datetime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->