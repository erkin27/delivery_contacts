<?php
use yii\grid\GridView;
?>

<h1>Clients</h1>

<?=

GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'login',
        'password',
        'name',
        'surname',
        'gender',
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
                        return \yii\helpers\Html::a('<span title="Unblock customer" class="glyphicon glyphicon-pencil"></span>',
                            \yii\helpers\Url::to(['app/update-client', 'id' => $model->id])
                            );
                    }
            ]
        ],
    ],
]); ?>