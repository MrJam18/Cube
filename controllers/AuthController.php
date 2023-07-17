<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Auth\LoginForm;
use app\models\Auth\RegistrationForm;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{
    function actionLogin(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->view->params = [
            'alert' => \Yii::$app->request->get('alert')
        ];
        return $this->render('login', [
            'model' => $model,
            'alert' => \Yii::$app->request->get('alert')
        ]);
    }

    function actionRegister(): string|Response
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new RegistrationForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('info', 'You successfully registered. Please login');
            return $this->redirect('/auth/login');
        }
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}