<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Client */

$this->title = Yii::t('app', 'Create Client');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['clients']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-create">
    <?= $this->render('_form', [
        'client' => $client,
        'address' => $address
    ]) ?>

</div>