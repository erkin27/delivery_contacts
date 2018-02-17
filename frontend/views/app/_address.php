<?php
/**
 * @var $this yii\web\View;
 */
?>

<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'address-form',
    'options' => ['data-pjax' => '']]); ?>

<div class="form-group">

<?= $form->field($model, 'index')->input('number');?>

<?= $form->field($model, 'country')->textInput(['maxlength' => 2]);?>

<?= $form->field($model, 'city')->textInput();?>

<?= $form->field($model, 'street')->textInput();?>

<?= $form->field($model, 'house')->input('number');?>

<?= $form->field($model, 'float')->input('number');?>

<?= \yii\helpers\Html::submitButton('Save', [
    'id' => 'submit_btn',
    'class' => 'btn btn-info',
//    'style' => 'float:right;'
])?>

</div>
<?php \yii\widgets\ActiveForm::end(); ?>
