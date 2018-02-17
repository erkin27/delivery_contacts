<?php
/**
 * @var $this yii\web\View;
 * @var $model \frontend\models\Client
 */
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>

<?php $form = \yii\widgets\ActiveForm::begin([]); ?>
<div class="form-group" style="width: 70%; margin: 0 15%">
    <h3>Client</h3>

    <?= $form->field($model, 'login')->textInput();?>

    <?= $form->field($model, 'password')->textInput();?>

    <?= $form->field($model, 'name')->textInput();?>

    <?= $form->field($model, 'surname')->textInput();?>

    <?= $form->field($model, 'gender')->dropDownList(\frontend\models\Client::getGenders());?>

    <?= $form->field($model, 'email')->textInput();?>

    <?php $addresses = $model->getAddresses()->all();?>
    <label>Addresses</label>
    <?php foreach ($addresses as $address):?>
        <?php /**@var $address \frontend\models\Address  */?>
        <?= \yii\helpers\Html::textInput('Address',
            $address->country. ", " . $address->city. ", str. " . $address->street . ", h. №" . $address->house . ", fl." . $address->float,
            ['disabled' => true, 'class' => 'form-control', 'style' => 'width: 50%'])?>
    <?php endforeach;?>

    <?= \yii\helpers\Html::button('Add address', [
            'id' => 'address_btn', 'class' => 'btn btn-success','style' => 'margin-top:5px;',
            'data-url' =>Url::toRoute(['/app/create-address', 'id' => $model->id])
    ])?>

    <?= \yii\helpers\Html::submitButton('Save', [
        'id' => 'submit_btn',
        'class' => 'btn btn-info',
        'style' => 'float:right;'
    ])?>

</div>
<?php \yii\widgets\ActiveForm::end(); ?>

<?php Modal::begin([
    'header' => '<h4>Address</h4>',
    'id' => 'modalAddress',
    'size' => 'modal-sm'
]);
?>
<div id='modalAddressContent'></div>
<?php Modal::end(); ?>
<?php
$js = <<<SCRIPT
    $('#address_btn').click(function (event) {
        event.preventDefault();
        $('#modalAddress').modal('show')
            .find('#modalAddressContent')
            .load($(this).attr('data-url'));
    });
SCRIPT;

$this->registerJs($js);
?>