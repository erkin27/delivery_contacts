<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $client frontend\models\Client */
/* @var $address frontend\models\Address */

$this->title = 'Client - ' . $client->login;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['clients']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update-client', 'id' => $client->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete'],
            [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
                'params' => ['id' => $client->id]
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $client,
        'attributes' => [
            'login',
            'password',
            'name',
            'surname',
            'gender' => [
                'attribute' => 'gender',
                'value' => function ($data) {
                    return \frontend\models\Client::getNameGender($data->gender);
                }
            ],
            'created' => [
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d-m-Y H:s', strtotime($data->created));
                }
            ],
            'email:email',
        ],
    ]) ?>

<?php \yii\widgets\Pjax::begin() ?>

        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'index',
                'country',
                'city',
                'street',
                'house',
                'float',
            ],
        ]) ?>

<?php \yii\widgets\Pjax::end()?>

</div>
