<?php
/**
 * @var $this yii\web\View;
 */


?>

<?php $form = \yii\widgets\ActiveForm::begin([]); ?>
<div class="form-group">
    <h3>Client</h3>

    <?= $form->field($model, 'login')->textInput();?>

    <?= $form->field($model, 'password')->textInput();?>

    <?= $form->field($model, 'name')->textInput();?>

    <?= $form->field($model, 'surname')->textInput();?>

    <?= $form->field($model, 'gender')->dropDownList(\frontend\models\Client::getGenders());?>

    <?= $form->field($model, 'email')->textInput();?>

    <?= \yii\helpers\Html::submitButton('Save', [
        'id' => 'submit_btn',
        'class' => 'btn btn-info',
        'style' => 'float:right;'
    ])?>

</div>
<?php \yii\widgets\ActiveForm::end(); ?>