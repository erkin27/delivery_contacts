<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Client */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['clients']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="client-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_client', [
        'model' => $model,
    ]) ?>

</div>
