<?php
declare(strict_types=1);


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \app\models\Auth\RegistrationForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="register">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Fill the form for registration:</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3 register__label'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'email', ['options' => ['class' => 'register__input-field']])->input('email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'name', ['options' => ['class' => 'register__input-field']]) ?>
            <?= $form->field($model, 'surname', ['options' => ['class' => 'register__input-field']]) ?>
            <?= $form->field($model, 'password', ['options' => ['class' => 'register__input-field']])->passwordInput() ?>
            <?= $form->field($model, 'confirmPassword')->passwordInput() ?>


            <div class="form-group">
                <div>
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
