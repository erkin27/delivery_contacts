<?php

/**
 * @var $this yii\web\View;
 */

?>

<?php $form = \yii\widgets\ActiveForm::begin([]); ?>
<div style="margin-top: -15px;">
    <div class="flex-container">
        <div class="flex-item">
            <div class="col-md-offset-0">
                <h3>Client</h3>

                <?= $form->field($client, 'login')->textInput();?>

                <?= $form->field($client, 'password')->textInput();?>

                <?= $form->field($client, 'name')->textInput();?>

                <?= $form->field($client, 'surname')->textInput();?>

                <?= $form->field($client, 'gender')->dropDownList(\frontend\models\Client::getGenders());?>

                <?= $form->field($client, 'email')->textInput();?>

            </div>
        </div>
        <div class="flex-item">
            <div class="col-md-offset-0">
                <h3>Address</h3>

                <?= $form->field($address, 'index')->textInput();?>

                <?= $form->field($address, 'country')->textInput(['maxlength' => 2]);?>

                <?= $form->field($address, 'city')->textInput();?>

                <?= $form->field($address, 'street')->textInput();?>

                <?= $form->field($address, 'house')->input('number');?>

                <?= $form->field($address, 'float')->input('number');?>

                <?= \yii\helpers\Html::submitButton('Create', [
                    'id' => 'submit_btn',
                    'class' => 'btn btn-success',
                    'style' => 'float:right;'
                ])?>

            </div>
        </div>
    </div>
</div>

<?php \yii\widgets\ActiveForm::end(); ?>