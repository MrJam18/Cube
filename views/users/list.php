<?php

use app\models\Auth\User;
use yii\bootstrap5\Html;
use yii\grid\GridView;

$this->title = 'Available users';
?>
<div class="user__list">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php
    $columns = [
        [
            'header' => 'Created at',
            'content' => function (User $model) {
                return $model->getUSCreatedAt();
            }
        ],
        [
            'header' => 'FullName',
            'content' => function (User $model, $key, $index, $column) {
                return "$model->name $model->surname";
            }
        ],
        'email',
        [
            'header' => 'Role',
            'content' => function(User $user) {
                return $user->role->name;
            }
        ],
        [
            'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}<span class="mr-1"></span> {delete}'
        ]
    ];

    echo GridView::widget([
        'tableOptions' => [
            'id' => 'theDatatable',
            'class'=>'table table-striped table-bordered'
        ],
        'dataProvider' => $provider,
        'columns' => $columns
    ]);
    ?>
</div>
