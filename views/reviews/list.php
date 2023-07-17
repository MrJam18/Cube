<div class="reviews__list">
<?php

use app\models\Reviews\Review;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/**
 * @var ActiveDataProvider $provider
 */

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
            'template' => '{view}',

        ]
    ],
]);
?>
</div>