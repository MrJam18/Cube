<?php


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \app\models\Auth\UserForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'User form';
?>
<div class="users__form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'weather-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3 register__label'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'surname')->textInput() ?>
    <?= $form->field($model, 'role_id')->dropDownList($roles)->label('User Role') ?>
    <?= $form->field($model, 'email')->textInput(['type' => 'email']) ?>
    <div class="form-group mt-3">
        <div>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>




