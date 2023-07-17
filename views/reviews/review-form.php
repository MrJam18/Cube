<?php


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \app\models\Reviews\ReviewForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Create Review';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="reviews__form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'review-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'text')->textarea([
            'rows' => '10'
    ]) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'review-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

