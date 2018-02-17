<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \frontend\models\Address */

$this->title = Yii::t('app', 'Create Address');

?>
<?php \yii\widgets\Pjax::begin(['enablePushState' => false, 'timeout'=>2000]); ?>
    <div class="address-create">

        <?= $this->render('_address', [
            'model' => $model,
        ]) ?>

    </div>
<?php \yii\widgets\Pjax::end(); ?>