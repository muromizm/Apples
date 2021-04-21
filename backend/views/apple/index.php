<?php

use backend\models\Apple;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AppleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Яблоки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать яблоко', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сгенерировать яблоки', ['generate'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'color',
            [
                'attribute' => 'created_at',
                'value' => function(Apple $data) {
                    return Yii::$app->formatter->asDate($data->created_at);
                }
            ],
            [
                'attribute' => 'fall_at',
                'value' => function(Apple $data) {
                    return $data->fall_at ? Yii::$app->formatter->asDate($data->fall_at) : null;
                }
            ],
            [
                'attribute' => 'status',
                'value' => function(Apple $data) {
                    return Apple::STATUSES[$data->status ?? 1];
                }
            ],
            [
                'attribute' => 'eaten',
                'value' => function(Apple $data) {
                    return $data->eaten ? (int) $data->eaten . '%' : 'Ещё не пробовали';
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{fall} {eat} {view} {update} {delete}',
                'buttons' => [
                    'fall' => function($url, $model) {
                        return Html::a(
                            'Уронить',
                            Url::to(['apple/fall', 'id'=>$model->id]),
                            [
                                'class' => 'btn btn-danger btn-sm',
                            ]
                        );
                    },
                    'eat' => function($url, $model) {
                        return Html::a(
                            'Откусить',
                            Url::to(['apple/eat', 'id'=>$model->id]),
                            [
                                'class' => 'btn btn-danger btn-sm',
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
