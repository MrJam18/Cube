<?php

use app\Enums\UserRoleEnum;
use app\models\Reviews\Review;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var ActiveDataProvider $provider
 */
/** @var yii\web\View $this */
$this->title = 'Reviews list'
?>
<div class="reviews__list">
    <h1><?= \yii\bootstrap5\Html::encode($this->title) ?></h1>
    <div class="toolbar">
        <div class="">
            <?= Html::a('Add feedback', ['/reviews/create'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
<?php
echo GridView::widget([
    'tableOptions' => [
        'class'=>'table table-striped table-bordered'
    ],
    'dataProvider' => $provider,
    'columns' => [
        [
            'header' => 'Created At',
            'content' => function (Review $model) {
                return $model->getUSCreatedAt();
            }
        ],
        [
            'header' => 'Updated At',
            'content' => function (Review $model) {
                return $model->getUSUpdatedAt();
            }
        ],
        [
            'header' => 'Author',
            'content' => function (Review $model) {
                return "{$model->author->name} {$model->author->surname}";
            },

        ],
        'title',
        [
             'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
            'template' => isAdmin() ? '{view} {update} {delete}' : '{view}' ,

        ]
    ],
]);
?>
</div>