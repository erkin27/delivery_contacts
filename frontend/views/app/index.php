<?php
use yii\grid\GridView;
?>

<h1>Clients</h1>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

//        'id',
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

        [
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                    'update' => function($url, $model, $key) {
                        return \yii\helpers\Html::a('<span title="Edit client" class="glyphicon glyphicon-pencil"></span>',
                            \yii\helpers\Url::to(['app/update-client', 'id' => $model->id])
                            );
                    },
                'delete' => function($url, $model, $key) {
                    return \yii\helpers\Html::a('<span title="Edit client" class="glyphicon glyphicon-trash"></span>',
                        ['app/delete'], [
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure that you want delete this client?'),
                                'method' => 'post',
                                'params' => [ 'id' => $model->id]
                           ]
                        ]);
                }
            ]
        ],
    ],
]); ?>